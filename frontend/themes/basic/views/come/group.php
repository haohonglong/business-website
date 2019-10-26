<?php
use yii\helpers\Url;

$this->registerCssFile("@web/static/css/number.css");
$this->title = '集团介绍';
$images = \Yii::getAlias('@themes_static/basic/images');
$css = <<<CSS
.wrap{
				width: 1200px;
				margin: 0 auto;
				padding: 60px 0 0;
				font-size: 0;
			}

			.wrap1{
				padding-top: 60px;
				background: #f6f9ff url({$images}/bg5.png) no-repeat top left;
				background-size: 369px 440px;
			}

			.wrap > .wrap_div{
				width: 312px;
				height: auto;
				margin-left: 30px;
				margin-right: 60px;
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

			.wrap_text{
				width: 730px;
				text-align: justify;
				display: inline-block;
				font-size: 0;
			}
			.wrap_text span{
				width: 100%;
				display: block;
				font-size: 24px;
				color: #003894;
				margin-bottom: 16px;
				font-weight: bold;
			}
			.wrap_text p{
				width: 100%;
				display: block;
				font-size: 16px;
				color: #333333;
				line-height: 2;
				margin-bottom: 26px;
			}
CSS;

$this->registerCss($css);
?>

<!-- 内容 -->
<div class="container">
    <div class="wrapBanner1"><img src="<?=\Yii::getAlias('@themes_static')?>/basic/images/banner1.png"></div>
    <div class="wrap wrap1">
        <!-- <img src="../images/img1.png"> -->
        <div class="wrap_div">
            <img src="<?=\Yii::getAlias('@themes_static')?>/basic/images/logo.png">
            <p>Ten Innovative Enterprises <br>of Shared Economy in China</p>
            <span>中国共享经济十大创新企业</span>
        </div>
        <div class="wrap_text">
            <span>集团介绍</span>
            <p>重庆方巨科技集团是一家集互联网金融、电子商务、互联网IT、软件开发、生物医药、通讯科技、影视传媒、教育等实体经济产业支撑的“航母级”企业，集团已达100亿以上市值，方巨起航重庆，立志打造百年名企。</p>
            <p>集团创立以国家科技战略为导向，以创新体系建设夯实了集团发展水平的坚实基础和服务水平，以互联网思维、互联网+的商业模式，从而实现了科技创新、产品创新、管理创新、服务创新等方面极具竞争力的大型企业，在海内外享有良好的声誉，得到政府和社会的认可。</p>
            <p>集团以人工智能、大数据、智能制造、能源为核心战略。空气制水机、互联网远程医疗、数字党建等民生项目及产品独占世界鳌头，实现了科技价值的最大化。数字党建项目落地全国，逐步形成全国覆盖，行之有效的实现着党建进基层，发挥了振兴乡村、智慧乡村、服务民生的重要作用。集团被授予“中国共享经济十大创新企业”“中国市场信用AAA级信用企业”</p>
            <p>“领航中国，飞跃世界”，是方巨集团的现实驱动和未来畅想。集团在董事局主席李旭成“赢在思路，赢在改变”的思维体系带领下，为集团夯实了坚实的基础，致力于成为具有国际竞争力的知名产业集团。未来，方巨人将承载着荣耀与梦想，继往开来再续华章。</p>
        </div>
    </div>
</div>