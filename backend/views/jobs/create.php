<?php

use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model backend\models\form\JobsForm */

$this->params['breadcrumbs'] = [
    ['label' => yii::t('app', 'Jobs Form'), 'url' => Url::to(['index'])],
    ['label' => yii::t('app', 'Create') . yii::t('app', 'Jobs Form')],
];
?>
<?= $this->render('_form', [
    'model' => $model,
    'jobTypes' => $jobTypes,
    'addresses' => $addresses,
]) ?>

