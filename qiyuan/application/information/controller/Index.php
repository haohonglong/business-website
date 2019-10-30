<?php
namespace app\information\controller;
use think\Controller;
use think\Request;
use app\information\model\Xixin;
use app\information\model\Xinxiz;
class Index extends Controller
{
    public function index()
    {
       

        return $this->fetch();
    }

    public function add(){

        $request = request::instance();
       
        $name = $request->param('name','','htmlspecialchars');
        $sex = $request->param('sex',0,'intval');
        $age = $request->param('age',0,'intval');
        $mingzu = $request->param('mingzu','','htmlspecialchars');
        $unit = $request->param('unit','','htmlspecialchars');
        $post = $request->param('post','','htmlspecialchars');
        $professor = $request->param('professor','','htmlspecialchars');
        $code = $request->param('code','','htmlspecialchars');
        $address = $request->param('address','','htmlspecialchars');
        $phone = $request->param('phone','','htmlspecialchars');
        $fax = $request->param('fax','','htmlspecialchars');
        $email = $request->param('email','','htmlspecialchars');
        $personnum = $request->param('personnum',0,'intval');
        $fate = $request->param('fate',0,'intval');
        $time = $request->param('time','','strtotime');
        $flight = $request->param('flight','','htmlspecialchars');
        $place = $request->param('place','','htmlspecialchars');
        $time1 = $request->param('time1','','strtotime');
        $flight1 = $request->param('flight1','','htmlspecialchars');
        $place1 = $request->param('place1','','htmlspecialchars');
        $lid = $request->param('lid/a');//多选框
        // return $lid;
        $data = [
            'name' => $name,
            'sex' => $sex,
            'age' => $age,
            'mingzu' => $mingzu,
            'unit' => $unit,
            'post' => $post,
            'professor' => $professor,
            'code' => $code,
            'address' => $address,
            'phone' => $phone,
            'fax' => $fax,
            'email' => $email,
            'personnum' => $personnum,
            'fate' => $fate,
            'time' => $time,
            'flight' => $flight,
            'place' => $place,
            'time1' => $time1,
            'flight1' => $flight1,
            'place1' => $place1,
            'lid' => json_encode($lid),
        ];
        $renyuanArr = $request->param('renyuanArr/a');  //跟随人员
        $add = Xixin::create($data);
        if($add){
           foreach($renyuanArr as $k=>$v){
               $datas = [
                   'xid' => $add->id,
                   'name' => $v['name'],
                   'sex' => $v['sex'],
                   'post' => $v['post']
               ];
                $adds = Xinxiz::create($datas);
           }
           return ['code'=>0];
        }
        
        
    }
}
