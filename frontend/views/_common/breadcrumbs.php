<?php
$title = isset($title) ? $title : $this->title;
?>
<?php if(isset($img)){
    $img = trim($img);
    if(empty($img))
        $img = "/static/img/01.jpg";

?>
<!--图片-->
<div class="Background-map">
    <img src="<?=$img?>" alt="">
</div>
<?php }?>
<!--标题-->
<div>
    <div class="Title">
        <div class="Its-products">
            <h3><?=$title?></h3>
        </div>
    </div>
</div>
<div>
    <div class="Enter">
        <ul>
            <li>
                <a title="<?=Yii::t('frontend', 'Return Home')?>" href="<?= Yii::$app->getHomeUrl() ?>"><img src="/static/img/1_07.png" alt=""></a>
            </li>
            <?php if(isset($list)):?>
                <?php foreach ($list as $item):?>
                    <li>
                        <a href="#"><?= $item['name'] ?></a>
                    </li>
                <?php endforeach;?>
                <li>></li>
            <?php endif;?>

            <li>
                <?= $title ?>
            </li>
        </ul>
    </div>
</div>

