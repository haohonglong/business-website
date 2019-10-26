<?php


namespace common\models;


use yii\base\Model;
use yii\db\Query;
use yii\web\NotFoundHttpException;

class CityModel extends Model
{
    public static function getCityByName($name)
    {
        $model = (new Query())->select('*')->from('bs_city')->where(['city_name'=>$name])->one();
        if($model){
            return $model;
        }
        throw new NotFoundHttpException("Cannot find the name $name");

    }

}