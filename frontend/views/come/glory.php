<?php
use yii\helpers\Url;

$this->title = '企业荣耀';
$this->registerCssFile("@web/static/css/corporateglory.css");

?>

<?= $this->render('@frontend/views/_common/breadcrumbs',[
    'list'=>[
        ['url'=>Url::to(['article/index']),'name'=>'走进方巨',]
    ],
    'img'=>'/static/img/旗下产品_03.png',
])?>

<div>
    <div class="Glory-wall">
        <div class="Honor-Award">
            <ul>
                <?php foreach ($list as $item):?>
                <li>
                    <img src="<?=$item['thumb']?>" alt="">
                    <p><?=$item['title']?></p>
                </li>
                <?php endforeach?>

            </ul>

        </div>
    </div>
</div>