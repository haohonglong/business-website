<?php
use yii\helpers\Url;

$this->title = '企业荣耀';
$this->registerCssFile("@web/static/css/corporateglory.css");
$css = <<<CSS
.wrapImg{
				width: 100%;
				padding-bottom: 37.5px;
				background: #f6f9ff;
			}
			.wrapImg > div{
				width: 350px;
				height: auto;
				margin-left: 37.5px;
				margin-top: 37.5px;
				display: inline-block;
				font-size: 0;
			}
			.wrapImg img{
				width: 100%;
				height: auto;
			}
			.wrapImg > div p{
				font-size: 14px;
				color: #333;
				margin-top: 6px;
			}

			@media (max-width: 500px) {
				.wrapImg{
					width: 100%;
					padding-bottom: 6.66%;
					background: #f6f9ff;
				}
				.wrapImg > div{
					width: 40%;
					height: auto;
					margin-left: 6.66%;
					margin-top: 6.66%;
					display: inline-block;
				}

				.wrapImg > div p{
					font-size: 12px;
				}
			}
CSS;

$this->registerCss($css);
?>

<!-- 内容 -->
<div class="container">
    <div class="wrapBanner1"><img src="<?=\Yii::getAlias('@themes_static')?>/basic/images/banner1.png"></div>
    <div class="wrap">
        <div class="wrapTitle">
            <span>企业荣誉</span>
            <p>Team introduction</p>
            <div class="wrapTitle_dh"><img src="<?=\Yii::getAlias('@themes_static')?>/basic/images/home.png" />走进方巨 > 企业荣誉</div>
        </div>
        <div class="wrapImg">
            <?php foreach ($list as $item):?>
                <div>
                    <img src="<?=$item['thumb']?>">
                    <p><?=$item['title']?></p>
                </div>
            <?php endforeach?>
        </div>
    </div>
</div>