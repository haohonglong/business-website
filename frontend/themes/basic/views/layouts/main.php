<?php
/* @var $this \yii\web\View */
/* @var $content string */

use common\models\Options;
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\widgets\MenuView;
use frontend\models\Menu;
use frontend\models\FriendlyLink;

\frontend\themes\basic\assets\AppAsset::register($this);
$menus = Menu::getFrontMenus();
$friendlyLink = FriendlyLink::getAll();
$logo = Options::getInfoByName('logo');
$wechat = Options::getInfoByName('wechat');
$weibo = Options::getInfoByName('weibo');
$js = <<<JS
    $(document).ready(function() {
				//侧边栏兼容
				if($(window).width() < 1680) {
					$(".indexwarp").css({
						"width": "100%"
					});
				}
			});
$('.b-slide').carousel();
JS;
$this->registerJs($js,\yii\web\View::POS_END);


?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml" lang="<?= Yii::$app->language ?>">
    <head>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <?php !isset($this->metaTags['keywords']) && $this->registerMetaTag(['name' => 'keywords', 'content' => Yii::$app->feehi->seo_keywords], 'keywords');?>
        <?php !isset($this->metaTags['description']) && $this->registerMetaTag(['name' => 'description', 'content' => Yii::$app->feehi->seo_description], 'description');?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="renderer" content="webkit" />
        <meta name="viewport" content="width=device-width, initial-scale=1  user-scalable=no"/>
        <meta name="format-detection" content="telephone=no" />
        <meta charset="<?= Yii::$app->charset ?>">
        <?= Html::csrfMetaTags() ?>
    </head>
    <?php $this->beginBody() ?>
    <body>

    <div class="indexwarp">
        <div class="headrange">
            <!--公共头部-->
            <div class="header">
                <div class="w1200 pr">
                    <a href="/" class="logo" style="background: none;">
                        <img src="<?=$logo->value?>" alt="<?=$logo->tips ?>" style="width: 100%;" />
                    </a>
                    <div class="stock"></div>
                    <div class="headlink">
                        <a href="javascript:;" class="icon-search" rel="nofollow">
                            <div class="header-search">
                                <input type="text" value="" class="hs-input" placeholder="关键词输入..." />
                                <input type="button" value="" class="hs-submit" />
                            </div>
                        </a>

                        <a href="javascript:void(0);" class="icon-menu" rel="nofollow"></a>
                    </div>
                    <div class="nav">
                        <ul>
                            <?php $total = count($menus); ?>
                            <?php foreach ($menus as $k=> $item):?>
                            <?php $className = ($k === $total-1) ?  'last' : '' ?>
                            <li class="<?=$className?>">
                                <a href="<?=  0 ===$k ? '/' : 'javascript:void(0);'; ?>"><?=$item['name']?></a>
                            </li>
                            <?php endforeach; ?>
                            <span class="navline"></span>
                        </ul>
                    </div>

                </div>
            </div>
            <!--公共头部-->
<?php
$ids = [
    '走进方巨'=>'sN1',
    '旗下产品'=>'sN2',
    '新闻中心'=>'sN3',
    '加入方巨'=>'sN4',
    '联络方巨'=>'sN6',
];
?>
            <div class="innavbg suNav">
                <div class="sNav w1200 pr">
                    <div></div>
                    <?php foreach ($menus as $item):?>
                    <?php if(!array_key_exists($item['name'],$ids)){continue;} ?>
                    <div <?php if(array_key_exists($item['name'],$ids)){echo "class='{$ids[$item['name']]}'";}?>" style="display: none;">
                        <dl class="innav">
                            <?php foreach ($item['children'] as $v):?>
                            <dd>
                                <?php if('javascript:void(0);' === trim($v['url'])) :?>
                                    <a href="javascript:void(0);"><?=$v['name']?></a>
                                <?php else: ?>
                                    <a href="<?=Url::to([$v['url']])?>"><?=$v['name']?></a>
                                <?php endif; ?>

                            </dd>
                            <?php endforeach; ?>
                        </dl>
                    </div>
                    <?php endforeach; ?>

                </div>
            </div>

        </div>

        <?=$content ?>

        <!--公共底部-->
        <div class="footer" id="footer">
            <div class="w1200 footer-main clearfix">
                <!-- 备注 -->
                <div class="cpbox fl">
                    <div class="copy" style="width: inherit;">
                        <p style="font-size: 14px;"><?=Yii::$app->feehi->website_icp?></p>
                        <p>
                            <a href="http://www.beian.miit.gov.cn/" target="_blank" style="color:rgba(255,255,255,0.9);" rel="nofollow">渝ICP备05003852号</a>
                            <!--&nbsp;&nbsp;重庆龙湖地产发展有限公司&nbsp;&nbsp;重庆市渝北区天山大道西段32号A幢&nbsp;&nbsp;023-67732108-->
                        </p>
                    </div>

                    <div class="attent fl">

                        <a href="javascript:void(0);" class="wx" rel="nofollow">
                            <div class="indexewm">
                                <img src="<?=\Yii::getAlias('@themes_static')?>/basic/picture/ewm.jpg" height="152" width="152" />
                            </div>
                        </a>
                        <a href="<?=$weibo->value?>" target="_blank" class="wb" rel="nofollow"></a>

                    </div>
                </div>
                <!-- 链接 -->
                <div class="linkbox fr">
                    <div class="links">
                        <a href="https://ioa.longhu.net" target="_blank" rel="nofollow">法律声明</a>
                        <a href="/contact/36/" rel="nofollow">廉洁举报</a>
                        <a href="/contact/34/" rel="nofollow">服务热线</a>
                        <a href="/contact/36/" rel="nofollow">联系电话</a>
                    </div>
                    <div class="links">
                        <p style="color: #fff; text-align: left; padding-left: 15px; box-sizing: border-box;">友情链接：
                            <?php foreach ($friendlyLink as $item):?>
                                <a href="<?=$item['url']?>"><?=$item['name']?></a>
                            <?php endforeach;?>
                        </p>
                    </div>
                </div>
            </div>

            <div id="side-mask"></div>

            <div class="side-box">
                <a href="javascript:void(0);" class="side-close"></a>
                <h3 class="side-title">网站地图</h3>
                <?php foreach ($menus as $k=> $item):?>
                <?php if(0 === $k) continue; ?>
                <dl class="side-dl">
                    <dt><a href="javascript:;"><?=$item['name']?></a></dt>
                    <?php foreach ($item['children'] as $v):?>
                        <?php if('javascript:void(0);' === trim($v['url'])) :?>
                            <dd>
                                <a href="javascript:void(0);"><?=$v['name']?></a>
                            </dd>
                        <?php else: ?>
                            <dd>
                                <a href="<?=Url::to([$v['url']])?>"><?=$v['name']?></a>
                            </dd>
                        <?php endif; ?>

                    <?php endforeach; ?>

                </dl>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    </body>
    <?php $this->endBody() ?>
    </html>
<?php $this->endPage() ?>