<?php
$title = isset($title) ? $title : $this->title;
?>
<?php if(isset($img)){
    $img = trim($img);
    if(empty($img))
        $img = "/static/img/01.jpg";

?>
<!--图片-->
<div class="wrapBanner1"><img src="<?=\Yii::getAlias('@themes_static')?>/basic/images/banner1.png"></div>
<?php }?>

<div class="wrapTitle">
    <span>团队介绍</span>
    <p>Team introduction</p>
    <div class="wrapTitle_dh"><img src="<?=\Yii::getAlias('@themes_static')?>/basic/images/home.png" />走进方巨 > 团队介绍</div>
</div>


