<?php

namespace app\admincp\model;

use think\Model;

class Xixin extends Model
{
    public function getxixinz(){
        return $this->hasMany('Xinxiz','xid',id);
    }

}
