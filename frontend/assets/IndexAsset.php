<?php

namespace frontend\assets;


class IndexAsset extends \yii\web\AssetBundle
{
    public $js = [
        'static/js/responsiveslides.min.js',
    ];

    public $depends = [
        'frontend\assets\AppAsset'
    ];
}