<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "jobs".
 *
 * @property int $id
 * @property int $jobtype_id 职能类型
 * @property int $address_id 工作地址
 * @property string $name 职位名称
 * @property string $chain 供应链
 * @property string $duty 工作职责
 * @property string $description 岗位描述
 * @property int $created_at 创建时间
 * @property int $updated_at 最后修改时间
 */
class Jobs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jobs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jobtype_id', 'address_id', 'name', 'duty', 'description', 'created_at', 'updated_at'], 'required'],
            [['jobtype_id', 'address_id', 'created_at', 'updated_at'], 'integer'],
            [['duty', 'description'], 'string'],
            [['name', 'chain'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'jobtype_id' => Yii::t('app', '职能类型'),
            'address_id' => Yii::t('app', '工作地址'),
            'name' => Yii::t('app', '职位名称'),
            'chain' => Yii::t('app', '供应链'),
            'duty' => Yii::t('app', '工作职责'),
            'description' => Yii::t('app', '岗位描述'),
            'created_at' => Yii::t('app', '创建时间'),
            'updated_at' => Yii::t('app', '最后修改时间'),
        ];
    }
}
