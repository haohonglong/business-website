<?php
namespace app\admincp\controller;
use library\WxTemplateMsg;
use app\admincp\model\Order as Od;
use app\admincp\model\App;
use think\Request;
use app\admincp\model\ResourceProductLottery;
use app\admincp\model\ProductLottery;
use app\admincp\model\Resource;
use app\admincp\model\User;
use app\admincp\model\UserForm;
use library\Weixin;

class Wxmsg extends Base{
    public function  send($rid,$uid,$title)
    {
        $appInfo = new App();
        $loginInfo = $appInfo->getLoginInfo();
        $appId = $loginInfo['appId'];
        $request = Request::instance();
        //$rid = $request->param('rid', '178');
        //$uid = $request->param('uid', '17');
        $where = array(
            'rid' => $rid,
            'uid' => $uid,
            'is_used' => 0,
        );
        $find = UserForm::where($where)->find();
        
        $openid = $find['openid'];
        $formid = $find['formid'];

        if ($find) {
            $find->is_used = 1;
            $find->push_time = time();
            $find->save();
        }
        

        $templateId = 'sbOvY4JKkWonOUZivGa-L37ID-zlZxig7ASEHR8bsrM';

        $post_data = array (
            // 用户的 openID，可用过 wx.getUserInfo 获取
            "touser"           => $openid,
            // 小程序后台申请到的模板编号
            "template_id"      => $templateId,
            // 点击模板消息后跳转到的页面，可以传递参数
            "page"             => "pages/goods/drawDetail?gid=$rid",
            // 第一步里获取到的 formID
            "form_id"          => $formid,
            'data' => [
                'keyword1' => [
                    'value' => $title,
                ],

                'keyword2' => [
                    'value' => '宫里的世界 发起的抽奖正在开奖，点击查看中奖名单',
                ],
            ]
            // 需要强调的关键字，会加大居中显示
            //"emphasis_keyword" => "keyword2.DATA"

        );


        // 这里替换为你的 appID 和 appSecret
        $tokenInfo = Weixin::getAccessToken();
        $accessToken = $tokenInfo['access_token'];
        $url = "https://api.weixin.qq.com/cgi-bin/message/wxopen/template/send?access_token=".$accessToken ;
        // 将数组编码为 JSON
        $data = json_encode($post_data, true);

        // 这里的返回值是一个 JSON，可通过 json_decode() 解码成数组\
        $options = array(
            'http' => array(
                'method'  => 'POST',
                // header 需要设置为 JSON
                'header'  => 'Content-type:application/json',
                'content' => $data,
                // 超时时间
                'timeout' => 6
            )
        );

        $context = stream_context_create( $options );
        $result = file_get_contents( $url, false, $context );
        return $result;
        // $return = $this->send_post( $url, $data);
        // return $return;
        //var_dump($return);
    }
        // 发送 POST 请求的函数
        // 你也可以用 cUrl 或者其他网络库，简单的请求这个函数就够用了
    public function send_post( $url, $post_data ) {
        $options = array(
            'http' => array(
                'method'  => 'POST',
                // header 需要设置为 JSON
                'header'  => 'Content-type:application/json',
                'content' => $post_data,
                // 超时时间
                'timeout' => 60
            )
        );

        $context = stream_context_create( $options );
        $result = file_get_contents( $url, false, $context );
        return $result;
    }
}