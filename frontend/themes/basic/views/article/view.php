<?php
/**
 * @var $this yii\web\View
 * @var $model frontend\models\Article
 * @var $commentModel frontend\models\Comment
 * @var $prev frontend\models\Article
 * @var $next frontend\models\Article
 * @var $recommends array
 * @var $commentList array
 */

use frontend\widgets\ArticleListView;
use yii\data\ArrayDataProvider;
use yii\helpers\Url;
use frontend\assets\ViewAsset;
use common\widgets\JsBlock;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = $model->title;

$this->registerMetaTag(['name' => 'keywords', 'content' => $model->seo_keywords], 'keywords');
$this->registerMetaTag(['name' => 'description', 'content' => $model->seo_description], 'description');
$this->registerMetaTag(['name' => 'tags', 'content' => call_user_func(function()use($model) {
    $tags = '';
    foreach ($model->articleTags as $tag) {
        $tags .= $tag->value . ',';
    }
    return rtrim($tags, ',');
}
)], 'tags');
$this->registerMetaTag(['property' => 'article:author', 'content' => $model->author_name]);
$categoryName = $model->category ? $model->category->name : Yii::t('app', 'uncategoried');
$css = <<<CSS
.wrap > .wrap_div{
				width: 312px;
				height: auto;
				margin-left: 30px;
				margin-right: 58px;
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
			.wrap_newsText{
				width: 800px;
				display: inline-block;
			}
			.wrap_newsText_t{
				width: 100%;
				height: 109px;
				border-bottom: 2px solid #e6edf7;

				display: flex;
			    display: -webkit-flex;
			    flex-direction: column;
			    align-items: flex-start;
			    justify-content: center;

			    position: relative;
			    z-index: 0;
			}
			.wrap_newsText_t span{
				width: 100%;
				font-size: 22px;
				color: #000000;
			}
			.wrap_newsText_t p{
				width: 100%;
				font-size: 14px;
				color: #757575;
			}
			.wrap_newsText_t img{
				width: 60px;
				position: absolute;
				right: 20px;
		        top: 50%;
		        transform: translate(0,-50%);
		        -webkit-transform:translate(0,-50%);
			}
			.wrap_newsText_b{
				width: 100%;
			    padding: 20px;
			    box-sizing: border-box;
			    font-size: 16px;
			    line-height: 2;
			    color: #333333;
			}
			.wrap_newsText_b img {
			    width: 550px;
			    display: block;
			    margin: 10px auto;
			}
			.wrap_newsText_c{
				width: 100%;
			    padding: 20px;
			    box-sizing: border-box;
				border-top: 2px solid #e6edf7;
			}
			.wrap_newsText_c > div{
				font-size: 16px;
			    color: #000000;
			    line-height: 2;
			}
			.wrap_newsText_c > div a{
				font-size: 16px;
			    color: #000000;
			}

			.code{
				font-size: 15px;
				color: #333333;
				margin: 15px 0;
			}
			.code img{
				width: 80px;
				height: 80px;
				margin-top: 8px;
				margin-left: 18px;
				display: block;
			}

			@media (max-width: 500px) {
				.wrap_newsText{
					width: 100%;
				}
				.wrap_newsText_t img{
					display: none;
				}

				.wrap_newsText_t{
					padding: 20px;
					box-sizing: border-box;
				}
				.wrap_newsText_b img{
					width: 100%;
				}
			}
CSS;

$this->registerCss($css);

?>
<!-- 内容 -->
<div class="container">
    <div class="wrapBanner1"><img src="<?=\Yii::getAlias('@themes_static')?>/basic/images/banner1.png"></div>
    <div class="wrap" style="background: #f6f9ff;">
        <div class="wrapTitle">
            <span>集团新闻</span>
            <p>Team introduction</p>
            <div class="wrapTitle_dh"><img src="<?=\Yii::getAlias('@themes_static')?>/basic/images/home.png" />走进方巨 > 集团新闻</div>
        </div>
        <!-- <img src="../images/img6.png"> -->
        <div class="wrap_div">
            <img src="<?=\Yii::getAlias('@themes_static')?>/basic/images/logo.png">
            <p>Ten Innovative Enterprises <br>of Shared Economy in China</p>
            <span>中国共享经济十大创新企业</span>

            <div class="code">
                您可以关注我们的微信公众号<br>
                及时获取更多信息
                <img src="<?=\Yii::getAlias('@themes_static')?>/basic/images/code.jpg">
            </div>
        </div>
        <div class="wrap_newsText">
            <div class="wrap_newsText_t">
                <span><?= $model->title ?></span>
                <p>2019.08.19</p>
                <img src="<?=\Yii::getAlias('@themes_static')?>/basic/images/rd-leftbtn-hover.png">
            </div>
            <div class="wrap_newsText_b">
                <?= $model->articleContent->content ?>
            </div>
            <div class="wrap_newsText_c">
                <?php if(isset($prev->id)): ?>
                    <div>上一篇：<a href="<?= Url::to(['article/view','id'=>$prev->id])?>"><?= $prev->title?></a></div>
                <?php endif; ?>

                <?php if(isset($next->id)): ?>
                    <div>下一篇：<a href="<?= Url::to(['article/view','id'=>$next->id])?>"><?= $next->title?></a></div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>
