<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Addresses */

$this->params['breadcrumbs'] = [
    ['label' => yii::t('app', 'Addresses'), 'url' => Url::to(['index'])],
    ['label' => yii::t('app', 'Update') . yii::t('app', 'Addresses')],
];
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>
