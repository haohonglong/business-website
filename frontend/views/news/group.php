<?php
use yii\helpers\Url;

$this->registerCssFile("@web/static/css/groupnews.css");
$this->title = '集团新闻';
?>

<?= $this->render('@frontend/views/_common/breadcrumbs',[
    'list'=>[
        ['url'=>Url::to(['article/index']),'name'=>'走进方巨',]
    ],
    'img'=>'',
])?>

<!--事迹-->
<div>
    <div class="group">
        <div class="Fang-Ju">
            <img src="/static/img/新闻中心_03.gif" alt="">
        </div>
        <div class="Deeds">

            <div class="Poverty_Alleviation" data-id="<?=$art_first['id']?>">
                <div>

                    <img src="<?=$art_first['thumb']?>" alt="">
                </div>
                <div class="heooa">
                    <h3><a href="<?=Url::to(['article/view','id'=>$art_first['id']])?>"><?=$art_first['title']?></a></h3>
                    <p><?=$art_first['summary']?></p>
                </div>
            </div>
            <ul>
                <?php foreach ($articles as $item):?>
                    <li data-id="<?=$item['id']?>">
                        <h3><a href="<?=Url::to(['article/view','id'=>$item['id']])?>"><?=$item['title']?></a></h3>
                        <p><?=$item['summary']?></p>
                    </li>
                <?php endforeach;?>

                <li>
                    <img src="/static/img/icon-ajax.png" alt="">
                </li>
            </ul>
        </div>
    </div>
</div>