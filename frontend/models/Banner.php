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
    public static function getLogo()
    {
        $rows = (new Query())
            ->select('value,tips')
            ->from('options')
            ->where(['id' => 30])
            ->limit(1)
            ->one();
        return $rows;

    }

}