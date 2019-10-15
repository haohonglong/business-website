<?php
/* @var $this \yii\web\View */
/* @var $content string */

use frontend\models\Banner;
use yii\helpers\Html;
use frontend\assets\AppAsset;
use yii\helpers\Url;
use frontend\widgets\MenuView;
use frontend\models\Menu;
use frontend\models\FriendlyLink;
use yii\web\View;

AppAsset::register($this);
$menus = Menu::getFrontMenus();
$friendlyLink = FriendlyLink::getAll();
$logo = Banner::getLogo();
$js = <<<JS
    (function(){
                //获取到按钮和对应显示隐藏的标签
                var btn = document.getElementById('show_tiggle');
                var box = document.getElementById('tiggle');
                //初始化时间
                var timer = null; 
                //鼠标移入按钮时候显示标签
                box.onmouseover = btn.onmouseover = function(){
                  if(timer) clearTimeout(timer)
                    box.style.display = 'block';
                }
                //移出后半秒标签内容自动消失
                box.onmouseout = btn.onmouseout = function(){
                    timer = setTimeout(function(){
                      box.style.display = 'none';
                    },500); 
                }
            })();
            (function(){
                //获取到按钮和对应显示隐藏的标签
                var btn = document.getElementById('show_tiggl');
                var box = document.getElementById('tigg');
                //初始化时间
                var timer = null; 
                //鼠标移入按钮时候显示标签
                box.onmouseover = btn.onmouseover = function(){
                  if(timer) clearTimeout(timer)
                    box.style.display = 'block';
                }
                //移出后半秒标签内容自动消失
                box.onmouseout = btn.onmouseout = function(){
                    timer = setTimeout(function(){
                      box.style.display = 'none';
                    },500); 
                }
            })();
            (function(){
                //获取到按钮和对应显示隐藏的标签
                var btn = document.getElementById('show_tig');
                var box = document.getElementById('tig');
                //初始化时间
                var timer = null; 
                //鼠标移入按钮时候显示标签
                box.onmouseover = btn.onmouseover = function(){
                  if(timer) clearTimeout(timer)
                    box.style.display = 'block';
                }
                //移出后半秒标签内容自动消失
                box.onmouseout = btn.onmouseout = function(){
                    timer = setTimeout(function(){
                      box.style.display = 'none';
                    },500); 
                }
            })();
            (function(){
                //获取到按钮和对应显示隐藏的标签
                var btn = document.getElementById('urgiant');
                var box = document.getElementById('Ourgiant');
                //初始化时间
                var timer = null; 
                //鼠标移入按钮时候显示标签
                box.onmouseover = btn.onmouseover = function(){
                  if(timer) clearTimeout(timer)
                    box.style.display = 'block';
                }
                //移出后半秒标签内容自动消失
                box.onmouseout = btn.onmouseout = function(){
                    timer = setTimeout(function(){
                      box.style.display = 'none';
                    },500); 
                }
            })();
            (function(){
                //获取到按钮和对应显示隐藏的标签
                var btn = document.getElementById('liaison');
                var box = document.getElementById('Fangju');
                //初始化时间
                var timer = null; 
                //鼠标移入按钮时候显示标签
                box.onmouseover = btn.onmouseover = function(){
                  if(timer) clearTimeout(timer)
                    box.style.display = 'block';
                }
                //移出后半秒标签内容自动消失
                box.onmouseout = btn.onmouseout = function(){
                    timer = setTimeout(function(){
                      box.style.display = 'none';
                    },500); 
                }
            })();
JS;
$this->registerJs($js,View::POS_END);


?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <?php !isset($this->metaTags['keywords']) && $this->registerMetaTag(['name' => 'keywords', 'content' => Yii::$app->feehi->seo_keywords], 'keywords');?>
    <?php !isset($this->metaTags['description']) && $this->registerMetaTag(['name' => 'description', 'content' => Yii::$app->feehi->seo_description], 'description');?>
    <meta charset="<?= Yii::$app->charset ?>">
    <?= Html::csrfMetaTags() ?>
</head>
<?php $this->beginBody() ?>
<body>
<div>
    <div class="navigation">
        <div>
            <img src="<?=$logo['value']?>" alt="<?=$logo['tips']?>">
        </div>
        <div>
            <ul>
                <?php
                $ids = [
                        '走进方巨'=>'show_tiggle',
                        '旗下产品'=>'show_tiggl',
                        '新闻中心'=>'show_tig',
                        '加入方巨'=>'urgiant',
                        '联络方巨'=>'liaison',
                ];
                foreach ($menus as $item):?>
                <li> <a href="<?=Url::to([$item['url']])?>" <?php if(array_key_exists($item['name'],$ids)){echo "id='{$ids[$item['name']]}'";}?>><?=$item['name']?></a> </li>
                <?php endforeach;?>
            </ul>
        </div>
        <div class="search">

            <img src="/static/images/46.gif" alt="">

            <img src="/static/images/47.gif" alt="">

        </div>

    </div>
</div>
<?php
$ids = [
    '走进方巨'=>'tiggle',
    '旗下产品'=>'tigg',
    '新闻中心'=>'tig',
    '加入方巨'=>'Ourgiant',
    '联络方巨'=>'Fangju',
];
foreach ($menus as $item):?>
<div class="secondlevel" <?php if(array_key_exists($item['name'],$ids)){echo "id='{$ids[$item['name']]}'";}?>">
    <div class="secondlevel-link">
        <ul>
            <?php foreach ($item['children'] as $v):?>
            <li> <a href="<?=Url::to([$v['url']])?>"><?=$v['name']?></a> </li>
            <?php endforeach;?>
        </ul>
    </div>
</div>
<?php endforeach;?>

<?=$content?>
<div class="Bottom-navigation">
    <div class="bottom">
        <div class="copyright">
            <div>
                <ul>
                    <li>方巨集团 版权所有</li>
                    <li><?=Yii::$app->feehi->website_icp?></li>
                </ul>
            </div>
            <div class="WeChat">
                <img src="/static/images/images/4_03.png" alt="">
                <img src="/static/images/images/4_05.png" alt="">
            </div>
            <div class="Navigation-connection">
                <ul class="Home-Page">
                    <?php foreach ($menus as $item):?>
                        <li> <?=$item['name']?> </li>
                    <?php endforeach;?>
                </ul>
                <p>友情链接：
                    <?php foreach ($friendlyLink as $item):?>
                        <a href="<?=$item['url']?>"><?=$item['name']?></a>
                    <?php endforeach;?>
                </p>
            </div>
        </div>

    </div>
</div>

</body>
<?php $this->endBody() ?>
</html>
<?php $this->endPage() ?>