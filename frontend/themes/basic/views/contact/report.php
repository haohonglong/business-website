<?php
use yii\helpers\Url;

$this->title = '廉洁举报';


$css = <<<CSS
.wrap_div{
				background: #f6f9ff;
				padding: 40px;
				box-sizing: border-box;
				width: 100%;
				/*font-size: 0;*/

				display: flex;
			    display: -webkit-flex;
			    flex-direction: row;
			    align-items: center;
			    justify-content: center;
			}
			.wrap_div img{
				width: 100%;
			}
			.wrap_div_l{
				width: 500px;
				height: auto;
				display: inline-block;
				margin-right: 40px;
			}
			.wrap_div_r{
				width: 580px;
				height: auto;
				display: inline-block;
			}
			.wrap_div_r p{
				font-size: 16px;
				color: #333333;
				line-height: 2;

				display: flex;
			    display: -webkit-flex;
			    flex-direction: row;
			    align-items: center;
			    justify-content: flex-start;
			}
			.wrap_div_r p img{
				width: 26px;
				height: auto;
				margin-right: 8px;
			}
			.wrap_div_r span{
				font-size: 16px;
				color: #333333;
				line-height: 2;
				display: block;
				padding-left: 30px;
			}

			.wrap_div_r_btn{
				width: 100px;
				line-height: 34px;
				text-align: center;
				color: #fff;
				background: #003894;
				border-radius: 5px;
				margin-top: 30px;
				margin-left: 30px;
			}

			@media (max-width: 500px) {
				.wrap_div{
					padding: 20px;
					flex-direction: column;
				}
				.wrap_div_l{
					width: 90%;
					margin: 0 auto;
				}
				.wrap_div_r{
					width: 90%;
					margin: 20px auto 0;
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
            <span>廉洁举报</span>
            <p>Team introduction</p>
            <div class="wrapTitle_dh"><img src="<?=\Yii::getAlias('@themes_static')?>/basic/images/home.png" />加入方巨 > 组织文化</div>
        </div>

        <div class="wrap_div">
            <div class="wrap_div_l"><img src="<?=\Yii::getAlias('@themes_static')?>/basic/images/img10.png" /></div>
            <div class="wrap_div_r">
                <p><img src="<?=\Yii::getAlias('@themes_static')?>/basic/images/icon20.png">举报范围</p>
                <span>“廉洁举报”仅限于对方巨员工违反《方巨集团商业行为准则》行为的举报。</span>
                <p><img src="<?=\Yii::getAlias('@themes_static')?>/basic/images/icon21.png">举报责任</p>
                <span>1.举报人应遵守国家法律法规，不得损害他人合法利益。<br>
							2.举报内容应当客观公正，不得捏造、歪曲事实，不得陷害他人。</span>
                <p><img src="<?=\Yii::getAlias('@themes_static')?>/basic/images/icon22.png">重要提示</p>
                <span>1.鼓励实名举报，我们承诺对实名举报的个人信息及举报内容严格保密，并对调查结果给予及时反馈。<br>
							2.举报人应尽可能说明事情的基本经过，并提供人利益或公司利益受到侵害的证据或其他有关资料。</span>

                <div class="wrap_div_r_btn">我要举报 ></div>
            </div>
        </div>
    </div>
</div>