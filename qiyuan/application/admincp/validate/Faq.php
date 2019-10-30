<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/15
 * Time: 13:27
 */
namespace app\admincp\validate;

use think\Validate;

class Faq extends Validate
{
    protected $rule = [
        'title' => 'require',
        'content' => 'require',
    ];

    protected $message = [
        'title' => '标题不能为空',
        'content' => '内容不能为空',
    ];
}