<?php

namespace app\admincp\controller;
use app\admincp\model\App;
use app\admincp\model\Category;
use app\admincp\model\Resource;
use app\admincp\model\ResourceProduct;
use app\admincp\model\ResourceProductGroup;
use app\admincp\model\ResourceProductLottery;
use app\admincp\model\ResourceProductSku;
use app\admincp\model\ResourceProductCategory;
use think\Request;
use think\Db;

use library\simple_html_dom;

class Product extends Base {

    public function index() {

      $appInfo = new App();
      $loginInfo = $appInfo->getLoginInfo();

      $openId = $loginInfo['openId'];
      $appId = $loginInfo['appId'];

      $request = Request::instance();
      $keyword = $request->param('keyword', '');
      $status = $request->param('status', '0');

      if($status > 1) {
        $where = array(
          'appid' => $appId,
          'sort' => 4,
          'goodssort' => $status - 1
        );
      } else {
        $where = array(
          'appid' => $appId,
          'sort' => 4,
          'status' => $status
        );
      }

      if ($keyword) {
         $where['title'] = ['like', "%$keyword%"];
      }

      for ($i = 0; $i < 4; $i++) { 
        $select[$i] = $status == $i ? 'active' : '';
      }

      $list = Resource::where($where)->order(['id'=>'desc'])->paginate(20);

      $productList = $list->items();
      $total = $list->total();
      $page = $list->render();

      $where = array(
        'appid' => $appId,
        'sort' => 4,
        'status' => 0
      );

      $categoryList = Category::where($where)->column('id, name');
      $categoryList[0] = '无分类';

      $this->assign('categoryList', $categoryList);
      $this->assign('productList', $productList);
      $this->assign('page', $page);
      $this->assign('total', $total);
      $this->assign('status', $status);
      $this->assign('select', $select);
      $this->assign('keyword', $keyword);

      $this->assign('title','商品管理');
      return $this->fetch();
    
    }

    public function add() {

      $appInfo = new App();
      $loginInfo = $appInfo->getLoginInfo();

      $openId = $loginInfo['openId'];
      $appId = $loginInfo['appId'];

      $request = Request::instance();
      $sort = $request->param('sort', '0');

      $pCategoryList = $categoryList = array();

      $where = array(
        'appid' => $appId,
        'sort' => $sort,
        'status' => 0
      );

      $allList = Category::where($where)->order('displayorder desc')->column('id, parentid, name');

      foreach ($allList as $key => $cate) {
        if($cate['parentid'] == 0) {
          $pCategoryList[$key]['id'] = $cate['id'];
          $pCategoryList[$key]['name'] = $cate['name'];
        } else {
          $categoryList[$cate['parentid']][$key]['id'] = $cate['id'];
          $categoryList[$cate['parentid']][$key]['name'] = $cate['name'];
        }
      }

      $this->assign('pCategoryList', $pCategoryList);
      $this->assign('categoryList', $categoryList);
      $this->assign('title', '添加商品');

      return $this->fetch();

    }

