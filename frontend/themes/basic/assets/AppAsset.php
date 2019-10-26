<?php


namespace frontend\themes\basic\assets;

class AppAsset extends \yii\web\AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@themes_static/basic';
    public $css = [
        'css/public.min.css',
        'css/animate.min.css',
        'css/index.min.css',
        'css/mobile.css',
    ];

    public $js = [
        'js/jquery-1.11.0.min.js',
        'js/uaredirect.js',
        'js/smooth.min.js',
        'js/public.min.js',
        'js/jquery.superslide.2.1.1.js',
        'js/imagesloaded.pkgd.min.js',
        'js/bootstrap.min.js',
        'js/device.min.js',
        'js/fadeslide.min.js',
        'js/index.min.js',
        'js/index.js',
    ];
    public $depends = [
//        'yii\web\YiiAsset',
    ];

}
