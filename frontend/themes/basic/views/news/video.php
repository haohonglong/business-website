<?php
use yii\helpers\Url;

$this->title = '视频中心';

$css = <<<CSS
video{
				background: #000;
			}
			.wrapDiv1{
				width: 100%;
				font-size: 0;
			}
			.wrapDiv2{
				width: 100%;
				font-size: 0;
			}
			.wrapDiv1_l{
				width: 640px;
				display: inline-block;
			}
			.wrapDiv1_r{
				width: 560px;
				display: inline-block;
				font-size: 0;
				vertical-align: top;
			}

			.video1{
				width: 640px;
				font-size: 0;
				margin-bottom: 20px;
			}
			.video1 video{
				width: 640px;
				height: 366px;
			}
			.video1 p{
				line-height: 64px;
				padding-left: 20px;
				box-sizing: border-box;
				font-size: 24px;
				color: #333333;
				background: #f7f7f7;
			}

			.video2{
				width: 260px;
				font-size: 0;
				margin-left: 20px;
				margin-bottom: 20px;
				display: inline-block;
			}
			.video2 video{
				width: 260px;
				height: 170px;
			}
			.video2 p{
				line-height: 35px;
				padding-left: 10px;
				box-sizing: border-box;
				font-size: 16px;
				color: #333333;
				background: #f7f7f7;
			}

			.video3{
				width: 386px;
				font-size: 0;
				margin-right: 21px;
				margin-bottom: 21px;
				display: inline-block;
			}
			.video3 video{
				width: 386px;
				height: 230px;
			}
			.video3 p{
				line-height: 35px;
				padding-left: 10px;
				box-sizing: border-box;
				font-size: 16px;
				color: #333333;
				background: #f7f7f7;
			}
			.video3:nth-child(3n){
				margin-right: 0;
			}

			@media (max-width: 500px) {
				.wrapDiv1_r{
					width: 100%;
				}

				.video1{
					width: 100%;
					font-size: 0;
					margin-bottom: 20px;
				}
				.video1 video{
					width: 100%;
					height: 260px;
				}
				.video1 p{
					line-height: 32px;
					padding-left: 20px;
					box-sizing: border-box;
					font-size: 24px;
					color: #333333;
					background: #f7f7f7;
				}

				.video2{
					width: 46%;
					font-size: 0;
					margin-left: 2.66%;
					margin-bottom: 2.66%;
					display: inline-block;
				}
				.video2 video{
					width: 100%;
					height: 100px;
				}
				.video2 p{
					line-height: 35px;
					padding-left: 10px;
					box-sizing: border-box;
					font-size: 16px;
					color: #333333;
					background: #f7f7f7;
				}

				.video3{
					width: 46%;
					font-size: 0;
					margin-left: 2.66%;
					margin-bottom: 2.66%;
					display: inline-block;
					margin-right: 0;
				}
				.video3 video{
					width: 100%;
					height: 100px;
				}
				.video3 p{
					line-height: 35px;
					padding-left: 10px;
					box-sizing: border-box;
					font-size: 16px;
					color: #333333;
					background: #f7f7f7;
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
            <span>集团新闻</span>
            <p>Team introduction</p>
            <div class="wrapTitle_dh"><img src="<?=\Yii::getAlias('@themes_static')?>/basic/images/home.png" />走进方巨 > 集团新闻</div>
        </div>

        <div class="wrapDiv1">
            <div class="wrapDiv1_l video1">
                <video src="<?=isset($videos[0])?$videos[0]['url']:''?>" controls="controls"></video>
                <p><?=$videos[0]['title']?></p>
            </div>
            <div class="wrapDiv1_r">
                <?php foreach ($videos as $key => $item): ?>
                <?php if(0 === $key){continue;}elseif($key > 4 ){break;}  ?>
                <div class="video2">
                    <video src="<?=isset($item)?$item['url']:''?>" controls="controls"></video>
                    <p><?=$item['title']?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="wrapDiv2">
            <?php foreach ($videos as $key => $item): ?>
                <?php if($key < 4){continue;} ?>
                <div class="video3">
                    <video src="<?=isset($item)?$item['url']:''?>" controls="controls"></video>
                    <p><?=$item['title']?></p>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</div>
