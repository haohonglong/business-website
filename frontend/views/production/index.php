<?php
use yii\helpers\Url;

$this->title = '旗下产品';
$this->registerCssFile("@web/static/css/application.css");
$this->registerCssFile("@web/static/css/flagproducts.css");

?>
<?= $this->render('@frontend/views/_common/breadcrumbs',[
    'list'=>[
        ['url'=>Url::to(['production/index']),'name'=>'旗下产品',]
    ],
    'img'=>'',
])?>


<!--投资经理-->
<div>
    <div class="nvestme">
        <div class="Povert">
            <div>
                <a href="<?=Url::to(['/production/index','id'=>18])?>">
                    数字党建
                    <p>DIGITAL PARTY BUILDING</P>
                </a>
            </div>
            <div>
                <a href="<?=Url::to(['/production/index','id'=>19])?>">
                    高新科技产品
                    <P>HIGH-TEGH PRODUCTS</P>
                </a>
            </div>
        </div>


        <div class="Communication">
            <ul>
                <?php foreach ($list as $v):?>
                <li>
                    <div>
                        <img src="<?=$v['thumb']?>" alt="">
                    </div>
                    <div class="Meeting">
                        <h3><a href="<?=Url::to(['/article/view','id'=>$v['id']])?>"><?=$v['title']?></a>
                            <span>MORE+</span>

                        </h3>
                        <p><?=$v['summary']?></p>
                    </div>
                </li>
                <?php endforeach;?>
                <li class="heo">
                    <img src="/static/img/2_14.png" alt="">
                </li>
            </ul>
        </div>

    </div>
</div>