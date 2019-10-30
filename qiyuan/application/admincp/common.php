<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE);

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

function tencentApi($url, $param, $secretKey) {

	$paramList = array();

	foreach ($param as $key => $value) {
		$paramList[] = $key.'='.$value;
	}

	$paramList = implode('&', $paramList);

	$srcStr = 'GET'.$url.'?'.$paramList;

	echo $postUrl = 'https://'.$url.'?'.$paramList;

	$signStr = base64_encode(hash_hmac('sha1', $srcStr, $secretKey, true));

	$returnData = file_get_contents($postUrl);

	return $returnData;

}
function getImageViewUrl($url, $width=120, $height=80) {
    return $url . '?x-oss-process=image/resize,w_'.$width.',h_'.$height;
}
