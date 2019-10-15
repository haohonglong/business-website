<?php


namespace frontend\assets;

class AppAsset extends \yii\web\AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'static/css/ft-carousel.css',
//        'static/css/index.css',
        'static/css/homepage.css',
    ];

    public $js = [
        'http://www.jq22.com/jquery/jquery-1.10.2.js',
        'static/js/ft-carousel.min.js',
        'static/js/index.js',
        'static/js/daoh.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];

}
