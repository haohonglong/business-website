<?php

use frontend\models\Company;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->registerCssFile("@web/static/css/application.css");
$this->registerCssFile("@web/static/css/citizendetails.css");
$info_arr = Company::getInfo();
$this->title = '联系我们';
$css = <<<CSS
.Bottom-navigation{
          margin-top:59px ;
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

<!--投资经理-->
<div>
    <div class="Investme">
        <div class="Poverty">
            <div class="mailbox">
                <ul>
                    <li>
                        <h3><?=$info_arr['company']?></h3>
                    </li>
                    <li>电话：<?=$info_arr['phone']?></li>
                    <li>传真：<?=$info_arr['fax']?></li>
                    <li>邮箱：<?=$info_arr['email']?></li>
                    <li>地址：<?=$info_arr['address']?></li>
                    <li class="heoalod">
                        <div>
                            <div>全国免费咨询电话</div>
                            <div>
                                <img src="/static/img/联系我们_03.gif" alt="">
                            </div>
                            <div>400-000-0000</div>
                        </div>
                        <div>
                            <div>方巨集团官方微信</div>
                            <div>
                                <img src="/static/img/联系我们_06.gif" alt="">
                            </div>
                            <div>扫一扫关注我们</div>
                        </div>
                        <div>
                            <div>方巨集团官方微博</div>
                            <div>
                                <img src="/static/img/联系我们_08.gif" alt="">
                            </div>
                            <div>扫一扫关注我们</div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="heoap">
                <img src="/static/img/联系我们.gif" alt="">
            </div>
        </div>
        <?php $form = ActiveForm::begin() ?>
        <div class="information">
            <h3>留言板</h3>
            <div>
                <div class="Fullname">
                    <img src="/static/img/联系我们3 (3).gif" alt="">
                    <input type="text" name="GuestbookForm[username]" placeholder="姓名">

                </div>
                <div>
                    <div class="Fullname">
                        <img src="/static/img/联系我们3 (1).gif" alt="">
                        <input type="text" name="GuestbookForm[phone]" placeholder="电话">
                    </div>
                </div>
                <div>
                    <div class="Fullname">
                        <img src="/static/img/联系我们3 (2).gif" alt="">
                        <input type="text" name="GuestbookForm[email]" placeholder="邮箱">
                    </div>
                </div>
            </div>
        </div>
        <div class="hhoqpa">
            <img src="/static/img/联系我们_14.gif" alt="">
            <input type="text" name="GuestbookForm[content]" placeholder="留言">
        </div>
        <div class="Sendout">
            <button type="submit">发生</button>
        </div>
        <?php ActiveForm::end() ?>
    </div>
</div>
