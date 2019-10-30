<?php

namespace app\admincp\controller;

use app\admincp\model\App;
use think\Cookie;

class Logout extends Base {

    public function index() {
   		Cookie::delete('feeyanAdmin');
        $this->redirect('/admincp/Login');
    }

}
