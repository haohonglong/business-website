<?php

/**
 * @var $this yii\web\View
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $type string
 * @var $category string
 */

use yii\helpers\Url;
$this->title = '首页';
$slider = \common\models\Options::getBannersByType('index_slider');
$video = \common\models\Video::getVoidoById(0);
$video['url'] = Yii::getAlias('@web').$video['url'];

?>

<div class="container">
    <!-- 图片轮播图 -->
    <div class="b-slide slide clearfix">
        <div class="carousel-inner b-slide-inner fl">
            <?php foreach ($slider as $key => $item): ?>
                <div class="item <?php if(0 == $key) echo 'active'; ?>" style="background: url(<?=$item['img']?>) center no-repeat; background-size: cover;">
                    <a style="display:block;width:100%;height:100%;" rel="nofollow"></a>
                </div>
            <?php endforeach;?>
        </div>
        <a class="carousel-control left b-leftbtn" href=".b-slide" data-slide="prev" rel="nofollow"></a>
        <a class="carousel-control right b-rightbtn" href=".b-slide" data-slide="next" rel="nofollow"></a>
        <div class="slidemask">
            <div class="w1200 pr">

                <div class="bs-box">
                    <a href="<?=Url::to(['/production/index','id'=>18])?>" target="_blank" class="es"><span class="tt">
                                <font style="color:#fff; display: block; font-size: 22px; line-height: 1; margin-bottom: 8px;">Digital Party<br>Building</font><strong class="tt1">数字党建</strong></span><span class="th">数字党建</span></a>
                    <a href="<?=Url::to(['/production/index','id'=>19])?>" target="_blank" class="bs"><span class="tt">
                                <font style="color:#fff; display: block; font-size: 22px; line-height: 1; margin-bottom: 8px;">Digital Party<br>Building</font><strong class="tt2">高新科技产品</strong></span><span class="th">高新科技产品</span></a>
                </div>
            </div>
        </div>
    </div>
    <!-- /图片轮播图 -->
    <!-- 综合 -->
    <div class="mainbox w1200">
        <!-- 新闻 -->
        <div class="news-box fl">
            <div class="news-top clearfix">
                <ul>
                    <li class="current">
                        <a href="/news/10/">集团新闻</a>
                    </li>
                </ul>
                <a class='more' href="#">MORE+</a>
            </div>

            <div class="news-main">
                <div class="news-main-box">
                    <div class="ss">
                        <ul class="index-xw-list">
                            <?php foreach ($article_list as $k=>$item):?>
                                <?php if($k >= 6) break;?>
                                <li><div class="listImg"></div><a href="<?=Url::to(['article/view', 'id' => $item['id']]);?>"><?=mb_substr($item['title'],0,16)?></a><span><?=$item['date']?></span></li>
                            <?php endforeach;?>
                        </ul>
                        <ul class="index-xw-list" style="display: none;">
                            <?php foreach ($article_list as $k=>$item):?>
                                <?php if($k <= 6) continue;?>
                                <li><div class="listImg"></div><a href="<?=Url::to(['article/view', 'id' => $item['id']]);?>"><?=mb_substr($item['title'],0,16)?></a><span><?=$item['date']?></span></li>
                            <?php endforeach;?>
                        </ul>
                    </div>
                </div>
                <ul class="news-main-con news-xw-main">
                    <li class="on id_hover1"></li>
                    <li class="id_hover2"></li>
                </ul>
            </div>

        </div>
        <!-- 地产详情图 -->
        <div class="est-detail">

            <div class="est-detail-box">
                <video width="100%" height="100%" src="<?=$video['url']?>" controls="controls">
                    <source src="myvideo.mp4" type="video/mp4"></source>
                    <source src="myvideo.ogv" type="video/ogg"></source>
                    <source src="myvideo.webm" type="video/webm"></source>
                    <object width="" height="" type="application/x-shockwave-flash" data="myvideo.swf">
                        <param name="movie" value="myvideo.swf" />
                        <param name="flashvars" value="autostart=true&amp;file=myvideo.swf" />
                    </object>
                    当前浏览器不支持 video直接播放，点击这里下载视频： <a href="myvideo.webm">下载视频</a>
                </video>
            </div>
        </div>


        <div class="lay-box">
            <a href="<?=Url::to(['come/china'])?>">
                <img src="<?=\Yii::getAlias('@themes_static')?>/basic/images/maps.png" alt="" style="width: 100%;" /></a>
        </div>
    </div>

</div>



