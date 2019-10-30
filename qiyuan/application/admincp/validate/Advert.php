<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/15
 * Time: 13:27
 */
namespace app\admincp\validate;

use think\Validate;

class Advert extends Validate
{
    protected $rule = [
        'url' => 'require',
    ];

    protected $message = [
        'url' => '缩略图不能为空',
    ];
}