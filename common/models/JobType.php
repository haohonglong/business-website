<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "jobType".
 *
 * @property int $id
 * @property string $name
 */
class JobType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jobType';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            ['name', 'unique'],
        ];
    }

    /**
     * 返回所有职位类型
     * @return array
     */
    public static function getJobTypes()
    {
        $arr = self::find()->asArray()->all();
        return ArrayHelper::map($arr,'id','name');
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
            'name' => Yii::t('app', 'Name'),
        ];
    }
}
