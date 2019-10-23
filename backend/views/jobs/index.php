<?php

use backend\widgets\Bar;
use backend\grid\CheckboxColumn;
use backend\grid\ActionColumn;
use backend\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\JobsSearche */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Jobs Forms');
$this->params['breadcrumbs'][] = yii::t('app', 'Jobs Form');
?>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= $this->render('/widgets/_ibox-title') ?>
            <div class="ibox-content">
                <?= Bar::widget() ?>
                <?=$this->render('_search', ['model' => $searchModel,'jobTypes'=>$jobTypes,'addresses' => $addresses,]); ?>
    <?php Pjax::begin(); ?>            <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => CheckboxColumn::className()],

                        'id',
                        [
                            'attribute' => 'jobtype_id',
                            'label' => '职位类型',
                            'value' => function ($model) {
                                return \common\models\JobType::getModelByid($model->jobtype_id)->name;
                            },
                        ],
                        [
                            'attribute' => 'address_id',
                            'label' => '工作地址',
                            'value' => function ($model) {
                                return \common\models\Addresses::getModelByid($model->address_id)->address;
                            },
                        ],
                        'name',
                        'chain',

                        ['class' => ActionColumn::className(),],
                    ],
                ]); ?>
<?php Pjax::end(); ?>            </div>
        </div>
    </div>
</div>
