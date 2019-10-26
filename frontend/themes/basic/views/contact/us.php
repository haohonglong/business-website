<?php

use frontend\models\Company;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Options;

$info_arr = Company::getInfo();
$this->title = '联系我们';
$css = <<<CSS
.wrapDiv1{
				width: 100%;
				font-size: 0;
				background: #f6f9ff;
				padding: 35px 0;
			}
			.wrapDiv1_l{
				width: 420px;
				margin-left: 40px;
				margin-right: 50px;
				vertical-align: top;
				display: inline-block;
				margin-top: 20px;
			}
			.wrapDiv1_l > p{
				font-size: 16px;
				color: #333333;
				line-height: 1;
				margin-bottom: 20px;
			}
			.wrapDiv1_l .wrapDiv1_l_div{
				width: 100%;
				font-size: 0;

				display: flex;
			    display: -webkit-flex;
			    flex-direction: row;
			    align-items: center;
			    justify-content: space-between;
			}
			.wrapDiv1_l .wrapDiv1_l_div > div{
				width: 120px;
				display: inline-block;
			}
			.wrapDiv1_l .wrapDiv1_l_div > div p{
				width: 120px;
				text-align: center;
				color: #333333;
				font-size: 15px;
			}
			.wrapDiv1_l .wrapDiv1_l_div > div img{
				width: 70px;
				height: auto;
				display: block;
				margin: 10px auto;
			}
			.wrapDiv1_l .wrapDiv1_l_div > div span{
				width: 120px;
				text-align: center;
				display: block;
				color: #003894;
				font-size: 15px;
			}
			.wrapDiv1_r{
				width: 650px;
				height: 500px;
				display: inline-block;
			}
			.wrapDiv1_r img{
				width: 100%;
			}

			.wrapDiv2{
				width: 100%;
				font-size: 0;
				background: #f6f9ff;
				padding: 35px 0;

				display: flex;
				display: -webkit-flex;
				flex-direction: row;
				align-items: center;
				justify-content: center;
				flex-wrap: wrap;
			}

			.wrapDiv2_title{
				width: 100%;
				font-size: 24px;
				color: #333333;
				text-align: center;
				margin-bottom: 30px;
			}

			.wrapDiv2_input{
				width: 340px;
				min-height: 40px;
				border: 1px solid #e3e1e1;
				background: #fff;

				display: inline-flex;
			    display: -webkit-inline-flex;
			    flex-direction: row;
			    align-items: center;
			    justify-content: flex-start;
			    margin: 0 6px;
			    margin-bottom: 10px;
			}

			.wrapDiv2_input img{
				width: 20px;
				height: auto;
				margin-left: 12px;
				margin-right: 10px;
			}
			.wrapDiv2_input input{
				width: 300px;
				height: 40px;
				color: #000;
			}

			.wrapDiv3_input{
				min-height: 40px;
				border: 1px solid #e3e1e1;
				background: #fff;

				display: inline-flex;
			    display: -webkit-inline-flex;
			    flex-direction: row;
			    justify-content: flex-start;
			    margin: 0 6px;
			    margin-bottom: 10px;


			    width: 1048px; 
			    align-items: flex-start; 
			    padding: 10px 0;
			}
			.wrapDiv3_input textarea{
				width: 1000px;
				height: 200px;
				border: none;
				color: #000;
			}
			.wrapDiv3_input img{
				width: 20px;
				height: auto;
				margin-left: 12px;
				margin-right: 10px;
			}
			.wrapDiv2_btn{
				width: 1048px;
				line-height: 50px;
				text-align: center;;
				background: #003894;
				color: #fff;
				font-size: 18px;
				margin: 20px auto 0;
			}
			.wrapDiv2_btn button{
			    background: none;
			    border: none;
			    color: #fff;
				font-size: 18px;
				display: inline-block;
				width: 100%;
				height: 100%;
				line-height: inherit;
				
			}

			@media (max-width: 500px) {
				.wrapDiv1_l {
				    width: 100%;
				    margin-left: 0;
				    margin-right: 0;
				    display: inline-block;
				    margin-top: 20px;
				    padding: 0 20px;
				    box-sizing: border-box;
				}

				.wrapDiv1_l > p {
				    font-size: 16px;
				    color: #333333;
				    line-height: 1.5;
				    margin-bottom: 10px;
				}

				.wrapDiv1_l .wrapDiv1_l_div > div {
				    width: 33.33%;
				    display: inline-block;
				}

				.wrapDiv1_l .wrapDiv1_l_div > div p {
				    width: 120px;
				    text-align: center;
				    color: #333333;
				    font-size: 12px;
				}
				.wrapDiv1_l .wrapDiv1_l_div > div span {
				    font-size: 12px;
				}

				.wrapDiv1_r{
					width: 90%;
					margin: 0 5%;
				}

				.wrapDiv2{
					padding: 0;
				}

				.wrapDiv2_input{
					width: 90%;
					margin: 0 auto 10px;
				}

				.wrapDiv3_input{
					width: 90%;
					margin: 0 auto 10px;
				}

				.wrapDiv2_btn{
					width: 90%;
					margin-bottom: 20px;
				}
			}