    public function addproduct() {

      $appInfo = new App();
      $loginInfo = $appInfo->getLoginInfo();

      $openId = $loginInfo['openId'];
      $appId = $loginInfo['appId'];

      $request = Request::instance();
// dump($request->param());exit();
      $cover = $request->param('cover/a');
      $pcover = $request->param('pcover/a');
      $title = $request->param('title', '', 'htmlspecialchars');
      $productCate = $request->param('productCate/a');
      $price = $request->param('price', '', 'htmlspecialchars');
      $original_price = $request->param('original_price', '', 'htmlspecialchars');
      $stock = $request->param('stock', '', 'intval');
      $istop = $request->param('istop', 0, 'intval');
      $isPush = $request->param('isPush', 0, 'intval');
      $shipPrice = $request->param('shipPrice');
      $description = $request->param('description', '');
      $summary = $request->param('summary', '', 'htmlspecialchars');

      $isGroup = $request->param('isGroup', '', 'htmlspecialchars');
      $groupPrice = $request->param('groupPrice', '', 'htmlspecialchars');
      $groupJoinNum = $request->param('groupJoinNum', '', 'htmlspecialchars');

      $isLottery = $request->param('isLottery', '', 'htmlspecialchars');
      $lotteryInviteNum = $request->param('lotteryInviteNum', '5', 'htmlspecialchars');
      $totalnum = $request->param('totalnum', '5', 'htmlspecialchars');
      $lotteryEndTime = $request->param('lotteryEndTime', '', 'strtotime');
      $lotteryPriceNum = $request->param('lotteryPriceNum', '', 'intval');

      $skuLv1 = $request->param('lv1/a');
      $skuLv2 = $request->param('lv2/a');

      $skuPrice = $request->param('skuPrice/a');
      $skuStock = $request->param('skuStock/a');
      $skuOprice = $request->param('skuOprice/a');
      // $skuGroupprice = $request->param('skuGroupprice/a');

      $skuAttr = $skuValueList = array();

      if($skuLv1) {
        foreach ($skuLv1 as $key => $sku) {
          $skuAttr[$key]['name'] = $sku;
          $skuAttr[$key]['list'] = $skuLv2[$key];
        }

        $price = $skuPrice ? current($skuPrice) : $price;
        $stock = $skuStock ? current($skuStock) : $stock;
      }

      $goodssort = 0;

      if($isGroup) {
        $goodssort = 1;
      }

      if($isLottery) {
        $goodssort = 2;
      }

      $postData = array(
        'appid' => $appId,
        'title' => $title,
        'cover' => $cover[0],
        'pcover' => $pcover[0],
        'price' => $price,
        'original_price' => $original_price ? $original_price : $price,
        'stock' => $stock,
        'istop' => $istop,
        'isPush' => $isPush,
        'categoryid' => $productCate[0],
        'goodssort' => $goodssort,
        'sort' => 4,
        'summary' => $summary
      );

      $sqlData = Resource::create($postData);

      $postDataComment = array(
        'rid' => $sqlData['id'],
        'shipprice' => $shipPrice,
        'sku' => json_encode($skuAttr),
        'pic' => json_encode($cover),
        'ppic' => json_encode($pcover),
        'description' => $description,
        
      );

      ResourceProduct::create($postDataComment);

      if($skuPrice) {
        foreach ($skuPrice as $key => $num) {
          $postDataSku = array(
            'rid' => $sqlData['id'],
            'attr' => $key,
            'price' => $num,
            'oprice' => $skuOprice[$key],
            'stock' => $skuStock[$key],
            'groupprice' => $groupPrice,

          );

          ResourceProductSku::create($postDataSku);
        }
      }

      if($productCate) {
        foreach ($productCate as $cateid) {
          $postData = array(
            'rid' => $sqlData['id'],
            'cateid' => $cateid
          );

          ResourceProductCategory::create($postData);
        }
      }

      if($isGroup) {
        $postData = array(
          'rid' => $sqlData['id'],
          'price' => $groupPrice,
          'joinnum' => $groupJoinNum
        );

        ResourceProductGroup::create($postData);
      }

      if($isLottery) {
        $postData = array(
          'rid' => $sqlData['id'],
          'joinnum' => $lotteryInviteNum,
          'endtime' => $lotteryEndTime,
          'pricenum' => $lotteryPriceNum,
          'totalnum' => $totalnum,

        );

        ResourceProductLottery::create($postData);
      }

      $this->redirect('/admincp/product');

    }

