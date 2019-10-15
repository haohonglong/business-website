<?php
use yii\helpers\Url;

$this->registerCssFile("@web/static/css/annals.css");
$this->registerCssFile("@web/static/css/nnals.css");
$this->title = "企业年志";
?>


<?= $this->render('@frontend/views/_common/breadcrumbs',[
    'list'=>[
        ['url'=>Url::to(['come/index']),'name'=>'走进方巨',]
    ],
    'img'=>'',
])?>
<!--数字党建-->
<div>
    <div class="numbe">
        <div>
            <ul class="Winning">
                <li>
                    <p>3月重庆通贷投资有限公司荣获“2014年度消费维权诚信单位”</p>
                </li>
                <li>
                    <p>3月荣获“2014年度消费维权诚信单位”</p>
                </li>
                <li>
                    <p>8月13日中国首家综合性互联网金融平台“通通贷”平台上线暨新闻发布</p>
                </li>



            </ul>
            <ul class="project">
                <li>
                    <p>3月重庆通贷投资有限公司荣获“2014年度消费维权诚信单位”</p>
                </li>
            </ul>


        </div>
        <div>
            <img src="/static/img/企业年志_03.gif" alt="">
        </div>
        <div>
            <ul>
                <li>
                    <p>3月重庆通贷投资有限公司荣获“2014年度消费维权诚信单位”</p>
                </li>
                <li>
                    <p>3月重庆通贷投资有限公司荣获“2014年度消费维权诚信单位”</p>
                </li>
                <li>
                    <p>3月重庆通贷投资有限公司荣获“2014年度消费维权诚信单位”</p>
                </li>
                <li>
                    <p>3月重庆通贷投资有限公司荣获“2014年度消费维权诚信单位”</p>
                </li>
                <li>
                    <p>3月重庆通贷投资有限公司荣获“2014年度消费维权诚信单位”</p>
                </li>
                <li>
                    <p>3月重庆通贷投资有限公司荣获“2014年度消费维权诚信单位”</p>
                </li>
            </ul>
        </div>
    </div>
</div>
