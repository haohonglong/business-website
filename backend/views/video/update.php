<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Video */

$this->params['breadcrumbs'] = [
    ['label' => yii::t('app', 'Video'), 'url' => Url::to(['index'])],
    ['label' => yii::t('app', 'Update') . yii::t('app', 'Video')],
];
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>
