<?php


namespace common\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use common\helpers\Util;
use \Cloudinary\Uploader;

class UploadVideoForm extends Model
{
    public $url;
    public $name;
    public $path;

    public function rules()
    {
        return [
            [['url'], 'file', 'skipOnEmpty' => false, 'extensions' => 'mp4'],
        ];
    }

    public function download()
    {
        $path = Yii::getAlias('@video').'/';
        $arr = Util::generatePath($path);
        $this->path = $arr['folder'];
        $this->name =$arr['name'] . '.' . 'mp4';
        $arr = Uploader::upload($this->name,
            [
                "folder" => $path,
                "public_id" => $this->path,
                "overwrite" => TRUE,
                "resource_type" => "video"
            ]);

    }



    public function upload()
    {
        $this->url = UploadedFile::getInstance($this, 'url');
        if ($this->validate()) {
            $path = Yii::getAlias('@video').'/';
            $arr = Util::generatePath($path);
            $this->path = $path.$arr['folder'];
            $this->name =$arr['name'] . '.' . $this->url->extension;
            $this->path = $this->path . $this->name;
            $this->url->saveAs($this->path);
            return true;
        } else {
            return false;
        }
    }

}