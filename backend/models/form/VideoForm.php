<?php

namespace backend\models\form;

use common\helpers\Util;
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

    public function upload(UploadVideoForm $uploadVideoForm)
    {
        $model = $uploadVideoForm;
        if($model->upload()){

            $this->url = str_replace(Yii::getAlias('@frontend/web'), '', $model->path);
            return true;
        }
        return false;
    }



    private function del($id)
    {
        $path = Yii::getAlias('@frontend/web');

        $model = self::findOne($id);
        $file = $path.$model->url;
        if(file_exists($file) && is_file($file)){
            unlink($file);
        }
        $model->delete();
    }

    public function remove($id)
    {
        if(is_array($id)){
            foreach ($id as $i){
                $this->del($i);
            }
        }else{
            $this->del($id);
        }
        Util::rm_empty_dir(Yii::getAlias('@video').'/');
    }



    /**
     * @return bool
     */
    public function create()
    {
        $time = time();
        $this->uid = Yii::$app->user->identity->id;
        $this->scan = 0;
        $this->created_at = $time;
        $this->updated_at = $time;
        if($this->validate()){
            return $this->save();
        }
        return false;

    }


    public function update($runValidation = true, $attributeNames = null)
    {
        $time = time();
        $this->updated_at = $time;
        return parent::update($runValidation, $attributeNames);

    }



}
