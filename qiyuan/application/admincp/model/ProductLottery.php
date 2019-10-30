<?php

namespace app\admincp\model;

use think\Model;

class ProductLottery extends Model
{
     // $v['appid'] = Db::name('resource')->where(['id'=>$v['rid']])->value('appid');
    //         $v['nickname'] = Db::name('user')->where(['appid'=>$v['appid']])->value('nickname');
    //         $v['title'] = Db::name('resource')->where(['id'=>$v['rid']])->value('title');
    public function resource() {

        return $this->hasOne('resource', 'id', 'rid')->field('id, title');
    }

    public function user() {
        return $this->hasOne('user', 'id', 'uid')->field('id, username');
    }
}
