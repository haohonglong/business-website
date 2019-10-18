<?php
use yii\helpers\Url;

$this->registerCssFile("@web/static/css/annals.css");
$this->registerCssFile("@web/static/css/video.css");
$this->registerCssFile("@web/static/css/videocenter.css");

$this->title = '视频中心';


?>
<?= $this->render('@frontend/views/_common/breadcrumbs',[
    'list'=>[
        ['url'=>Url::to(['news/index']),'name'=>'新闻中心',]
    ],
    'img'=>'',
])?>
<!--数字党建-->
<div>
    <div class="howie">
        <div class="video">
            <div class="video_one">
                <video src="<?=isset($videos[0])?$videos[0]['url']:''?>" controls="controls">
                    <!-- your browser does not support the video tag -->
                </video>
            </div>
            <div class="Raw_heel">
                <ul>
                    <li>
                        <video src="<?=isset($videos[1])?$videos[1]['url']:''?>" controls="controls">
                            your browser does not support the video tag
                        </video>
                    </li>
                    <li>
                        <video src="<?=isset($videos[2])?$videos[2]['url']:''?>" controls="controls">
                            your browser does not support the video tag
                        </video>
                    </li>
                </ul>
                <ul>
                    <li>
                        <video src="<?=isset($videos[3])?$videos[3]['url']:''?>" controls="controls">
                            your browser does not support the video tag
                        </video>
                    </li>
                    <li>
                        <video src="<?=isset($videos[4])?$videos[4]['url']:''?>" controls="controls">
                            your browser does not support the video tag
                        </video>
                    </li>
                </ul>
            </div>
        </div>
        <div class="Meeting">
            <ul class="imglist">
                <?php for($i=5,$len = count($videos);$i < $len ;$i++):?>
                <li style="width: 380px;height: 172px">
                    <video width="380px" height="172px" src="<?=$videos[$i]['url']?>" controls="controls">
                        your browser does not support the video tag
                    </video>
                    <span>方巨集团VCR</span>

                </li>
                <?php endfor;?>
            </ul>
        </div>
    </div>
</div>
