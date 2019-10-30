<?php

namespace app\admincp\model;

use think\Model;

class Order extends Model
{
    public function comments() {
        return $this->hasOne('order_comment', 'oid', 'id');
    }

    public function getStatusTextAttr($key=null, $data=[]){
        $status = [
            0 => '待付款',
            1 => '待发货',
            2 => '已发货',
            3 => '已收货',
            4 => '申请退款',
            5 => '退款成功',
            6 => '退款失败', 
            7 => '订单关闭',
            8 => '待成团',
            9 => '拼团失败',
        ];
        if ($data) {
            return $status[$data['status']];

        }
        return $status[$key];
    }
}
