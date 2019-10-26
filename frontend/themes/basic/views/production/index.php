<?php
use yii\helpers\Url;

$this->title = '旗下产品';

?>
<!-- 内容 -->
<div class="container">
    <div class="wrapBanner1"><img src="<?=\Yii::getAlias('@themes_static')?>/basic/images/banner1.png"></div>
    <div class="wrap">
        <div class="wrapTitle">
            <span>旗下产品</span>
            <p>Products under its flag</p>
            <div class="wrapTitle_dh"><img src="<?=\Yii::getAlias('@themes_static')?>/basic/images/home.png" />走进方巨 > 团队介绍</div>
        </div>
        <div class="wrapSwitch">
            <div class="wrapSwitch_left">
                <li class="<?php if(isset($_GET['id']) && '18' == $_GET['id']) echo 'bubble'; ?>">
                    <a href="<?=Url::to(['/production/index','id'=>18])?>"><span>数字党建</span></a>
                    <p>Digital Party Building</p>
                </li>
                <li class="<?php if(isset($_GET['id']) && '19' == $_GET['id']) echo 'bubble'; ?>">
                    <a href="<?=Url::to(['/production/index','id'=>19])?>"><span>高新科技产品</span></a>
                    <p>High-tech products</p>
                </li>
            </div>
            <div class="wrapSwitch_right">
                <?php foreach ($list as $v):?>
                <a>
                    <img src="<?=$v['thumb']?>">
                    <div class="wrapSwitch_right_div">
                        <p><?=$v['title']?></p>
                        <span><?=$v['summary']?></span>
                    </div>
                </a>
                <?php endforeach; ?>

            </div>
        </div>
    </div>
</div>


