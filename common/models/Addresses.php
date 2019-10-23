<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "addresses".
 *
 * @property int $id
 * @property string $address 地址
 */
class Addresses extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'addresses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['address'], 'required'],
            [['address'], 'string', 'max' => 255],
            ['address', 'unique'],
        ];
    }

    /**
     * 返回所有地址
     * @return array
     */
    public static function getAddresses()
    {
        $arr = self::find()->asArray()->all();
        return ArrayHelper::map($arr,'id','address');
    }

    public static function getModelByid($id)
    {
        return self::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'address' => Yii::t('app', 'Address'),
        ];
    }
}