    public function edit() {

      $appInfo = new App();
      $loginInfo = $appInfo->getLoginInfo();

      $openId = $loginInfo['openId'];
      $appId = $loginInfo['appId'];

      $request = Request::instance();

      $id = $request->param('id', '', 'intval');

      $where = array(
        'id' => $id,
        'appid' => $appId
      );

      $product = Resource::where($where)->find();

      $where = array(
        'rid' => $id
      );

      if($product['goodssort'] == 1) {
        $productGroup = ResourceProductGroup::where($where)->find();
      }

      if($product['goodssort'] == 2) {
        $productLottery = ResourceProductLottery::where($where)->find();
        $productLottery['endtime'] = date("Y-m-d H:i:s", $productLottery['endtime']);
      }

      $productComment = ResourceProduct::where($where)->find();
      $productSkuData = ResourceProductSku::where($where)->select();
      $productCategory = ResourceProductCategory::where($where)->column('cateid');

      $productComment['description'] = trim($productComment['description']);
      $productComment['description'] = str_replace(array("\r\n", "\r", "\n"), "", $productComment['description']); 

      $coverList = json_decode($productComment['pic'], TRUE);
      $pcoverList = json_decode($productComment['ppic'], TRUE);
      $skuList = json_decode($productComment['sku'], TRUE);

      $productSku = array();

      if($productSkuData) {
        foreach ($productSkuData as $value) {
          $productSku[$value['attr']]['price'] = $value['price'];
          $productSku[$value['attr']]['oprice'] = $value['oprice'];
          $productSku[$value['attr']]['stock'] = $value['stock'];
          // $productSku[$value['attr']]['groupprice'] = $value['groupprice'];
        }
      }

      $productSku = json_encode($productSku);

      $where = array(
        'appid' => $appId,
        'sort' => 4,
        'status' => 0
      );

      $allList = Category::where($where)->order('displayorder desc')->column('id, parentid, name');

      foreach ($allList as $key => $cate) {
        $allCategoryList[] = $cate['id'];
        if($cate['parentid'] == 0) {
          $pCategoryList[$key]['id'] = $cate['id'];
          $pCategoryList[$key]['name'] = $cate['name'];
        } else {
          $categoryList[$cate['parentid']][$key]['id'] = $cate['id'];
          $categoryList[$cate['parentid']][$key]['name'] = $cate['name'];
        }
      }

      $this->assign('pCategoryList', $pCategoryList);
      $this->assign('categoryList', $categoryList);
      $this->assign('id', $id);
      $this->assign('coverList', $coverList);
      $this->assign('pcoverList', $pcoverList);
      $this->assign('skuList', $skuList);
      $this->assign('product', $product);
      $this->assign('productComment', $productComment);
      $this->assign('productSku', $productSku);
      $this->assign('productCategory', $productCategory);
      $this->assign('productGroup', $productGroup);
      $this->assign('productLottery', $productLottery);

      $this->assign('allCategoryList', $allCategoryList);
      $this->assign('title', '编辑商品');

      return $this->fetch();

    }

