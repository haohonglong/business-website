<?php
use Aliyun\Core\Config;
use Aliyun\Core\Profile\DefaultProfile;
use Aliyun\Core\DefaultAcsClient;
use Aliyun\Api\Sms\Request\V20170525\SendSmsRequest;

function sendMsg($mobile,$code){
 
    //这里的路径EXTEND_PATH就是指tp5根目录下的extend目录，系统自带常量。alisms为我们复制api_sdk过来后更改的目录名称
    require_once EXTEND_PATH.'Alidayu/api_sdk/vendor/autoload.php';
    Config::load();             //加载区域结点配置
 
    $accessKeyId = 'LTAI0TLaYRWwKFaR';  //阿里云短信获取的accessKeyId
 
    $accessKeySecret = 'qecfrOVd44czQoBeGoLRZBLtampM1S';    //阿里云短信获取的accessKeySecret
 
    //这个个是审核过的模板内容中的变量赋值，记住数组中字符串code要和模板内容中的保持一致
    //比如我们模板中的内容为：你的验证码为：${code}，该验证码5分钟内有效，请勿泄漏！
    $templateParam = array("code"=>$code);           //模板变量替换
 
    $signName = '宫里的世界'; //这个是短信签名，要审核通过
 
    $templateCode = 'SMS_139237144';   //短信模板ID，记得要审核通过的
 
 
    //短信API产品名（短信产品名固定，无需修改）
    $product = "Dysmsapi";
    //短信API产品域名（接口地址固定，无需修改）
    $domain = "dysmsapi.aliyuncs.com";
    //暂时不支持多Region（目前仅支持cn-hangzhou请勿修改）
    $region = "cn-hangzhou";
 
    // 初始化用户Profile实例
    $profile = DefaultProfile::getProfile($region, $accessKeyId, $accessKeySecret);
    // 增加服务结点
    DefaultProfile::addEndpoint("cn-hangzhou", "cn-hangzhou", $product, $domain);
    // 初始化AcsClient用于发起请求
    $acsClient= new DefaultAcsClient($profile);
 
    // 初始化SendSmsRequest实例用于设置发送短信的参数
    $request = new SendSmsRequest();
    // 必填，设置雉短信接收号码
    $request->setPhoneNumbers($mobile);
 
    // 必填，设置签名名称
    $request->setSignName($signName);
 
    // 必填，设置模板CODE
    $request->setTemplateCode($templateCode);
 
    // 可选，设置模板参数
    if($templateParam) {
        $request->setTemplateParam(json_encode($templateParam));
    }
 
    //发起访问请求
    $acsResponse = $acsClient->getAcsResponse($request);
 
    //返回请求结果
    $result = json_decode(json_encode($acsResponse),true);
    return $result;
}

function authcode($string, $operation, $key = '') {

	$ckey_length = 4;

	$key = md5($key ? $key : 'asdf!@#$song1980');
	$keya = md5(substr($key, 0, 16));
	$keyb = md5(substr($key, 16, 16));
	$keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';

	$cryptkey = $keya.md5($keya.$keyc);
	$key_length = strlen($cryptkey);

	$string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', isset($expiry) ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
	$string_length = strlen($string);

	$result = '';
	$box = range(0, 255);

	$rndkey = array();
	for($i = 0; $i <= 255; $i++) {
		$rndkey[$i] = ord($cryptkey[$i % $key_length]);
	}

	for($j = $i = 0; $i < 256; $i++) {
			$j = ($j + $box[$i] + $rndkey[$i]) % 256;
			$tmp = $box[$i];
			$box[$i] = $box[$j];
			$box[$j] = $tmp;
	}

	for($a = $j = $i = 0; $i < $string_length; $i++) {
			$a = ($a + 1) % 256;
			$j = ($j + $box[$a]) % 256;
			$tmp = $box[$a];
			$box[$a] = $box[$j];
			$box[$j] = $tmp;
			$result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
	}

	if($operation == 'DECODE') {
		if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
			return substr($result, 26);
		} else {
			return '';
		}
	} else {
		return $keyc.str_replace('=', '', base64_encode($result));
	}

}

function PostData($Data, $Url, $TimeOut = 5) {
	$curl  = new \Curl\Curl();
	//$curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);
	//$curl->setOpt(CURLOPT_SSL_VERIFYHOST, 2);
    $curl->post($Url, $Data);
    return $curl->response;
}

function getImageViewUrl($url, $width=220, $height=160) {
    return $url . '?x-oss-process=image/resize,w_'.$width.',h_'.$height;
}
//数组转XML
function arrayToXml($arr) {
    $xml = "<xml>";
    foreach ($arr as $key => $val) {
        if (is_numeric($val)){
            $xml.="<".$key.">".$val."</".$key.">";
        }else{
            $xml.="<".$key."><![CDATA[".$val."]]></".$key.">";
        }
    }
    $xml .= "</xml>";
    return $xml;
}

//将XML转为array
function xmlToArray($xml) {
    //禁止引用外部xml实体
    libxml_disable_entity_loader(true);
    $values = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
    return $values;
}