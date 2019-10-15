<?php

/**
 * @var $this yii\web\View
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $type string
 * @var $category string
 */

use yii\helpers\Url;

$this->title = ( !empty($category) ? $category . " - " : "" ) . Yii::$app->feehi->website_title;
$this->registerCssFile("@web/static/css/index.css");
$this->registerJs(<<<JS
    
JS
);
?>
<div class="example">
    <div class="ft-carousel" id="carousel_3">
        <ul class="carousel-inner">
            <?php foreach ($banner as $item):?>

                <li class="carousel-item">
                    <img src="<?=$item->img?>" alt="">
                </li>
            <?php endforeach;?>

        </ul>
    </div>
</div>

<div class="heo">
    <div class="howo">
        <div class="jdljfl">
            <img src="/static/img/首页_03.gif" alt="">
        </div>
        <div class="jdljf">
            <img src="/static/img/首页_05.gif" alt="">
        </div>
    </div>
</div>
<div class="group">
    <div>
        <h3>集团新闻</h3>
        <ul>
            <?php foreach ($article_list as $k=>$item):?>
                <?php if(4 === $k) break;?>
            <li>
                <img src="/static/img/2_01_03.gif" alt=""> <a href="<?=Url::to(['article/view', 'id' => $item['id']]);?>"><?=mb_substr($item['title'],0,16)?> <?=$item['date']?></a>
            </li>
            <?php endforeach;?>

        </ul>
    </div>
    <div >
        <!-- <h3>MORE+</h3>
        <ul>
            <li>2019-09-01</li>
            <li>2019-09-01</li>
            <li>2019-09-01</li>
            <li>2019-09-01</li>
            <li>2019-09-01</li>
        </ul> -->
    </div>
    <div>
        <video src="/i/movie.ogg" controls="controls">
            your browser does not support the video tag
        </video>
    </div>
    <div>
        <a href="<?=Url::to(['/come/china'])?>">
            <img src="/static/img/maps.png" alt="">
        </a>
    </div>
</div>


