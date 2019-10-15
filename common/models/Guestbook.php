<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "guestbook".
 *
 * @property int $id
 * @property string $username 用户名
 * @property string $phone 手机号
 * @property string $email
 * @property string $content 留言内容
 * @property int $created_at 创建时间
 * @property int $updated_at 最后修改时间
 */
class Guestbook extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'guestbook';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'phone', 'email', 'content', 'created_at'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['username', 'phone', 'email', 'content'], 'string', 'max' => 255],
        ];
    }



    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'phone' => Yii::t('app', 'Phone'),
            'email' => Yii::t('app', 'Email'),
            'content' => Yii::t('app', 'Content'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
