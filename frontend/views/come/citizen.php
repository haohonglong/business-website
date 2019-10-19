<?php
use yii\helpers\Url;

$this->title = "企业公民";
$this->registerCssFile("@web/static/css/corporate.css");
$this->registerCssFile("@web/static/css/style.css");
$this->registerCssFile("@web/static/css/Event.css");

$this->registerJsFile("@web/static/js/http.js");
$this->registerJsFile("@web/static/js/startMove.js");

?>

<?= $this->render('@frontend/views/_common/breadcrumbs',[
    'list'=>[
        ['url'=>Url::to(['article/index']),'name'=>'走进方巨',]
    ],
    'img'=>'/static/img/旗下产品_03.png',
])?>

<!--轮播-->
<div class="jjoe">
    <div class="Poor">
        <div>
            <div id="box">
                <ul id="pic_list">
                    <?php foreach ($list['images'] as $item): ?>
                    <li style="z-index:2;opacity:1;fliter:alpha(opacity=100);">
                        <a href=""><img width="660" height="330" src="<?=$item?>" alt="" /></a></li>
                    <?php endforeach;?>

                </ul>

                <div class="mark"></div>

                <ul class="text_list" id="text_list">
                    <li><h2 class="show"><a href=""></a></h2></li>
                    <li><h2><a href=""></a></h2></li>
                    <li><h2><a href=""></a></h2></li>
                    <li><h2><a href=""></a></h2></li>

                </ul>

                <div id="ico_list">
                    <ul>
                        <?php foreach ($list['images'] as $item): ?>
                            <li class="active"><a href="javascript:void(0)"><img width="64" height="34" src="<?=$item?>" alt="" /></a></li>

                        <?php endforeach;?>

                    </ul>
                </div>

                <a href="javascript:void(0)" id="btn_prev" class="btn"></a>
                <a href="javascript:void(0)" id="btn_next" class="btn showBtn"></a>
            </div>

        </div>
        <div>
            <h3><?=$list['title']?></h3>
            <p><?=$list['summary']?></p>
        </div>
    </div>
</div>
<div class="Event">
    <div class="plan">
        <div class="Care_for">
            <div>
                <h3>2008年起累计关爱</h3>
            </div>
            <div>
                <ul>
                    <li>
                        <h5>15</h5>
                    </li>
                    <li>
                        <p>15贫困孤残留守儿童代表实现新年愿望问</p>
                    </li>
                </ul>
                <div>
                    <ul>
                        <li>
                            <h5>6</h5>
                        </li>
                        <li>
                            <p>个特困家庭带去了新年礼物与慰问</p>
                        </li>
                    </ul>
                </div>
                <div>
                    <ul>
                        <li>
                            <h5>203</h5>
                        </li>
                        <li>
                            <p>个贫困孤残留守儿童代表实现了新年愿望</p>
                        </li>
                    </ul>
                </div>
                <div>
                    <ul>
                        <li>
                            <h5>203</h5>
                        </li>
                        <li>
                            <p>名孤残贫困留守儿童实现了新年愿望</p>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>