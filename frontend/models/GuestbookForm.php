<?php


namespace frontend\models;
use common\models\Guestbook;

class GuestbookForm extends Guestbook
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'phone', 'email', 'content'], 'required'],
            [['username', 'phone', 'email', 'content'], 'string', 'max' => 255],
        ];
    }




}