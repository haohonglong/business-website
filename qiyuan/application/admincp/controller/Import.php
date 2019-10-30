<?php

namespace app\admincp\controller;
use app\admincp\model\App;
use app\admincp\model\Permission;
use app\admincp\model\Resource;
use app\admincp\model\ResourceProduct;
use app\admincp\model\ResourceProductSku;
use app\admincp\model\ResourceProductCategory;
use think\Request;
use think\Db;

class Import extends Base {

    public function index() {

    	$appInfo = new App();
      $loginInfo = $appInfo->getLoginInfo();

      $openId = $loginInfo['openId'];
      $appId = $loginInfo['appId'];
      $username = $loginInfo['username'];
      $uid = $loginInfo['uid'];

      $goodsList = Db::name('goods')->select();

      foreach ($goodsList as $goods) {
        print_r($goods);

        $where = array(
          'goods_id' => $goods['id']
        );

        $goodsSku = Db::name('goodsSku')->where($where)->select();

        print_r($goodsSku);

        $postData = array(
          'appid' => $appId,
          'title' => $goods['title'],
          'cover' => $goods['cover'],
          'price' => $goods['price'],
          'stock' => $goods['stock'],
          'istop' => 0,
          'categoryid' => 17,
          'sort' => 4
        );

        $sqlData = Resource::create($postData);

        foreach ($goodsSku as $key => $sku) {
          $skuList[$goods['id']][] = $sku['attr_name'];
        }

        if(count($skuList[$goods['id']]) > 0) {
          $skuAttr = array(
            'name' => '规格',
            'list' => $skuList[$goods['id']]
          );
        }
        
        $postDataComment = array(
          'rid' => $sqlData['id'],
          'shipprice' => $goods['freight'],
          'sku' => json_encode(array($skuAttr)),
          'pic' => json_encode(array($goods['cover'])),
          'description' => $goods['description']
        );

        ResourceProduct::create($postDataComment);

        if($goodsSku) {
          foreach ($goodsSku as $key => $sku) {
            $postDataSku = array(
              'rid' => $sqlData['id'],
              'attr' => $sku['attr_name'],
              'price' => $sku['price'],
              'oprice' => $sku['price'],
              'stock' => $sku['stock'],
            );

            ResourceProductSku::create($postDataSku);
          }
        }

        $postDataSku = array(
          'rid' => $sqlData['id'],
          'cateid' => 17
        );

        ResourceProductCategory::create($postDataSku);


      }
    
    }

}
