<?php
/**
 * @var $this yii\web\View
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $type string
 * @var $category string
 */
use yii\helpers\Url;
$this->title = '团队介绍';
$this->registerCssFile("@web/static/css/number.css");
$this->registerCssFile("@web/static/css/ft-carousel.css");
$this->registerJsFile("@web/static/js/homepage.js");
//$this->title = ( !empty($category) ? $category . " - " : "" ) . Yii::$app->feehi->website_title;

//$this->registerJs(<<<JS
//
//JS
//);
?>
<?= $this->render('@frontend/views/_common/breadcrumbs',[
    'list'=>[
        ['url'=>Url::to(['join/index']),'name'=>'加入方巨',]
    ],
    'img'=>'/static/img/旗下产品_03.png',
])?>

<!--数字党建-->
<div>
    <div class="number">
        <div class="party-building">
            <img src="/static/images/images/2_03.png" alt="">
        </div>
        <div class="case">
            <ul>
                <li>
                    <img src="/static/images/images/3_03.png" alt="">
                </li>
                <li>
                    <img src="/static/images/images/3_06.png" alt="">
                </li>
                <li>
                    <img src="/static/images/images/3_08.png" alt="">
                </li>
                <li class="Connect">
                    <a href="">
                        <img src="/static/images/images/2_14.png" alt="">
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>



