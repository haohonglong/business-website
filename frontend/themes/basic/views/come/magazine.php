<?php
use yii\helpers\Url;

$this->title = "企业年志";
$images = \Yii::getAlias('@themes_static/basic/images');
$css = <<<CSS
.img3{
				display: block;
			}
			.img4{
				display: none;
			}

			.wrapDiv{
				width: 100%;
				height: auto;
				position: relative;

				padding: 30px 0;

				background: url({$images}/bg6.png) no-repeat bottom center;
			}

			.wrapDiv_l{
				width: 50%;
				display: inline-block;
				margin-right: calc(50% - 40px);
				margin-left:40px;
				text-align: right;

				display: flex;
				display: -webkit-flex;
				flex-direction: row;
				align-items: center;
				justify-content: flex-start;

				padding: 30px 0;
				position: relative;
				z-index: 3;
			}
			.wrapDiv_l_t{
				width: calc(100% - 100px);
				font-size: 14px;
				color: #333333;
				margin-right: 20px;
			}
			.wrapDiv_l_i{
				width: 80px;
				height: 80px;
				line-height: 70px;
				text-align: center;
				border-radius: 50%;
				border: 5px solid #dfdfdf;
				color: #003894;
				font-size: 24px;
				box-sizing: border-box;
				background: #fff;
			}
			.wrapDiv_r{
				width: 50%;
				display: inline-block;
				margin-left: calc(50% - 40px);
				text-align: left;

				display: flex;
				display: -webkit-flex;
				flex-direction: row;
				align-items: center;
				justify-content: flex-start;

				padding: 30px 0;
				position: relative;
				z-index: 3;
			}
			.wrapDiv_r_t{
				width: calc(100% - 100px);
				font-size: 14px;
				color: #333333;
				margin-left: 20px;
			}
			.wrapDiv_r_i{
				width: 80px;
				height: 80px;
				line-height: 70px;
				text-align: center;
				border-radius: 50%;
				border: 5px solid #dfdfdf;
				color: #003894;
				font-size: 24px;
				box-sizing: border-box;
				background: #fff;
			}

			.bg{
				width: 1px;
				height: 70%;
				background: #003894;
				position: absolute;
				left: 50%;
				top: 50%;
				transform: translate(-50%,-50%);
				-webkit-transform:translate(-50%,-50%);
				z-index: 1;
			}

			@media (max-width: 500px) {
				.img3{
					display: none;
				}
				.img4{
					display: block;
				}

				.wrapDiv{
					padding: 0;
				}
				.wrapDiv_r{
					width: 90%;
					margin: 0 auto;
				}
				.bg{
					left: calc(5% + 40px);
				}
			}
CSS;

$this->registerCss($css);
?>



<!-- 内容 -->
<div class="container">
    <div class="wrapBanner1"><img src="<?=$images?>/banner1.png"></div>
    <div class="wrap">
        <div class="wrapTitle">
            <span>企业年志</span>
            <p>Team introduction</p>
            <div class="wrapTitle_dh"><img src="<?=$images?>/home.png" />走进方巨 > 企业年志</div>
        </div>
        <!-- <img src="../images/img3.jpg" class="img3" /> -->
        <!-- <img src="../images/img4.jpg" class="img4" /> -->
    </div>
    <div class="wrapDiv img3">
        <div class="bg"></div>

        <div class="wrapDiv_l">
            <div class="wrapDiv_l_t">
                3月重庆通贷投资有限公司荣获“2014年度消费维权诚信单位”<br>
                3月荣获“2014年度消费维权诚信单位”<br>
                8月13日中国首家综合性互联网金融平台“通通贷”平台上线暨新闻发布
            </div>
            <div class="wrapDiv_l_i">2015</div>
        </div>

        <div class="wrapDiv_r">
            <div class="wrapDiv_r_i">2015</div>
            <div class="wrapDiv_r_t">
                3月重庆通贷投资有限公司荣获“2014年度消费维权诚信单位”<br>
                3月荣获“2014年度消费维权诚信单位”<br>
                8月13日中国首家综合性互联网金融平台“通通贷”平台上线暨新闻发布
            </div>
        </div>

        <div class="wrapDiv_l">
            <div class="wrapDiv_l_t">
                3月重庆通贷投资有限公司荣获“2014年度消费维权诚信单位”<br>
                3月荣获“2014年度消费维权诚信单位”<br>
                8月13日中国首家综合性互联网金融平台“通通贷”平台上线暨新闻发布
            </div>
            <div class="wrapDiv_l_i">2015</div>
        </div>
    </div>

    <div class="wrapDiv img4">
        <div class="bg"></div>

        <div class="wrapDiv_r">
            <div class="wrapDiv_r_i">2015</div>
            <div class="wrapDiv_r_t">
                3月重庆通贷投资有限公司荣获“2014年度消费维权诚信单位”<br>
                3月荣获“2014年度消费维权诚信单位”<br>
                8月13日中国首家综合性互联网金融平台“通通贷”平台上线暨新闻发布
            </div>
        </div>

        <div class="wrapDiv_r">
            <div class="wrapDiv_r_i">2015</div>
            <div class="wrapDiv_r_t">
                3月重庆通贷投资有限公司荣获“2014年度消费维权诚信单位”<br>
                3月荣获“2014年度消费维权诚信单位”<br>
                8月13日中国首家综合性互联网金融平台“通通贷”平台上线暨新闻发布
            </div>
        </div>

        <div class="wrapDiv_r">
            <div class="wrapDiv_r_i">2015</div>
            <div class="wrapDiv_r_t">
                3月重庆通贷投资有限公司荣获“2014年度消费维权诚信单位”<br>
                3月荣获“2014年度消费维权诚信单位”<br>
                8月13日中国首家综合性互联网金融平台“通通贷”平台上线暨新闻发布
            </div>
        </div>
    </div>
</div>
