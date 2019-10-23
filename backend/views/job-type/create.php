<?php

use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model common\models\jobType */

$this->params['breadcrumbs'] = [
    ['label' => yii::t('app', 'Job Type'), 'url' => Url::to(['index'])],
    ['label' => yii::t('app', 'Create') . yii::t('app', 'Job Type')],
];
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>

