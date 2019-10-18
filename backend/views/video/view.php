<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Video */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Videos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerCss("video{width:500px!important}");
?>
<div class="video-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'uid',
            'title',
            [
                'attribute' => 'url',
                'format' => 'raw',
                'value' => function($model){
                    return "<video width='20' height='20' class='img-responsive' src='http://fangju.local/{$model->url}' controls='controls'></video>";
                }
            ],
            'scan',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
