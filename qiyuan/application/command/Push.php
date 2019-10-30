<?php
namespace app\command;

use app\api\model\AccessToken;
use app\api\model\UserForm;
use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\Log;

class Push extends Command
{
    private $wxappId = 'wx58947149d78d6f6b'; //军武次位面
    private $wxappSecret = 'e7bd2d1e34bbb89bceb07f08ee02b4af';

    protected function configure()
    {
        $this->setName('push')->setDescription('Message push service');
    }

    protected function execute(Input $input, Output $output)
    {
        $appId = '59a7c135h42';

        $model = AccessToken::where([
            'appid' => $appId
        ])->find();
        if (!$model) {
            $token = $this->getAccessToken();
            $model = AccessToken::create([
                'appid' => $appId,
                'access_token' => $token['access_token'],
                'expires_in' => $token['expires_in']
            ]);
        } else if (strtotime($model['update_time']) + 7000 < time()) {
            $token = $this->getAccessToken();
            $model->access_token = $token['access_token'];
            $model->expires_in = $token['expires_in'];
            $model->update_time = date('Y-m-d H:i:s');
            $model->save();
        }

//        $where['uid'] = ['in', [1106551,1092630]];
        $where = [
            'push_time' => '',
            'update_time' =>['>',date("Y-m-d H:i:s", strtotime("-7 day"))],
        ];
        $userform = UserForm::where($where)->limit(2000)->select();
        foreach ($userform as $key => $val) {
            $accessToken = $model['access_token'];
            $url = 'https://api.weixin.qq.com/cgi-bin/message/wxopen/template/send?access_token='.$accessToken;
            $sendMsg = array(
                'touser' => $val['openid'],
                'template_id' => 'cZJZEVGo5o2pqCv-5RV2hdH-E3IOidv8BJp-Hd31VFc',
                'page' => 'pages/index/index',
                'form_id' => $val['formid'],
                'data' => array(
                    'keyword1' => array(
                        'value' => '上线「军武问答」功能，在这里您可以与百万军迷朋友共同参与知识大比拼。悄悄的告诉你，我们准备了一大批舰船模型，来奖励提供优质回答的用户，快来参与吧！',
                        'color' => '#d83c13'
                    ),
                    'keyword2' => array(
                        'value' => '对了，关于军武小程序产品的任何吐槽和建议，欢迎在个人中心里面联系客服告诉我们。「军武」在这里祝你生活愉快！',
                        'color' => '#d83c13'
                    ),
                ),
            );

            $params = json_encode($sendMsg, JSON_UNESCAPED_UNICODE);
            $response = $this->curlPost($url, $params);
//            Log::record($response);
            $result = json_decode($response, true);

            UserForm::where([
                'uid' => $val['uid']
            ])->update([
                'is_used' => 1,
                'push_time' => date('Y-m-d H:i:s')
            ]);
            if ($result['errcode'] == 0) {
                $output->writeln("Success." .$key);
            } else {
                $output->writeln("Fail.".$response);
            }

        }
	}

    private function getAccessToken()
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$this->wxappId.'&secret='.$this->wxappSecret;
        $result = $this->curlPost($url, []);
        $token = json_decode($result, true);
        if (isset($token['errcode'])) {
            return ['code' => 1, 'msg' => '获取accessToken失败'];
        }

        return $token;
    }

    private function curlPost($url, $data)
    {
        $curl  = new \Curl\Curl();
        $curl->setOpt(CURLOPT_RETURNTRANSFER, TRUE);
        $curl->setOpt(CURLOPT_SSL_VERIFYPEER, FALSE);
        $curl->post($url, $data);
        return $curl->response;
    }
}