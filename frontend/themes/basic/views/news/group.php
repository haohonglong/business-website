<?php
use yii\helpers\Url;

$this->title = '集团新闻';
$css = <<<CSS
.wrap > .wrap_div{
				width: 312px;
				height: auto;
				margin-left: 30px;
				margin-right: 58px;
				display: inline-block;
				vertical-align: top;
			}
			.wrap > .wrap_div p{
				font-size: 22px;
				color: #504a5a;
				padding: 14px 0;
			}
			.wrap > .wrap_div span{
				font-size: 18px;
				color: #9d8068;
			}

			.wrap_newsText{
				width: 800px;
				display: inline-block;
			}
			.wrap_newsText_li1{
				width: 100%;
				height: 215px;
				font-size: 0;
			}
			.wrap_newsText_li1 > img{
				width: 330px;
				height: 215px;
				display: inline-block;
			}
			.wrap_newsText_li1 > div{
				width: 470px;
				height: 215px;
				display: inline-block;
				padding-left: 20px;
				box-sizing: border-box;
				background: #e6edf7;
			}
			.wrap_newsText_li1 > div span{
				color: #333333;
				font-size: 18px;
				padding-top: 42px;
				padding-bottom: 20px;
				display: block;
			}
			.wrap_newsText_li1 > div p{
				color: #333333;
				font-size: 15px;
			}

			.wrap_newsText_li2{
				width: 100%;
				height: auto;
				padding: 40px 20px;
				font-size: 0;
				border-bottom: 1px dashed #d8e0ee;
				box-sizing: border-box;
			}
			.wrap_newsText_li2 span{
				color: #333333;
				font-size: 18px;
				padding-bottom: 20px;
				display: block;
			}
			.wrap_newsText_li2 p{
				color: #333333;
				font-size: 15px;
			}

			.code{
				font-size: 15px;
				color: #333333;
				margin: 15px 0;
			}
			.code img{
				width: 80px;
				height: 80px;
				margin-top: 8px;
				margin-left: 18px;
				display: block;
			}

			@media (max-width: 500px) {
				.wrap_newsText{
					width: 100%;
				}
				.wrap_newsText_li1 img{
					display: none;
				}
				.wrap_newsText_li1 > div{
					width: 100%;
					height: auto;
					padding: 20px;
				}
				.wrap_newsText_li1 > div span{
					padding-top: 0;
				}
				.wrap_newsText_li2{
					width: 100%;
					padding: 20px 20px;
				}
			}
CSS;

$this->registerCss($css);

?>

<!-- 内容 -->
<div class="container">
    <div class="wrapBanner1"><img src="<?=\Yii::getAlias('@themes_static')?>/basic/images/banner1.png"></div>
    <div class="wrap" style="background: #f6f9ff;">
        <div class="wrapTitle">
            <span>集团新闻</span>
            <p>Team introduction</p>
            <div class="wrapTitle_dh"><img src="<?=\Yii::getAlias('@themes_static')?>/basic/images/home.png" />走进方巨 > 集团新闻</div>
        </div>
        <!-- <img src="../images/img6.png"> -->
        <div class="wrap_div">
            <img src="<?=\Yii::getAlias('@themes_static')?>/basic/images/logo.png">
            <p>Ten Innovative Enterprises <br>of Shared Economy in China</p>
            <span>中国共享经济十大创新企业</span>

            <div class="code">
                您可以关注我们的微信公众号<br>
                及时获取更多信息
                <img src="<?=\Yii::getAlias('@themes_static')?>/basic/images/code.jpg">
            </div>
        </div>
        <div class="wrap_newsText">
            <div class="wrap_newsText_li1">
                <img src="<?=$art_first['thumb']?>">
                <div>
                    <a href="<?=Url::to(['article/view','id'=>$art_first['id']])?>"><span><?=$art_first['title']?></span></a>
                    <p><?=$art_first['summary']?></p>
                </div>
            </div>
            <?php foreach ($articles as $item):?>
                <div class="wrap_newsText_li2">
                    <a href="<?=Url::to(['article/view','id'=>$item['id']])?>"><span><?=$item['title']?></span></a>
                    <p><?=$item['summary']?></p>
                </div>
            <?php endforeach;?>
        </div>
    </div>
</div>
