<?php
use yii\helpers\Url;
$this->registerCssFile("@web/static/css/annals.css");
$this->title = "组织文化";

?>

<?= $this->render('@frontend/views/_common/breadcrumbs',[
    'list'=>[
        ['url'=>Url::to(['join/index']),'name'=>'加入方巨',]
    ],
    'img'=>'/static/img/旗下产品_03.png',
])?>
<!--数字党建-->
<div>
    <div class="number">
        <img src="/static/img/img7.jpg" alt="">
    </div>
</div>



