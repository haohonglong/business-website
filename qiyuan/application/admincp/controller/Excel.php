<?php
namespace app\admincp\controller;
use app\admincp\model\App;
use PHPExcel_IOFactory;
use PHPExcel;
use think\Request;
use think\Db;
use app\admincp\model\User;
use app\admincp\model\Order;
use app\admincp\model\OrderComment;
use app\admincp\model\ProductLottery;
use app\admincp\model\Xinxiz;
use app\admincp\model\Xixin;

class Excel extends Base{



    //信息

    public function outxinxi(){
        vendor("PHPExcel.PHPExcel");
        $request = request::instance();
        $name = $request->param('name','','htmlspecialchars');
        $phone = $request->param('phone','');
        $post = $request->param('post','');
        $unit = $request->param('unit','');

        if($keyword != ''){
			$where['name'] = ['like', "%$name%"];
		}
		if($phone != ''){
			$where['phone'] = ['like', "%$phone%"];
		}
		if($unit != ''){
			$where['unit'] = ['like', "%$unit%"];
		}
		if($post != ''){
			$where['post'] = ['like', "%$post%"];
		}

        
       $userList = Xixin::with('getxixinz')->where($where)->select();
        // return json($list);
        $PHPExcel = new \PHPExcel();//实例化
        $PHPSheet = $PHPExcel->getActiveSheet();
        $PHPSheet->setTitle("xinxi"); //给当前活动sheet设置名称
        //$PHPSheet->setCellValue("A1","ID")->setCellValue("B1","username");//表格数据
        //$PHPSheet->setCellValue("A2","001")->setCellValue("B2","元宝");//表格数据
        $PHPExcel->getActiveSheet()->getStyle('A1'.(+2))->getAlignment()->setWrapText(true);

        $PHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', '姓名')
            ->setCellValue('B1', '性别')
            ->setCellValue('C1', '年龄')
            ->setCellValue('D1', '名族')
            ->setCellValue('E1', '单位')
            ->setCellValue('F1', '职务')
            ->setCellValue('G1', '职称')
            ->setCellValue('H1', '邮编')
            ->setCellValue('I1', '通讯地址')
            ->setCellValue('J1', '联系电话')
            ->setCellValue('K1', '传真')
            ->setCellValue('L1', '电子邮箱')
            ->setCellValue('M1', '天数')
            ->setCellValue('N1', '合租')
            ->setCellValue('O1', '人数')
            ->setCellValue('P1', '来程时间')
            ->setCellValue('Q1', '来程航班')
            ->setCellValue('R1', '来程地点')
            ->setCellValue('S1', '返程时间')
            ->setCellValue('T1', '返程航班')
            ->setCellValue('U1', '返程地点')
            ->setCellValue('V1', '跟随人员信息')
            ;
        foreach($userList as $k=>$v){
            if($v['sex'] == 1){
                $userList[$k]['sex'] = '男';
            }elseif($v['sex'] == 2){
                $userList[$k]['sex'] = '女';
            }
           
             $userList[$k]['time'] = date('Y-m-d H:i:s',$v['time']);
             $userList[$k]['time1'] = date('Y-m-d H:i:s',$v['time1']);
            
        
        }
      
        $i=2;
        foreach($userList as $key=>$val){
            $list = Xinxiz::where(['xid'=>$val['id']])->select();
            $str = '';
            $num = 1;
            foreach($list as $k=>$v){
                if($v['sex'] == 1){
                    $list[$k]['sex'] = '男';
                }elseif($v['sex'] == 2){
                    $list[$k]['sex'] = '女';
                }
                 $str .=$num.'-姓名：'.$v['name'].'  性别： '.$v['sex'].'  职务： '.$v['post'].'      ';
                $num++;
            }
            
            //设置每一行行高
           // $PHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(25);
            //设置自动换行
            $PHPExcel->getActiveSheet()->getStyle('A'.$k)->getAlignment()->setWrapText(true);
            //所有垂直居中
            $PHPExcel->getActiveSheet()->getStyle('A'.$k)->getAlignment()->setVertical;
            //设置单元格宽度
            $PHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
            $PHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
            $PHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
            $PHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
            $PHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
            $PHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
            $PHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
            $PHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(12);
            $PHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
            $PHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
            $PHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
            $PHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
            $PHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
            $PHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(12);
            $PHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(15);
            $PHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(15);
            $PHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(20);
            $PHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(20);
            $PHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(20);
            $PHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(12);
            $PHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(15);
            $PHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(50);
            

            $PHPSheet->setCellValue('A'.$i,$val['name'])
            ->setCellValue('B'.$i,$val['sex'])
            ->setCellValue('C'.$i,$val['age'])
            ->setCellValue('D'.$i,$val['mingzu'])
            ->setCellValue('E'.$i,$val['unit'])
            ->setCellValue('F'.$i,$val['post'])//表格数据
            ->setCellValue('G'.$i,$val['professor'])
            ->setCellValue('H'.$i,$val['code'])
            ->setCellValue('I'.$i,$val['address'])
            ->setCellValue('J'.$i,$val['phone'])
            ->setCellValue('K'.$i,$val['fax'])//表
            ->setCellValue('L'.$i,$val['email'])
            ->setCellValue('M'.$i,$val['fate'])
            ->setCellValue('N'.$i,$val['islive'])
            ->setCellValue('O'.$i,$val['personnum'])
            ->setCellValue('P'.$i,$val['time'])//表
            ->setCellValue('Q'.$i,$val['flight'])
            ->setCellValue('R'.$i,$val['place'])
            ->setCellValue('S'.$i,$val['time1'])
            ->setCellValue('T'.$i,$val['flight1'])
            ->setCellValue('U'.$i,$val['place1'])//表
            ->setCellValue('V'.$i,$str);
            
            $i++;
        }
        $PHPWriter = \PHPExcel_IOFactory::createWriter($PHPExcel,"Excel2007");//创建生成的格式
        ob_end_clean();
        header('Content-Disposition: attachment;filename="user.xlsx"');//下载下来的表格名
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $PHPWriter->save("php://output"); //表示在$path路径下面生成demo.xlsx文件
    }

    
    //导出用户信息
    public function outUser()
    {
        vendor("PHPExcel.PHPExcel");
        $userList=$list = Db::name('user')->order(['id' => 'desc'])->select();

        $PHPExcel = new \PHPExcel();//实例化
        $PHPSheet = $PHPExcel->getActiveSheet();
        $PHPSheet->setTitle("user"); //给当前活动sheet设置名称
        //$PHPSheet->setCellValue("A1","ID")->setCellValue("B1","username");//表格数据
        //$PHPSheet->setCellValue("A2","001")->setCellValue("B2","元宝");//表格数据
        $PHPExcel->getActiveSheet()->getStyle('A1'.(+2))->getAlignment()->setWrapText(true);

        $PHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', '微信昵称')
            ->setCellValue('B1', '用户组')
            ->setCellValue('C1', '性别')
            ->setCellValue('D1', '电话')
            ->setCellValue('E1', '所在地区')
            ->setCellValue('F1', '注册时间');
        foreach($userList as $k=>$v){
            if($v['gender'] == 1){
                $userList[$k]['gender'] = '男';
            }elseif($v['gender'] == 2){
                $userList[$k]['gender'] = '女';
            }else{
                $userList[$k]['gender'] = '未知';
            }
            if($v['usergroup'] == 0){
                $userList[$k]['usergroup'] = '普通会员';
            }
            $userList[$k]['province'] = $v['province'].' '.$v['city'];

            if($v['province'] == ""){//如果用户微信地址为空且有订单地址则显示订单地址
                $phone = OrderComment::where(['tel'=>$v['phone']])->select();
                foreach($phone as $key=>$val){
                    count($phone)>1 ? $adress .= $val['address'].':' : $adress =$val['address'];
                    $userList[$k]['province'] = $adress;
                }

            }
        
        }
      
        $i=2;
        foreach($userList as $key=>$val){
            //设置每一行行高
           // $PHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(25);
            //设置自动换行
            $PHPExcel->getActiveSheet()->getStyle('A'.$k)->getAlignment()->setWrapText(true);
            //所有垂直居中
            $PHPExcel->getActiveSheet()->getStyle('A'.$k)->getAlignment()->setVertical;
            //设置单元格宽度
            $PHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
            $PHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
            $PHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(5);
            $PHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
            $PHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
            $PHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);

            $PHPSheet->setCellValue('A'.$i,$val['nickname'])
            ->setCellValue('B'.$i,$val['usergroup'])
            ->setCellValue('C'.$i,$val['gender'])
            ->setCellValue('D'.$i,$val['phone'])
            ->setCellValue('E'.$i,$val['province'])
            ->setCellValue('F'.$i,$val['create_time']);//表格数据
            $i++;
        }
        $PHPWriter = \PHPExcel_IOFactory::createWriter($PHPExcel,"Excel2007");//创建生成的格式
        ob_end_clean();
        header('Content-Disposition: attachment;filename="user.xlsx"');//下载下来的表格名
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $PHPWriter->save("php://output"); //表示在$path路径下面生成demo.xlsx文件


        }











        //导出订单信息
    public function outOrder(){
        vendor("PHPExcel.PHPExcel");
        $orderList = Order::with('comments')->where(['status'=>1])->order(['id'=>'desc'])->select();
        
        $PHPExcel = new \PHPExcel();//实例化
        $PHPSheet = $PHPExcel->getActiveSheet();
        $PHPSheet->setTitle("order"); //给当前活动sheet设置名称
        //$PHPSheet->setCellValue("A1","ID")->setCellValue("B1","username");//表格数据
        //$PHPSheet->setCellValue("A2","001")->setCellValue("B2","元宝");//表格数据
        $PHPExcel->getActiveSheet()->getStyle('A1'.(+2))->getAlignment()->setWrapText(true);

        $PHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', '订单号')
            ->setCellValue('B1', '购买用户')

            ->setCellValue('C1', '商品名称')
            ->setCellValue('D1', '规格')

            ->setCellValue('E1', '状态')
            ->setCellValue('F1', '购买数量')
            ->setCellValue('G1', '总价')
            ->setCellValue('H1', '电话')
            ->setCellValue('I1', '收货地址')
            ->setCellValue('J1', '快递名称')
            ->setCellValue('K1', '快递单号')
            ->setCellValue('L1', '下单时间') ;
       


        $model = new Order();
        $i = 2;
        foreach($orderList as $key=>$val){
           // print_r($val->toarray());die;
          $getStatusName = $model->getStatusTextAttr($val['status']);
            $PHPExcel->getActiveSheet()->getStyle('ABCDEF'.$k)->getAlignment()->setHorizontal;
            //设置单元格宽度
            $PHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
            $PHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12);

            $PHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
            $PHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);

            $PHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
            $PHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
            $PHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
            $PHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
            $PHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(70);
            $PHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(30);
            $PHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(30);
            $PHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
            $PHPSheet->setCellValue('A'.$i,$val['sn'])
                ->setCellValue('B'.$i,$val['comments']['name'])

                ->setCellValue('C'.$i,$val['title'])
                ->setCellValue('D'.$i,$val['sku'])

                ->setCellValue('E'.$i,$getStatusName)
                ->setCellValue('F'.$i,$val['totalnum'])
                ->setCellValue('G'.$i,$val['payprice'])
                ->setCellValue('H'.$i,$val['comments']['tel'])
                ->setCellValue('I'.$i,$val['comments']['address'])
                ->setCellValue('J'.$i,$val['comments']['expressname'])
                ->setCellValue('K'.$i,$val['comments']['expressnum'])
                ->setCellValue('L'.$i,$val['comments']['create_time']) ;//表格数据
            $i++;
        }
        $PHPWriter = \PHPExcel_IOFactory::createWriter($PHPExcel,"Excel2007");//创建生成的格式
        ob_end_clean();
        header('Content-Disposition: attachment;filename="Order.xlsx"');//下载下来的表格名
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $PHPWriter->save("php://output"); //表示在$path路径下面生成demo.xlsx文件





    }


}