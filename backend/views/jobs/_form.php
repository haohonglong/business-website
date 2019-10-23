<?php

use backend\widgets\ActiveForm;
use backend\widgets\Ueditor;
/* @var $this yii\web\View */
/* @var $model backend\models\form\JobsForm */
/* @var $form backend\widgets\ActiveForm */
?>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= $this->render('/widgets/_ibox-title') ?>
            <div class="ibox-content">
                <?php $form = ActiveForm::begin([
                    'options' => [
                        'class' => 'form-horizontal'
                    ]
                ]); ?>
                <div class="hr-line-dashed"></div>
                    <?= $form->field($model, 'jobtype_id')->dropdownList($jobTypes) ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'address_id')->dropdownList($addresses) ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'chain')->textInput(['maxlength' => true]) ?>
                        <div class="hr-line-dashed"></div>
                        <?= $form->field($model, 'duty')->widget(Ueditor::className()) ?>
                        <div class="hr-line-dashed"></div>
                        <?= $form->field($model, 'description')->widget(Ueditor::className()) ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->defaultButtons() ?>
                    <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>