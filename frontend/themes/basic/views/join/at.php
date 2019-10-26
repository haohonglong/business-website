<?php
use yii\helpers\Url;
$this->title = "组织文化";
$images = \Yii::getAlias('@themes_static/basic/images');
$css = <<<CSS
    /*--------------SLIDER----------------*/
			#slider {
				width: 100%;
				height: 570px;
				margin: 0 auto;
				padding-left: 280px;
				box-sizing: border-box;
				position: relative;
			}
			.sliderDiv1{
				width: 100%;
				padding: 20px calc((100% - 1200px) / 2);
				box-sizing: border-box;
				background: url({$images}/myImg2.png) no-repeat center;
				background-size: auto 100%;
			}
			.sliderDiv2{
				width: 100%;
				padding: 20px calc((100% - 1200px) / 2);
				box-sizing: border-box;
				background: url({$images}/myImg1.png) no-repeat center;
				background-size: auto 100%;
			}

			#slider2 {
				width: 100%;
				height: 570px;
				margin: 0 auto;
				padding-right: 280px;
				box-sizing: border-box;
				position: relative;
				overflow: hidden;
			}

			.slides{
				height: 100%;
			}
			.slides li{
				height: 100%;
				position: relative;
			}
			/*--------------CONTROLS--------------*/
			/*position controls*/
			.controls li {
				width: 260px;
				height: 45px;
				z-index: 9;
			}
			.controls li:nth-child(1) {
				left: 0;
				top: 0;
			}
			.controls li:nth-child(2) {
				left: 0;
				bottom: 0;
			}
			/*------------PAGINATION------------*/
			/*style pagination*/
			.pagination{
				position: absolute;
				width: 260px;
				height: 480px;
				overflow: hidden;
			}
			.pagination li {
				border: 2px solid #fff;
				background-color: #ddd;
				box-sizing: border-box;
				height: 135px;
				margin-top: 19px;
			}

			.pagination li.active {
				background-color: #000;
				border: 2px solid #ba946f;
			}
			/*-------------HELPERS----------------*/
			.responsive {
				width: 100%;
				height: 100%;
			}
			.clearfix:after {
				content: "";
				display: table;
				clear: both;
			}
			img {
				display: block;
			}
			.sliderBg1{
				position: absolute;
				width: 20px;
				height: 100%;
 				left: 260px;
				top: 0;
				z-index: 2;
			}
			.sliderBg2{
				position: absolute;
				width: 20px;
				height: 100%;
 				right: 260px;
				top: 0;
				z-index: 2;
			}

			.slides2{
				height: 100%;
			}
			.slides2 li{
				height: 100%;
				position: relative;
			}
			/*--------------CONTROLS--------------*/
			/*position controls*/
			.controls2 li {
				width: 260px;
				height: 45px;
				z-index: 9;
			}
			.controls2 li:nth-child(1) {
				right: 0;
				top: 0;
			}
			.controls2 li:nth-child(2) {
				right: 0;
				bottom: 0;
			}
			/*------------PAGINATION------------*/
			/*style pagination*/
			.pagination2{
				position: absolute;
				width: 260px;
				height: 480px;
				overflow: hidden;
			}
			.pagination2 li {
				border: 2px solid #fff;
				background-color: #ddd;
				box-sizing: border-box;
				height: 135px;
				margin-top: 19px;
			}

			.pagination2 li.active {
				background-color: #000;
				border: 2px solid #ba946f;
			}

			.responsiveText{
				width: 100%;
				position: absolute;
				bottom: 0;
				left: 0;
				background: rgba(0,0,0,0.6);
				color: #fff;
				text-align: center;
				line-height: 40px;
				font-size: 16px;
			}

			@media (max-width: 500px) {
				.controls{
					display: none;
				}
				.controls2{
					display: none;
				}
				.pagination{
					display: none;
				}
				.pagination2{
					display: none;
				}

				.sliderDiv1{
					width: 100%;
					padding: 10px;
				}
				.sliderDiv2{
					width: 100%;
					padding: 10px;
				}

				#slider{
					padding: 0;
					height: 200px;
				}
				#slider2{
					padding: 0;
					height: 200px;
				}

				.sliderBg1{
					display: none;
				}
				.sliderBg2{
					display: none;
				}
			}