    public function editproduct() {

      $appInfo = new App();
      $loginInfo = $appInfo->getLoginInfo();

      $openId = $loginInfo['openId'];
      $appId = $loginInfo['appId'];

      $request = Request::instance();

      $id = $request->param('id', '', 'intval');
      $cover = $request->param('cover/a');
      $pcover = $request->param('pcover/a');
      $title = $request->param('title', '', 'htmlspecialchars');
      $productCate = $request->param('productCate/a');
      $unprice = $request->param('price', '', 'htmlspecialchars');
      $original_price = $request->param('original_price', '', 'htmlspecialchars');
      $stock = $request->param('stock', '', 'intval');
      $istop = $request->param('istop', 0, 'intval');
      $shipPrice = $request->param('shipPrice');
      $description = $request->param('description', '');
      $summary = $request->param('summary', '', 'htmlspecialchars');

      $isGroup = $request->param('isGroup', '', 'htmlspecialchars');
      $groupPrice = $request->param('groupPrice', '', 'htmlspecialchars');
      $groupJoinNum = $request->param('groupJoinNum', '', 'htmlspecialchars');

      $isLottery = $request->param('isLottery', '', 'htmlspecialchars');
      $lotteryInviteNum = $request->param('lotteryInviteNum', '5', 'intval');
      $totalnum = $request->param('totalnum', '', 'intval');
      $lotteryEndTime = $request->param('lotteryEndTime','','strtotime');
      $lotteryPriceNum = $request->param('lotteryPriceNum', '', 'intval');

      $skuLv1 = $request->param('lv1/a');
      $skuLv2 = $request->param('lv2/a');

      $skuPrice = $request->param('skuPrice/a');
      $skuStock = $request->param('skuStock/a');
      $skuOprice = $request->param('skuOprice/a');
      // $skuGroupprice = $request->param('skuGroupprice/a');
      $skuAttr = $skuValueList = array();

      if($skuLv1) {
        foreach ($skuLv1 as $key => $sku) {
          $skuAttr[$key]['name'] = $sku;
          $skuAttr[$key]['list'] = $skuLv2[$key];
        }

        $price = current($skuPrice);
        $stock = current($skuStock);
      }

      $where = array(
        'id' => $id,
        'appid' => $appId
      );

      $productData = Resource::where($where)->find();

      $goodssort = 0;

      if($isGroup) {
        $goodssort = 1;
      }

      if($isLottery) {
        $goodssort = 2;
      }

      $postData = array(
        'title' => $title,
        'cover' => $cover[0],
        'pcover' => $pcover[0],
        'price' => $unprice,
        'original_price' => $original_price ? $original_price : $unprice,
        'stock' => $stock,
        'istop' => $istop,
        'categoryid' => $productCate[0],
        'goodssort' => $goodssort,
        'summary' => $summary
      );
      Resource::where($where)->update($postData);

      $where = array(
        'rid' => $productData['id']
      );

      if($isGroup) {
        if($productData['goodssort'] == 1) {
          $postData = array(
            'price' => $groupPrice,
            'joinnum' => $groupJoinNum
          );

          ResourceProductGroup::where($where)->update($postData);
        } else {
          $postDataSku = array(
            'rid' => $productData['id'],
            'price' => $groupPrice,
            'joinnum' => $groupJoinNum
          );

          ResourceProductGroup::create($postDataSku);
        }
      }

      if($isLottery) {
        if($productData['goodssort'] == 2) {
          $postData = array(
            'joinnum' => $lotteryInviteNum,
            'endtime' => $lotteryEndTime,
            'pricenum' => $lotteryPriceNum,
            'totalnum' => $totalnum,
          );

          ResourceProductLottery::where($where)->update($postData);
        } else {
          $postDataSku = array(
            'rid' => $productData['id'],
            'joinnum' => $lotteryInviteNum,
            'endtime' => $lotteryEndTime,
          );

          ResourceProductLottery::create($postDataSku);
        }
      }

      $postDataComment = array(
        'shipprice' => $shipPrice,
        'sku' => json_encode($skuAttr, JSON_UNESCAPED_UNICODE),
        'pic' => json_encode($cover),
        'ppic' => json_encode($pcover),
        'description' => $description,
        
      );
      
      ResourceProduct::where($where)->update($postDataComment);

      if($skuPrice) {
        ResourceProductSku::where($where)->delete();

        foreach ($skuPrice as $key => $num) {
          $postDataSku = array(
            'rid' => $productData['id'],
            'attr' => $key,
            'price' => $num,
            'oprice' => $skuOprice[$key],
            'groupprice' => $groupPrice,
            'stock' => $skuStock[$key],
          );

          ResourceProductSku::create($postDataSku);
        }
      }

      if($productCate) {
        ResourceProductCategory::where($where)->delete();

        foreach ($productCate as $cateid) {
          $postDataSku = array(
            'rid' => $productData['id'],
            'cateid' => $cateid
          );

          ResourceProductCategory::create($postDataSku);
        }
      }

      $this->redirect('/admincp/product');

    }

