<?php

namespace common\models;

use Yii;
use yii\web\NotFoundHttpException;

/**
 * This is the model class for table "video".
 *
 * @property int $id
 * @property int $uid 上传用户
 * @property string $title
 * @property string $url 视频地址
 * @property int $scan 游览次数
 * @property int $created_at 创建时间
 * @property int $updated_at 最后修改时间
 */
class Video extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'video';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['uid', 'title', 'url', 'created_at', 'updated_at'], 'required'],
            [['uid', 'scan', 'created_at', 'updated_at'], 'integer'],
            [['title', 'url'], 'string', 'max' => 255],
        ];
    }

    public static function getVoidoById($id)
    {
        $model = self::find()->select('title,url,created_at')->where(['id'=>$id])->limit(1)->one();
        if($model){
            $arr = [];
            $url =Yii::getAlias('@frontend/web').$model->url;
            $arr['title'] = $model->title;
            $arr['url'] = $model->url;
            $arr['time'] = date('Y-m-d H:s:i',$model->created_at);
            if(file_exists($url)){
                return $arr;
            }else{
                throw new NotFoundHttpException("视频不存在！");
            }

        }
        throw new NotFoundHttpException("视频 id '$id' 不存在！");

    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'uid' => Yii::t('app', 'Uid'),
            'title' => Yii::t('app', 'Title'),
            'url' => Yii::t('app', 'Url'),
            'scan' => Yii::t('app', 'Scan'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