CSS;

$this->registerCss($css);

$this->registerJsFile(
    '@themes_static/basic/js/easySlider.js',
    ['depends' => [\frontend\themes\basic\assets\AppAsset::className()]]
);

$js = <<<JS
    $("#slider").easySlider( {
				slideSpeed: 500,
				autoSlide: true,
				paginationSpacing: "15px",
				paginationDiameter: "10px",
				paginationPositionFromBottom: "0px",
				slidesClass: ".slides",
				controlsClass: ".controls",
				paginationClass: ".pagination"					
			});

			// 
			$("#slider2").easySlider( {
				slideSpeed: 500,
				autoSlide: true,
				paginationSpacing: "15px",
				paginationDiameter: "10px",
				paginationPositionFromBottom: "0px",
				slidesClass: ".slides2",
				controlsClass: ".controls2",
				paginationClass: ".pagination2"					
			});
JS;
$this->registerJs($js,\yii\web\View::POS_END);

$teamwork = \common\models\Options::getBannersByType('teamwork');
$staff_activities = \common\models\Options::getBannersByType('staff_activities');

?>

<!-- 内容 -->
<div class="container">
    <div class="wrapBanner1"><img src="<?=$images?>/banner1.png"></div>
    <div class="wrap">
        <div class="wrapTitle">
            <span>我在方巨</span>
            <p>Team introduction</p>
            <div class="wrapTitle_dh"><img src="<?=$images?>/home.png" />加入方巨 > 组织文化</div>
        </div>
    </div>
    <?php if(!empty($teamwork)): ?>
    <div class="sliderDiv2">
        <div id="slider2">
            <ul class="slides2">
                <?php foreach ($teamwork as $item): ?>
                <li><a href="<?=$item['link']?>"><img class="responsive" src="<?=$item['img']?>"><p class="responsiveText"><?=$item['desc']?></p></a></li>
                <?php endforeach; ?>
            </ul>
            <ul class="controls2">
                <li><img src="<?=$images?>/btn1.png" alt="previous" style="right: 0; top: 0;"></li>
                <li><img src="<?=$images?>/btn2.png" alt="next" style="right: 0; top: 0;"></li>
            </ul>
            <ul class="pagination2" style="background: #008eb2; top: 45px; right: 0;">
                <?php foreach ($teamwork as $key => $item): ?>
                    <li <?php if(0 === $key) echo 'class="active"'; ?>><a href="<?=$item['link']?>"><img class="responsive" src="<?=$item['img']?>"><p class="responsiveText"><?=$item['desc']?></p></a></li>
                <?php endforeach; ?>
            </ul>
            <div class="sliderBg2" style="background: #008eb2;"></div>
        </div>
    </div>
    <?php endif; ?>
    <?php if(!empty($staff_activities)): ?>
    <div class="sliderDiv1">
        <div id="slider">
            <ul class="slides">
                <?php foreach ($staff_activities as $item): ?>
                    <li><a href="<?=$item['link']?>"><img class="responsive" src="<?=$item['img']?>"><p class="responsiveText"><?=$item['desc']?></p></a></li>
                <?php endforeach; ?>
            </ul>
            <ul class="controls" style="width: 100%;">
                <li><img src="<?=$images?>/btn1.png" alt="previous" style="left: 0; top: 0;"></li>
                <li><img src="<?=$images?>/btn2.png" alt="next" style="left: 0; bottom: 0;"></li>
            </ul>
            <ul class="pagination" style="background: #00b2b2; top: 45px; left: 0;">
                <?php foreach ($staff_activities as $key => $item): ?>
                    <li <?php if(0 === $key) echo 'class="active"'; ?>><a href="<?=$item['link']?>"><img class="responsive" src="<?=$item['img']?>"><p class="responsiveText"><?=$item['desc']?></p></a></li>
                <?php endforeach; ?>
            </ul>
            <div class="sliderBg1" style="background: #00b2b2;"></div>
        </div>
    </div>
    <?php endif; ?>

</div>