<?php
use yii\helpers\Url;

$this->title = "企业公民";
$images = \Yii::getAlias('@themes_static/basic/images');
$css = <<<CSS
.wrapDiv{
				width: 100%;
				padding: 20px calc((100% - 1200px) / 2);
				box-sizing: border-box;
				background: url({$images}/img13.png) no-repeat center;
				background-size: auto 100%;
				font-size: 0;

				display: flex;
				display: -webkit-flex;
				flex-direction: row;
				align-items: center;
				justify-content: space-between;
				flex-wrap: wrap;
			}

			/*--------------SLIDER----------------*/
			#slider {
				width: 800px;
				height: 500px;
				display: inline-block;
			}
			.slides p{
				text-align: center;
				font-size: 16px;
				text-align: center;
				color: #333333;
				margin-top: 10px;
			}
			/*--------------CONTROLS--------------*/
			.controls li {
				width: 20px;
				height: 36px;
				bottom: 22px;
				z-index: 5;
			}
			.controls li img{
				width: 100%;
				height: 100%;
			}
			.controls li:nth-child(1) {
				left: 50px;
			}
			.controls li:nth-child(2) {
				right: 50px;
			}
			/*------------PAGINATION------------*/
			.pagination{
				height: 80px;
				width: 100%;
				background: rgba(0,0,0,0.6);
				position: absolute;
				left: 0;
				bottom: 0;
				z-index: 1;
				text-align: center;
				font-size: 0;
			}
			.pagination li {
				width: 100px;
				height: 60px;
				border: 2px solid #fff;
				box-sizing: border-box;
				margin: 10px 10px;
				display: inline-block;
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

			.wrapDiv_text{
				width: 370px;
			}
			.wrapDiv_text span{
				font-size: 18px;
				color: #fff;
				margin-bottom: 10px;
				display: block;
			}
			.wrapDiv_text p{
				font-size: 15px;
				color: #fff;
				line-height: 2;
			}

			.img14{
				width: 100%;
				height: 504px;
				font-size: 0;
				position: relative;
				z-index: 0;
				position: relative;
			}
			.img14 img{
				width: auto;
				height: 504px;
				position: absolute;
				left: 50%;
				top: 50%;
				transform: translate(-50%,-50%);
				-webkit-transform:translate(-50%,-50%);
			}
			.divtext{
				width: 1200px;
				font-size: 0;
				box-sizing: border-box;

				position: absolute;
				left: 50%;
				top: 50%;
				transform: translate(-50%,-50%);
				-webkit-transform:translate(-50%,-50%);
			}
			.divtext p{
				font-size: 18px;
				color: #333333;
				margin-bottom: 30px;
			}
			.divtext p font{
				font-size: 48px;
				color: #333;
			}

			.slides{
				height: 100%;
			}
			.slides li{
				height: 100%;
			}

			@media (max-width: 500px) {
				.wrapDiv{
					padding: 10px;
					width: 100%;
				}
				#slider{
					width: 100%;
					height: 200px;
				}
				.pagination{
					display: none;
				}
				.controls li{
					bottom: inherit;
					top: 50%;
					margin-top: -18px;
				}

				.controls li:nth-child(1) {
					left: 10px;
				}
				.controls li:nth-child(2) {
					right: 10px;
				}

				.wrapDiv_text{
					width: 100%;
					margin-top: 10px;
				}

				.img14 img{
					/*left: 30%;*/
				}

				.divtext{
					width: 90%;
				}
			}
CSS;

$this->registerCss($css);
$js = <<<JS
    $('.b-slide').carousel();
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
JS;
$this->registerJs($js,\yii\web\View::POS_END);
$this->registerJsFile(
    '@themes_static/basic/js/easySlider.js',
    ['depends' => [\frontend\themes\basic\assets\AppAsset::className()]]
);

?>

<!-- 内容 -->
<div class="container">
    <div class="wrapBanner1"><img src="<?=$images?>/banner1.png"></div>
    <div class="wrap">
        <div class="wrapTitle">
            <span>企业公民</span>
            <p>Team introduction</p>
            <div class="wrapTitle_dh"><img src="<?=$images?>/home.png" />走进方巨 > 企业公民</div>
        </div>
    </div>
    <div class="wrapDiv">
        <div id="slider">
            <ul class="slides">
                <?php foreach ($list['images'] as $item): ?>
                    <li><a href=""><img class="responsive" src="<?=$item?>"></a></li>
                <?php endforeach;?>
            </ul>
            <ul class="controls">
                <li><img src="<?=$images?>/btn5.png" alt="previous"></li>
                <li><img src="<?=$images?>/btn6.png" alt="next"></li>
            </ul>
            <ul class="pagination">
                <?php foreach ($list['images'] as $key => $item): ?>
                    <li class="<?php if(0 === $key) {echo 'active';}else{echo 'responsive';} ?>"><img class="responsive" src="<?=$item?>"></li>
                <?php endforeach;?>
            </ul>
        </div>

        <div class="wrapDiv_text">
            <span><?=$list['title']?></span>
            <p><?=$list['summary']?></p>
        </div>
    </div>
    <div class="img14">
        <img src="<?=$images?>/img14.png">
        <div class="divtext">
            <p>2008年起累计关爱</p>
            <p><font>15</font>个贫困孤残留守儿童代表实现了新年愿望</p>
            <p><font>6</font>个特困家庭带去了新年礼物与慰问</p>
            <p><font>203</font>名孤残贫困留守儿童实现了新年愿望</p>
        </div>
    </div>
    <!-- <div class="img15"><img src="../images/img15.png"></div> -->
</div>