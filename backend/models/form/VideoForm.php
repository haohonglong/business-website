<?php

namespace backend\models\form;

use common\models\UploadVideoForm;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "video".
 *
 * @property int $id
 * @property string $uid 上传用户用户名
 * @property string $title
 * @property string $url 视频地址
 * @property int $scan 游览次数
 * @property int $created_at 创建时间
 * @property int $updated_at 最后修改时间
 */
class VideoForm extends \common\models\Video
{

    public  $uploadVideoForm;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'url'], 'required'],
            [['title', 'url'], 'string', 'max' => 255],
        ];
    }

    /**
     * @return bool
     */
    public function create()
    {
        $model = $this->uploadVideoForm;
        $time = time();
        $this->uid = Yii::$app->user->identity->id;
        $this->scan = 0;
        $this->created_at = $time;
        $this->updated_at = $time;
        if($model->upload()){
            $this->url = $model->path.$model->name;
            return $this->save();
        }
        return false;

    }


    public function modify()
    {
        $time = time();
        $this->scan = 0;
        $this->updated_at = $time;
        return $this->save();

    }



}
