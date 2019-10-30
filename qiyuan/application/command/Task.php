<?php
namespace app\command;

use app\api\model\User;
use app\api\model\UserSession;
use think\Cache;
use think\console\Command;
use think\console\Input;
use think\console\Output;

use think\Db;

class Task extends Command
{
	
    protected function configure()
    {
        $this->setName('task')->setDescription('User sessionkey update');
    }

    protected function execute(Input $input, Output $output)
    {
        $appId = '59a7c135h42';

        //批量获取session
//        $user = User::where([
//            'appid' => $appId,
//            'update_in' => 0
//        ])->limit(500)->field('uid,openid')->select();
//
//        foreach ($user as $key => $val) {
//            $str = $val['openid'].'wx227d3f4603a23c1a'.'fypappusersalt';
//            $sessionKey = hash("sha256", $str);
//            UserSession::create([
//                'uid' => $val['uid'],
//                'session_key' => $sessionKey
//            ]);
//
//            User::where([
//                'uid' => $val['uid']
//            ])->update(['update_in' => 1]);
//        }
//        $output->writeln("Done.");

        //删除缓存
        $users = User::where([
            'appid' => $appId,
            'update_in' => 1
        ])->limit(2000)->field('uid,openid')->select();

        foreach ($users as $val) {
            $str = $val['openid'].'wx58947149d78d6f6b'.'fypappusersalt';
            $sessionKey = hash("sha256", $str);
            Cache::rm($sessionKey);

            User::where([
                'uid' => $val['uid']
            ])->update(['update_in' => 0]);
        }
        $output->writeln("Done.");
	}

}