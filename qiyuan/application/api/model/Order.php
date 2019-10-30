<?php

namespace app\api\model;

use think\Model;

class Order extends Model
{
    public function comments() {
        return $this->hasOne('order_comment', 'oid', 'id');
    }
}
