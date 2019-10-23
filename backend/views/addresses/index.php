<?php

use backend\widgets\Bar;
use backend\grid\CheckboxColumn;
use backend\grid\ActionColumn;
use backend\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\addressesSearche */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Addresses');
$this->params['breadcrumbs'][] = yii::t('app', 'Addresses');
?>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= $this->render('/widgets/_ibox-title') ?>
            <div class="ibox-content">
                <?= Bar::widget() ?>
                <?=$this->render('_search', ['model' => $searchModel]); ?>
    <?php Pjax::begin(); ?>            <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => CheckboxColumn::className()],

                        'id',
                        'address',

                        ['class' => ActionColumn::className(),],
                    ],
                ]); ?>
<?php Pjax::end(); ?>            </div>
        </div>
    </div>
</div>
