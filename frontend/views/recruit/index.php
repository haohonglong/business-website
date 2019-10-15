<?php
use yii\helpers\Url;
$this->title = "我要应聘";
$this->registerCssFile("@web/static/css/application.css");
?>

<?= $this->render('@frontend/views/_common/breadcrumbs',[
    'list'=>[
        ['url'=>Url::to(['join/index']),'name'=>'加入方巨',]
    ],
    'img'=>'',
])?>

<!--投资经理-->
<div>
    <div class="Investment">
        <div class="Development">
            <h3>投资发展经理</h3>
            <p>发布时间： 2019-08-09</p>
            <ul>
                <li>
                    <img src="/static/img/我要应聘-详情_03.gif" alt="">
                </li>
            </ul>
        </div>
        <div class="Duty">
            <h3>工作职责</h3>
            <ul>
                <li>负责公司土地储备的信息收集跟</li>
                <li>负责公司土地储备的信息收集跟</li>
                <li>负责公司土地储备的信息收集跟</li>
                <li>负责公司土地储备的信息收集跟</li>
                <li>负责公司土地储备的信息收集跟</li>
                <li>负责公司土地储备的信息收集跟</li>
                <li>负责公司土地储备的信息收集跟</li>
            </ul>
        </div>
        <div class="post">
            <h3>工作职责</h3>
            <ul>
                <li>负责公司土地储备的信息收集跟</li>
                <li>负责公司土地储备的信息收集跟</li>
                <li>负责公司土地储备的信息收集跟</li>

            </ul>
        </div>
        <div class="I-apply">
            <h3>我要应聘</h3>

        </div>
    </div>
</div>