CSS;

$this->registerCss($css);
$city = \common\models\CityModel::getCityByName('重庆市');
$baidu_map_ak = Options::getInfoByName('baidu_map_ak');
$this->registerJsFile(
    '//api.map.baidu.com/api?v=2.0&ak='.$baidu_map_ak->value,
    ['depends' => [\frontend\themes\basic\assets\AppAsset::className()]]
);

?>

<script type="text/javascript">
    <?php $this->beginBlock('js'); ?>
    // 百度地图API功能
    var map = new BMap.Map("allmap");    // 创建Map实例
    map.centerAndZoom(new BMap.Point(<?=$city['LNG']?>, <?=$city['LAT']?>), 11);  // 初始化地图,设置中心点坐标和地图级别
    //添加地图类型控件
    map.addControl(new BMap.MapTypeControl({
        mapTypes:[
            BMAP_NORMAL_MAP,
            BMAP_HYBRID_MAP
        ]}));
    map.centerAndZoom("<?=$info_arr['address']?>",12);
    map.setCurrentCity("<?=$city['CITY_NAME']?>");          // 设置地图显示的城市 此项是必须设置的
    map.enableScrollWheelZoom(true);     //开启鼠标滚轮缩放
    <?php $this->endBlock(); ?>
</script>
<?php $this->registerJs($this->blocks['js'],\yii\web\View::POS_END); ?>
<!-- 内容 -->
<div class="container">
    <div class="wrap">
        <div class="wrapTitle">
            <span>联系我们</span>
            <p>Team introduction</p>
            <div class="wrapTitle_dh"><img src="<?=\Yii::getAlias('@themes_static')?>/basic/images/home.png" />加入方巨 > 组织文化</div>
        </div>
        <div class="wrapDiv1">
            <div class="wrapDiv1_l">
                <p><?=$info_arr['company']?></p>
                <p>电话：<?=$info_arr['phone']?></p>
                <p>传真：<?=$info_arr['fax']?></p>
                <p>邮箱：<?=$info_arr['email']?></p>
                <p>地址：<?=$info_arr['address']?></p>
                <div class="wrapDiv1_l_div">
                    <div>
                        <p>全国免费咨询电话</p>
                        <img src="<?=\Yii::getAlias('@themes_static')?>/basic/images/icon3.png" />
                        <span>400-000-0000</span>
                    </div>
                </div>
            </div>
            <div class="wrapDiv1_r" id="allmap"></div>
        </div>

        <div class="wrapDiv2">
            <div class="wrapDiv2_title">留言板</div>
            <?php $form = ActiveForm::begin() ?>
            <div class="wrapDiv2_input"><img src="<?=\Yii::getAlias('@themes_static')?>/basic/images/icon11.png"><input type="text" name="GuestbookForm[username]" placeholder="姓名"></div>
            <div class="wrapDiv2_input"><img src="<?=\Yii::getAlias('@themes_static')?>/basic/images/icon12.png"><input type="text" name="GuestbookForm[phone]" placeholder="电话"></div>
            <div class="wrapDiv2_input"><img src="<?=\Yii::getAlias('@themes_static')?>/basic/images/icon13.png"><input type="text" name="GuestbookForm[email]" placeholder="邮箱"></div>
            <div class="wrapDiv3_input"><img src="<?=\Yii::getAlias('@themes_static')?>/basic/images/icon14.png"><textarea name="GuestbookForm[content]" placeholder="留言"></textarea></div>
            <div class="wrapDiv2_btn"><button type="submit">发生</button></div>
            <?php ActiveForm::end() ?>
        </div>

    </div>
</div>