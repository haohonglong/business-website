<?php


namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;


class Company
{
    public static function getInfo()
    {
        $sql = <<<SQL
    select name,value from options where id in(24,31,32,33,34)
SQL;
        $query = Yii::$app->db->createCommand($sql)->queryAll();
        return ArrayHelper::map($query,'name','value');
    }

}