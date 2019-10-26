<?php
use yii\helpers\Url;
$this->title = '团队介绍';
$css = <<<CSS
.wrap{
				width: 1200px;
				margin: 0 auto;
				/*padding: 60px 0 0;*/
				font-size: 0;
			}

			.wrapSwitch_div{
				width: 100%;

				display: flex;
				display: -webkit-flex;
				flex-direction: row;
				align-items: flex-start;
				justify-content: flex-start;
				flex-wrap: wrap;
			}

			.wrapSwitch_div img{
				width: 280px;
				height: 340px;
			}

			.wrapSwitch_div >div{
				margin-left: 40px;
			}
			.wrapSwitch_div >div span{
				font-size: 30px;
				color: #333333;
				margin-top: 30px;
				margin-bottom: 20px;
				display: block;
				font-weight: bold;
			}
			.wrapSwitch_div >div p{
				font-size: 16px;
				color: #333333;
				margin-bottom: 10px;
				position: relative;
			}

			.wrapSwitch_div >div p:after{
				content:'';
				position:absolute;
				right: 100%;
				top:50%;
				transform: translate(0,-50%);
				-webkit-transform:translate(0,-50%);
				width:0;height:0;border-width:4px;
				border-style:solid;
				border-color:transparent;
				border-left-width:8px;
				border-left-color:currentColor;
				color:#003894;
			}

			@media (max-width: 500px) {
				.wrapSwitch_div img{
					margin: 0 auto;
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
            <span>团队介绍</span>
            <p>Team introduction</p>
            <div class="wrapTitle_dh"><img src="<?=\Yii::getAlias('@themes_static')?>/basic/images/home.png" />走进方巨 > 团队介绍</div>
        </div>

        <div class="wrapSwitch">
            <div class="wrapSwitch_left">
                <li class="bubble">
                    <span>集团创始人</span>
                    <p>Founder of Group</p>
                </li>
            </div>
            <div class="wrapSwitch_right">
                <div class="wrapSwitch_div">
                    <img src="<?=\Yii::getAlias('@themes_static')?>/basic/images/img21.png">
                    <div>
                        <span>李旭成</span>
                        <p>中国商界杰出十大人物</p>
                        <p>中国商界杰出十大人物</p>
                        <p>中国商界杰出十大人物</p>
                        <p>中国商界杰出十大人物</p>
                        <p>中国商界杰出十大人物</p>
                        <p>中国商界杰出十大人物</p>
                    </div>
                </div>
                <!-- <img src="../images/img2.png" width="530" style="margin-bottom: 30px;"> -->
                <p>李旭成，方巨集团创始人、董事局主席。其人生旅途正如其名，桃“李”满天下，“旭”日东升，功“成”名就。 2002年李旭成从军中转战商界，白手起家，风雨十余载，创业中数不尽的困境与坎坷，他以军人坚毅与果敢的品质打下一片天地，成为行业翘楚，实现了从军中雄鹰到商界华丽的转变；打造了方巨集团这个以实体支撑，金融、生物医药、影视传媒、电子商务、通讯科技、教育、企业孵化等多元化商业帝国。</p>
                <p>李旭成专注经济动态及商业研究，担任高校及诸多集团公司顾问；李旭成擅长投资，其独到的投资理论体系和实践，在投资界名不虚传，堪称投资大咖。其已获得诸多荣誉：中国商界杰出十大人物、中国管理科学研究院研究员、经济学专家、著名演说家、中国青年创业导师；荣获 “全国五一行业劳动模范”、“重庆首届金融十大创新人物”、“2014重庆民营经济十大年度人物”等殊荣。概言之，李旭成是集思想家、著作家、投资家、慈善企业家于一身的楷模。</p>
            </div>
        </div>
    </div>
</div>



