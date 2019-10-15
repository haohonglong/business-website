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
                <video src="/i/movie.ogg" controls="controls">
                    your browser does not support the video tag
                </video>
            </div>
            <div class="Raw_heel">
                <ul>
                    <li>
                        <video src="/i/movie.ogg" controls="controls">
                            your browser does not support the video tag
                        </video>
                    </li>
                    <li>
                        <video src="/i/movie.ogg" controls="controls">
                            your browser does not support the video tag
                        </video>
                    </li>
                </ul>
                <ul>
                    <li>
                        <video src="/i/movie.ogg" controls="controls">
                            your browser does not support the video tag
                        </video>
                    </li>
                    <li>
                        <video src="/i/movie.ogg" controls="controls">
                            your browser does not support the video tag
                        </video>
                    </li>
                </ul>
            </div>
        </div>
        <div class="Meeting">
            <ul>
                <li>
                    <video src="/i/movie.ogg" controls="controls">
                        your browser does not support the video tag
                    </video>
                </li>
                <li>
                    <video src="/i/movie.ogg" controls="controls">
                        your browser does not support the video tag
                    </video>
                </li>
                <li>
                    <video src="/i/movie.ogg" controls="controls">
                        your browser does not support the video tag
                    </video>
                </li>
            </ul>
            <ul>
                <li>
                    <video src="/i/movie.ogg" controls="controls">
                        your browser does not support the video tag
                    </video>
                </li>
                <li>
                    <video src="/i/movie.ogg" controls="controls">
                        your browser does not support the video tag
                    </video>
                </li>
                <li>
                    <video src="/i/movie.ogg" controls="controls">
                        your browser does not support the video tag
                    </video>
                </li>
            </ul>
        </div>
    </div>
</div>
