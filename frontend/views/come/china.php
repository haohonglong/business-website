<?php
use yii\helpers\Url;

$this->title = '方巨在中国';

$this->registerCssFile("@web/static/css/annals.css");
$this->registerCssFile("@web/static/css/video.css");
$css = <<<CSS
.fangju{
          margin-top:36px;
          width: 100%;
          height: 586px;
      }
      .fangju img{
          width: 100%;
          height: 586px;
      }
.Its-products h3{width: 126px;}
CSS;
$this->registerCss($css);


?>
<?= $this->render('@frontend/views/_common/breadcrumbs',[
    'list'=>[
        ['url'=>Url::to(['come/index']),'name'=>'走进方巨',]
    ],
    'img'=>'',
])?>

<!--数字党建-->
<div>
    <div class="fangju" >
        <img src="/static/img/方巨在重庆_03.gif" alt="">
    </div>
</div>
