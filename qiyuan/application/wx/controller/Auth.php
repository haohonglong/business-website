<?php
namespace app\wx\controller;

use app\admincp\model\App;
use think\Config;
use think\Request;
use think\Cache;

use Wechat\mp\wxBizMsgCrypt;
use library\Helper;
use library\xml2array;

class Auth
{
    public function index()
    {

    	$request = Request::instance();

    	$encodingAesKey = '3mDmp1BAjLW6bbWLVEHI5SJdTHhrE726zHVkMphZFVH'; 
		$token = 'SAVw5mswuaZlX3W2KFRa2C0uDcHMnzD1obdM5hDWcWL12HRsvIvw3whyPMmDz2WV';
		$appId = 'wx552272bb2681754b';

		Cache::set('unauthorized','');

		$timeStamp = $request->param('timestamp');
		$nonce = $request->param('nonce');
		$msg_sign = $request->param('msg_signature');

		$encryptMsg = file_get_contents('php://input');

		$pc = new WXBizMsgCrypt($token, $encodingAesKey, $appId);

		$xml_tree = new \DOMDocument();
        $xml_tree->loadXML($encryptMsg);
        $array_e = $xml_tree->getElementsByTagName('Encrypt');
        $encrypt = $array_e->item(0)->nodeValue;
        $from_xml = sprintf("<xml><ToUserName><![CDATA[toUser]]></ToUserName><Encrypt><![CDATA[%s]]></Encrypt></xml>", $encrypt);

		$msg = '';
		$errCode = $pc->decryptMsg($msg_sign, $timeStamp, $nonce, $from_xml, $msg);

		if ($errCode == 0) {

			$result = XML2Array::createArray($msg);

			Cache::set('unauthorized', $result);

			$param = $result['xml'];

			$infoType = $param['InfoType']['@cdata'];

			switch ($infoType) {  
                case 'component_verify_ticket' :    // 授权凭证  
                    $componentVerifyTicket = $param['ComponentVerifyTicket']['@cdata'];  
                    Cache::set('wxPostTicket', $componentVerifyTicket, 7200);
                    echo 'success'; 
                    break;  
                case 'unauthorized' :               // 取消授权
                	$appid = $param['AuthorizerAppid']['@cdata'];  
                    $where['wxappid'] = $appid;
                    $update['status'] = 0;
                    App::where($where)->update($update);
                    break;  
                case 'authorized' :                 // 授权  
                    break;  
                case 'updateauthorized' :           // 更新授权  
                    break;  
            }
		} else {
			
			Cache::set('wxPostErrCode2', $errCode.time());
		}

    }

    public function callback()
    {

    	print_r(Cache::get('wxPostTicket'));

    	echo '<br/>';

    	print_r(Cache::get('unauthorized'));



    }
}
