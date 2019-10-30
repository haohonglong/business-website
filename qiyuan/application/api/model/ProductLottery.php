<?php

namespace app\api\model;

use think\Model;

class ProductLottery extends Model
{
    public function resource() {
        return $this->hasOne('resource', 'id', 'rid')->field('id, cover, title');
    }

    public function lottery() {
        return $this->hasOne('resource_product_lottery', 'rid', 'rid')->field('rid, endtime, joinnum, pricenum, totalnum');
    }
    public function user() {
        return $this->hasOne('user', 'id', 'uid')->field('id, username, avatar');
    }
}
