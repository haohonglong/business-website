<?php


namespace backend\models\form;


use common\models\Jobs;

class JobsForm extends Jobs
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jobtype_id', 'address_id'], 'integer'],
            [['name', 'duty', 'description','jobtype_id', 'address_id'], 'required'],
            [['name', 'chain'], 'string', 'max' => 255],
        ];
    }

    public function save($runValidation = true, $attributeNames = NULL)
    {
        $date = time();
        $this->created_at = $date;
        $this->updated_at = $date;
        return parent::save($runValidation, $attributeNames);

    }





}