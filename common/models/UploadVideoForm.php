<?php


namespace common\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

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


    public function upload()
    {
        $this->url = UploadedFile::getInstance($this, 'url');
        if ($this->validate()) {
            $dir = Yii::getAlias('@video').'/';
            $date = date('Ymd');
            if(!is_dir($dir)){
                mkdir($dir);
            }
            $this->path = $date.'/';
            $dir = $dir.$this->path;
            if(!is_dir($dir)){
                mkdir($dir);
            }

            $this->name =date('YmdHis').'_'.uniqid() . '.' . $this->url->extension;
            $this->url->saveAs($dir . $this->name);
            return true;
        } else {
            return false;
        }
    }

    public function del()
    {

    }
}