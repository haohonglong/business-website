<?php

namespace app\api\controller;

use OSS\Core\OssException;
use OSS\OssClient;
use think\Config;
use think\Controller;
use think\Request;
use app\api\model\Article;
use app\api\model\Tag;

class File extends Controller
{
    public function upload()
    {
        if (request()->isPost()) {
            $request = Request::instance();
            $appId = $request->param('appId', '', 'htmlspecialchars');

            if (!$appId) {
                return ['code' => 1, 'msg' => '参数错误'];
            }

            $endpoint = config('oss.endpoint_internet');
            $bucket = config('oss.bucket');
            $accessId = config('oss.access_id');
            $accessSecret = config('oss.access_secret');
            $ossHost = config('oss.cdn_host');

            $file = request()->file('file');
            $file->validate(['size'=>5*1024*1024, 'ext'=>'jpg,jpeg,png,gif']);
            if (!$file->check()) {
                return ['code' => 1, 'msg' => $file->getError()];
            }

            $filePath = $file->getRealPath();
            $content = file_get_contents($filePath);

            $size = $file->getInfo('size');
            $ext = pathinfo($file->getInfo('name'), PATHINFO_EXTENSION);

            $date = Date('Y').'/'.Date('m');
            $folder = "activity/$appId/$date/";
            $fileName = $this->createRandomStr(32).'.'.$ext;
            $object = $folder.$fileName;
            
            try {
                $ossClient = new OssClient($accessId, $accessSecret, $endpoint);
                $ossClient->putObject($bucket, $object, $content);
            } catch (OssException $e) {
                return ['code' => 1, 'msg' => '上传文件失败'];
            }

            return $ossHost.'/'.$object;
        }
    }

    private function createRandomStr($length){
        $str = array_merge(range(0,9), range('a','z'), range('A','Z'));
        shuffle($str);
        $str = implode('',array_slice($str,0,$length));
        return $str;
    }
}
