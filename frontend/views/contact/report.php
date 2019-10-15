<?php
use yii\helpers\Url;

$this->title = '廉洁举报';
$this->registerCssFile("@web/static/css/number.css");


$css = <<<CSS
.Report{
          width: 1200px;
          margin: 0 auto;
      }
      .Report img{
          width: 100%;
          display:block;
      }
CSS;

$this->registerCss($css);

?>

<?= $this->render('@frontend/views/_common/breadcrumbs',[
    'list'=>[
        ['url'=>Url::to(['contact/index']),'name'=>'联系方巨',]
    ],
    'img'=>'',
])?>

<!--联系我们-->
<div>
    <div class="Report">
        <img src="/static/img/t.gif" alt="">
    </div>
</div>
