<?php
use yii\helpers\Url;

$this->title = '企业建党';
$images = \Yii::getAlias('@themes_static/basic/images');
$this->registerJsFile(
    '@themes_static/basic/js/easySlider.js',
    ['depends' => [\frontend\themes\basic\assets\AppAsset::className()]]
);
$css = <<<CSS
.wrapDiv{
				width: 100%;
				padding: 20px calc((100% - 1200px) / 2);
				box-sizing: border-box;
				background: url({$images}/img12.png) no-repeat center;
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
				color: #bb1d21;
				margin-bottom: 10px;
				display: block;
			}
			.wrapDiv_text p{
				font-size: 15px;
				color: #bb1d21;
				line-height: 2;
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
			}
CSS;

$this->registerCss($css);
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
JS;
$this->registerJs($js,\yii\web\View::POS_END);
?>
<!-- 内容 -->
<div class="container">
    <div class="wrapBanner1"><img src="<?=\Yii::getAlias('@themes_static')?>/basic/images/banner1.png"></div>
    <div class="wrap">
        <div class="wrapTitle">
            <span>企业党建</span>
            <p>Team introduction</p>
            <div class="wrapTitle_dh"><img src="<?=\Yii::getAlias('@themes_static')?>/basic/images/home.png" />加入方巨 > 企业党建</div>
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
                <li><img src="<?=\Yii::getAlias('@themes_static')?>/basic/images/btn5.png" alt="previous"></li>
                <li><img src="<?=\Yii::getAlias('@themes_static')?>/basic/images/btn6.png" alt="next"></li>
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
</div>