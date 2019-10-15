<?php
use yii\helpers\Url;
$this->registerCssFile("@web/static/css/application.css");
$this->registerCssFile("@web/static/css/brief.css");
$this->title = '团队介绍';


?>
<?= $this->render('@frontend/views/_common/breadcrumbs',[
    'list'=>[
        ['url'=>Url::to(['article/index']),'name'=>'走进方巨',]
    ],
    'img'=>'',
])?>

    <!--投资经理-->
    <div>
        <div class="briefr">
            <div>
                <img src="/static/img/团队介绍_03.gif" alt="">
            </div>
            <div>
                <div class="anddeeds">
                    <div>
                        <img src="/static/img/3.gif" alt="">
                    </div>
                    <div>
                        <ul>
                            <li>
                                <h3>李旭陈</h3>
                            </li>
                            <li>
                                <img src="/static/img/团队介绍_06.gif" alt="">
                                <p>中国商界杰出十大人物</p>
                            </li>
                            <li>
                                <img src="/static/img/团队介绍_06.gif" alt="">
                                <p>中国管理科学研究院研究员</p>
                            </li>
                            <li>
                                <img src="/static/img/团队介绍_06.gif" alt="">
                                <p>中国青年创业导师</p>
                            </li>
                            <li>
                                <img src="/static/img/团队介绍_06.gif" alt="">
                                <p>经济学专家</p>
                            </li>
                            <li>
                                <img src="/static/img/团队介绍_06.gif" alt="">
                                <p>著名演说家</p>
                            </li>
                            <li>
                                <img src="/static/img/团队介绍_06.gif" alt="">
                                <p>方巨集团创始人，董事局主席</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="heoaj">
                    <p>李旭成，方巨集团创始人、董事局主席。其人生旅途正如其名，桃“李”满天下，“旭”日东升，功“成”名就。 2002年李旭成从军中转战商界，白手起家，风雨十余载，创业中数不尽的困境与坎坷，他以军人坚毅与果敢的品质打下一片天地，成为行业翘楚，实现了从军中雄鹰到商界华丽的转变；打造了方巨集团这个以实体支撑，金融、生物医药、影视传媒、电子商务、通讯科技、教育、企业孵化等多元化商业帝国</p>
                    <p>李旭成专注经济动态及商业研究，担任高校及诸多集团公司顾问；李旭成擅长投资，其独到的投资理论体系和实践，在投资界名不虚传，堪称投资大咖。其已获得诸多荣誉：中国商界杰出十大人物、中国管理科学研究院研究员、经济学专家、著名演说家、中国青年创业导师；荣获 “全国五一行业劳动模范”、“重庆首届金融十大创新人物”、“2014重庆民营经济十大年度人物”等殊荣。概言之，李旭成是集思想家、著作家、投资家、慈善企业家于一身的楷模。</p>
                </div>
            </div>
        </div>
    </div>



