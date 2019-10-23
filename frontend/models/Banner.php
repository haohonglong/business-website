<?php


namespace frontend\models;


use backend\models\form\BannerForm;
use \yii\db\Query;

class Banner extends BannerForm
{
    public static function getBanners($id, $asArray=false)
    {
        return parent::getBanners($id, $asArray=false);

    }


}