    public function hiddenProduct() {

      $appInfo = new App();
      $loginInfo = $appInfo->getLoginInfo();

      $openId = $loginInfo['openId'];
      $appId = $loginInfo['appId'];

      $request = Request::instance();

      $id = $request->param('id', '', 'intval');
      $status = $request->param('status', '', 'intval');

      if($appId) {
        $where = array(
          'id' => $id,
          'appid' => $appId
        );

        $updateData = array(
          'status' => $status == 1 ? 0 : 1
        );

        $returnData = Resource::where($where)->update($updateData);

      } else {
        return json_encode(array('error' => 'appid不存在'));
      }
    }

    public function categoryDetail() {

      $appInfo = new App();
      $loginInfo = $appInfo->getLoginInfo();

      $openId = $loginInfo['openId'];
      $appId = $loginInfo['appId'];

      $id = Request::instance()->param('id', '', 'intval');

      $where = array(
        'appid' => $appId,
        'id' => $id
      );
      
      $categoryDetail = Category::where($where)->find();

      return json_encode($categoryDetail);
    }

    public function category() {

      $appInfo = new App();
      $loginInfo = $appInfo->getLoginInfo();

      $openId = $loginInfo['openId'];
      $appId = $loginInfo['appId'];

      $request = Request::instance();

      $sort = $request->param('sort', '4');

      $sortName = array(
        4 => '商品',
      );

      $title = '设置'.$sortName[$sort].'分类';

      $pCategoryList = $categoryList = array();

      $where = array(
        'appid' => $appId,
        'sort' => $sort,
        'status' => 0
      );

      $allList = Category::where($where)->order('displayorder desc')->column('id, parentid, name');

      foreach ($allList as $key => $cate) {
        if($cate['parentid'] == 0) {
          $pCategoryList[$key]['id'] = $cate['id'];
          $pCategoryList[$key]['name'] = $cate['name'];
        } else {
          $categoryList[$cate['parentid']][$key]['id'] = $cate['id'];
          $categoryList[$cate['parentid']][$key]['name'] = $cate['name'];
        }
      }

      $this->assign('title', $title);
      $this->assign('sort', $sort);
      $this->assign('pCategoryList', $pCategoryList);
      $this->assign('categoryList', $categoryList);

      return $this->fetch();

    }

    public function addCategory() {

      $appInfo = new App();
      $loginInfo = $appInfo->getLoginInfo();

      $openId = $loginInfo['openId'];
      $appId = $loginInfo['appId'];

      $request = Request::instance();

      $sort = $request->param('sort', '1');
      $pid = $request->param('pid', '0');
      $cid = $request->param('cid', '0');
      $cname = $request->param('cname', '', 'htmlspecialchars');
      $cateCover = $request->param('cateCover', '', 'htmlspecialchars');

      if($cid) {

        $where = array(
          'id' => $cid,
          'appid' => $appId
        );

        $updateData = array(
          'name' => $cname,
          'cover' => $cateCover,
          'parentid' => $pid
        );

        $returnData = Category::where($where)->update($updateData);

      } else {

        $postData = array(
          'appid' => $appId,
          'sort' => $sort,
          'parentid' => $pid,
          'name' => $cname,
          'cover' => $cateCover
        );
        Category::create($postData);
      }

      $this->redirect('/admincp/product/category?sort='.$sort);
    }

    public function hiddenCategory() {

      $appInfo = new App();
      $loginInfo = $appInfo->getLoginInfo();

      $openId = $loginInfo['openId'];
      $appId = $loginInfo['appId'];

      $request = Request::instance();

      $id = $request->param('id', '', 'intval');

      if($appId) {
        $where = array(
          'id' => $id,
          'appid' => $appId
        );

        $updateData = array(
          'status' => 1
        );

        Category::where($where)->update($updateData);

      } else {
        return json_encode(array('error' => 'appid不存在'));
      }
    }

}
