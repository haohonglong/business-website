<?php
namespace app\wx\controller;

use app\wx\model\Wxuser;
use app\wx\model\Loginlog;
use think\Config;
use think\Request;
use think\Cache;
use think\Log;

use Wechat\mp\wxBizMsgCrypt;
use library\Helper;

class Index
{
    public function index()
    {
        // $request = Request::instance();

        // $timeStamp = $request->param('timestamp');
        // $nonce = $request->param('nonce');
        // $echostr = $request->param('echostr');
        // $signature = $request->param('signature');

        // $token = 'SAVw5mswuaZlX3W2KFRa2C0uDcH';

        // $array = array($timeStamp, $nonce, $token);
        // sort($array, SORT_STRING);

        // $tmpstr = implode('', $array);
        // $tmpstr = sha1($tmpstr);

        // if ($tmpstr == $signature) {
        //     echo $echostr;
        //     exit;
        // }

        if(isset($GLOBALS["HTTP_RAW_POST_DATA"])) {
            $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

            libxml_disable_entity_loader(true);
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);

            $result['MsgType'] = trim($postObj->MsgType);
            $result['FromUserName'] = trim($postObj->FromUserName);

            $this->getUserInfo($result['FromUserName']);

            // $result['FromUserName'] = trim($postObj->FromUserName);
            // $result['CreateTime'] = trim($postObj->CreateTime);
            // $result['MsgType'] = trim($postObj->MsgType);
            // $result['Content'] = trim($postObj->Content);
            // $result['Event'] = trim($postObj->Event);
            // $result['EventKey'] = trim($postObj->EventKey);

            switch ($result['MsgType'])
            {
                case "text":
                    $resultStr = $this->receiveText($postObj);
                    break;
                case "image":
                    $resultStr = $this->receiveImage($postObj);
                    break;
                case "location":
                    $resultStr = $this->receiveLocation($postObj);
                    break;
                case "voice":
                    $resultStr = $this->receiveVoice($postObj);
                    break;
                case "video":
                    $resultStr = $this->receiveVideo($postObj);
                    break;
                case "link":
                    $resultStr = $this->receiveLink($postObj);
                    break;
                case "event":
                    $resultStr = $this->receiveEvent($postObj);
                    break;
                default:
                    $resultStr = "unknow msg type: ".$result['MsgType'];
                    break;
            }

            echo $resultStr;
        }

        print_r(Cache::get('postStr'));
    }

    private function getUserInfo($openid) 
    {
        $where = array(
            'openid' => $openid
        );

        $userInfo = Wxuser::where($where)->find();

        if(!$userInfo) {

            $accesstoken = Cache::get('wxMpAccessToken');

            if(!$accesstoken) {

                $wxAppId = 'wxa6c8cd6f0172fdfd';
                $wxAppSecret = '1f7d2aa7b059e1a490edabb84f0c2367';

                $url = 'https://api.weixin.qq.com/cgi-bin/token';
                $params = [
                    'appid' => $wxAppId,
                    'secret' => $wxAppSecret,
                    'grant_type' => 'client_credential'
                ];

                $result = Helper::curlPost($url, $params);
                $result = json_decode($result, TRUE);

                Cache::set('wxMpAccessToken', $result['access_token'], 7000);

                $accesstoken = $result['access_token'];

            }

            $userUrl = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$accesstoken;

            $params = [
                'openid' => $openid,
                'lang' => 'zh_CN'
            ];

            $result = Helper::curlPost($userUrl, $params);
            $result = json_decode($result, TRUE);

            $userData = array(
                'openid' => $openid,
                'unionid' => $result['unionid'],
                'username' => $result['nickname'],
                'avatar' => $result['headimgurl'],
                'gender' => $result['sex'],
                'city' => $result['city'],
                'province' => $result['province'],
            );

            Wxuser::create($userData);

        }
    }

    private function getLoginCode($openid) 
    {
        $code = str_pad(mt_rand(0, 999999), 6, "0", STR_PAD_BOTH);

        $loginData = array(
            'code' => $code,
            'openid' => $openid,
            'expiry' => time() + 600
        );
        
        Loginlog::create($loginData);

        return $code;
    }

    private function transmitText($object, $content, $flag = 0)
    {
        $textTpl = "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[text]]></MsgType>
                    <Content><![CDATA[%s]]></Content>
                    <FuncFlag>%d</FuncFlag>
                    </xml>";
        $resultStr = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time(), $content, $flag);
        return $resultStr;
    }

    private function receiveEvent($object)
    {
        $contentStr = "";

        if($object->EventKey == 'login' || $object->EventKey == 'qrscene_login') {

            $code = $this->getLoginCode($object->FromUserName);

            $contentStr = "管理后台登录密码 ".$code." 有效期10分钟";

        } else {
            switch ($object->Event)
            {
                case "subscribe":
                    $contentStr = "欢迎关注天马飞燕";
                    break;
                case "unsubscribe":
                    $contentStr = "";
                    break;
                case "CLICK":
                    switch ($object->EventKey)
                    {
                        default:
                            $contentStr = "你点击了菜单: ".$object->EventKey;
                            break;
                    }
                    break;
                default:
                    $contentStr = "receive a new event: ".$object->Event;
                    break;
            }
        }

        $resultStr = $this->transmitText($object, $contentStr);
        return $resultStr;
    }


    //2.文本消息
    private function receiveText($object)
    {
        $funcFlag = 0;
        $contentStr = "你发送的是文本，内容为：".$object->Content;
        $resultStr = $this->transmitText($object, $contentStr, $funcFlag);
        return $resultStr;
    }


    //3.图片消息
    private function receiveImage($object)
    {
        $funcFlag = 0;
        $contentStr = "你发送的是图片，地址为：".$object->PicUrl;
        $resultStr = $this->transmitText($object, $contentStr, $funcFlag);
        return $resultStr;
    }


    //4.语音消息
    private function receiveVoice($object)
    {
        $funcFlag = 0;
        $contentStr = "你发送的是语音，媒体ID为：".$object->MediaId;
        $resultStr = $this->transmitText($object, $contentStr, $funcFlag);
        return $resultStr;
    }


    //5.视频消息
    private function receiveVideo($object)
    {
        $funcFlag = 0;
        $contentStr = "你发送的是视频，媒体ID为：".$object->MediaId;
        $resultStr = $this->transmitText($object, $contentStr, $funcFlag);
        return $resultStr;
    }


    //6.位置消息
    private function receiveLocation($object)
    {
        $funcFlag = 0;
        $contentStr = "你发送的是位置，纬度为：".$object->Location_X."；经度为：".$object->Location_Y."；缩放级别为：".$object->Scale."；位置为：".$object->Label;
        $resultStr = $this->transmitText($object, $contentStr, $funcFlag);
        return $resultStr;
    }


    //7.链接消息
    private function receiveLink($object)
    {
        $funcFlag = 0;
        $contentStr = "你发送的是链接，标题为：".$object->Title."；内容为：".$object->Description."；链接地址为：".$object->Url;
        $resultStr = $this->transmitText($object, $contentStr, $funcFlag);
        return $resultStr;
    }
}
