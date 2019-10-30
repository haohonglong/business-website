<?php

namespace app\api\model;

use think\Model;

class Resource extends Model
{
    //
    public function lottery(){
        return $this->hasOne('resource_product_lottery', 'rid', 'id')->field('id,rid,joinnum,totalnum,endtime,status');
    }

    public function group() {
        return $this->hasOne('resource_product_group', 'rid', 'id')->field('id, rid, price, joinnum');
    }
}
