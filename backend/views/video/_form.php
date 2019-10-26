<?php

use backend\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Video */
/* @var $form backend\widgets\ActiveForm */
?>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= $this->render('/widgets/_ibox-title') ?>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-sm-5">
                        <?php $form = ActiveForm::begin([
                            'options' => [
                                'class' => 'form-horizontal',
                                'enctype' => 'multipart/form-data',
                            ]
                        ]); ?>
                        <div class="hr-line-dashed"></div>
                        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                        <div class="hr-line-dashed"></div>
                        <?php if(isset($model->uploadVideoForm)): ?>
                        <?= $form->field($model->uploadVideoForm, 'url')->fileInput() ?>
                        <?php endif; ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->defaultButtons() ?>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>