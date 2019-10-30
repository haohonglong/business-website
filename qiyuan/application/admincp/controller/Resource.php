<?php

namespace app\admincp\controller;
use app\admincp\model\App;
use app\admincp\model\Resource as Res;
use app\admincp\model\ResourceComment as ResComment;
use app\admincp\model\Category;
use app\admincp\model\Setting;
use think\Request;
use think\Db;

class Resource extends Base {

    public function index() {

    	$appInfo = new App();
		$loginInfo = $appInfo->getLoginInfo();

		$openId = $loginInfo['openId'];
		$appId = $loginInfo['appId'];

		$totalParam = array('totalArticle', 'totalVideo');

		$where['keyword'] = ['in', $totalParam];
		$where['appId'] = $appId;

		$totalNum = Setting::where($where)->column('keyword, value');

		if(!$totalNum) {
			$setting = new Setting;
			$postData = [
				['appid' => $appId,'keyword' => 'totalArticle', 'value' => '0'],
				['appid' => $appId,'keyword' => 'totalVideo', 'value' => '0']
			];
			$setting->saveAll($postData);
			$totalNum = Setting::where($where)->column('keyword, value');
		}

		$request = Request::instance();

		$sort = $request->param('sort', '1');
		$keyword = $request->param('keyword', '');

   		$where = array(
        'appid' => $appId,
        'sort' => 1,
        'status' => 1
      );

      if ($keyword) {
         $where['title'] = ['like', "%$keyword%"];
      }

      $list = Res::where($where)->order(['id'=>'desc'])->paginate(20,false,[
          'query' => $request->param(),
      ]);

      $resourceList = $list->items();
      $total = $list->total();
      $page = $list->render();

      $where = array(
        'appid' => $appId,
        'sort' => $sort,
        'status' => 0
      );

      $categoryList = Category::where($where)->column('id, name');
      $categoryList[0] = '无分类';

      $sortNameList = array(
        1 => '图文',
        2 => '视频',
        3 => '问答',
      );

      $sortName = $sortNameList[$sort];

      $this->assign('categoryList', $categoryList);
      $this->assign('resourceList', $resourceList);
      $this->assign('page', $page);
      $this->assign('total', $total);
      $this->assign('sort', $sort);
      $this->assign('sortName', $sortName);
      $this->assign('keyword', $keyword);
      $this->assign('totalNum', $totalNum);

      $this->assign('title','资讯管理');

      return $this->fetch();
    
    }

    public function add() {

      $appInfo = new App();
      $loginInfo = $appInfo->getLoginInfo();

      $openId = $loginInfo['openId'];
      $appId = $loginInfo['appId'];

      $request = Request::instance();

      $sort = $request->param('sort', '1');

      $sortNameList = array(
        1 => '图文',
        2 => '视频',
        3 => '问答',
      );

      $title = '添加'.$sortNameList[$sort];
      $sortName = $sortNameList[$sort];

      $where = array(
        'appid' => $appId,
        'sort' => $sort,
        'status' => 0
      );

      $categoryList = Category::where($where)->order('displayorder desc')->column('id, name');

      $this->assign('title', $title);
      $this->assign('sortName', $sortName);
      $this->assign('sort', $sort);
      $this->assign('categoryList', $categoryList);

      return $this->fetch();

    }

    public function addResource() {

      $appInfo = new App();
      $loginInfo = $appInfo->getLoginInfo();

      $openId = $loginInfo['openId'];
      $appId = $loginInfo['appId'];

      $request = Request::instance();

      $cover = $request->param('cover', '', 'htmlspecialchars');
      $title = $request->param('title', '', 'htmlspecialchars');
      $categoryid = $request->param('categoryid', '', 'intval');
      $istop = $request->param('istop', '', 'intval');
      $picMode = $request->param('picMode', '', 'intval');
      $message = $request->param('message', '');
      $summary = $request->param('summary', '', 'htmlspecialchars');
      $url = $request->param('url', '');
      $sort = $request->param('sort', '');

      $postData = array(
        'appid' => $appId,
        'title' => $title,
        'cover' => $cover,
        'categoryid' => $categoryid,
        'istop' => $istop,
        'sort' => $sort,
        'picmode' => $picMode 
      );

      if($url) {
        $postData['url'] = $url;
      }

      $sqlData = Res::create($postData);

      $postDataComment = array(
        'rid' => $sqlData['id'],
        'message' => $message,
        'summary' => $summary
      );

      ResComment::create($postDataComment);

      switch ($sort) {
        case '1':
          $where = array(
            'appid' => $appId,
            'keyword' => 'totalArticle'
          );
          Setting::where($where)->setInc('value');
          break;
        case '2':
          $where = array(
            'appid' => $appId,
            'keyword' => 'totalVideo'
          );
          Setting::where($where)->setInc('value');
          break;
      }

      $this->redirect('/admincp/resource/index/sort/'.$sort);

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

      $resource = Res::where($where)->find();

      $where = array(
        'rid' => $id
      );

      $resourceCommnet = ResComment::where($where)->find();

      $sort = $resource['sort'];

      $sortNameList = array(
        1 => '图文',
        2 => '视频',
        3 => '问答',
      );

      $sortName = $sortNameList[$sort];
      // $title = '编辑'.$sortName;
      $title = '编辑'.$resource['title'];

      $where = array(
        'appid' => $appId,
        'sort' => $sort,
        'status' => 0
      );
      $categoryList = Category::where($where)->order('displayorder desc')->column('id, name');

      $this->assign('id', $id);
      $this->assign('resource', $resource);
      $this->assign('resourceCommnet', $resourceCommnet);
      $this->assign('categoryList', $categoryList);
      $this->assign('sort', $sort);
      $this->assign('sortName', $sortName);
      $this->assign('title', $title);

      return $this->fetch('edit');

    }

    public function editResource() {

      $appInfo = new App();
      $loginInfo = $appInfo->getLoginInfo();

      $openId = $loginInfo['openId'];
      $appId = $loginInfo['appId'];

      $request = Request::instance();

      $id = $request->param('id', '', 'htmlspecialchars');
      $cover = $request->param('cover', '', 'htmlspecialchars');
      $title = $request->param('title', '', 'htmlspecialchars');
      $categoryid = $request->param('categoryid', '', 'intval');
      $istop = $request->param('istop', '', 'intval');
      $url = $request->param('url', '');
      $sort = $request->param('sort', '');
      $message = $request->param('message', '');

      // $where = array(
      //   'id' => $id,
      //   'appid' => $appId
      // );

      // $postData = array(
      //   'title' => $title,
      //   'cover' => $cover,
      //   'categoryid' => $categoryid,
      //   'istop' => $istop,
      //   'sort' => $sort
      // );

      // if($url) {
      //   $postData['url'] = $url;
      // }

      // Res::where($where)->update($postData);

      $where = array(
        'rid' => $id
      );

      $postDataComment = array(
        'message' => $message,
        // 'url' => $url
      );

      ResComment::where($where)->update($postDataComment);

      $this->redirect("/admincp/resource/edit?id={$id}");

    }

    public function resourceTop() {

      $appInfo = new App();
      $loginInfo = $appInfo->getLoginInfo();

      $openId = $loginInfo['openId'];
      $appId = $loginInfo['appId'];

      $request = Request::instance();

      $id = $request->param('id', '', 'intval');
      $istop = $request->param('istop', '', 'intval');

      if($appId) {

        $where = array(
          'id' => $id,
          'appid' => $appId
        );

        $updateData = array(
          'istop' => $istop == 1 ? 0 : 1
        );

        $returnData = Res::where($where)->update($updateData);

      } else {
        return json_encode(array('error' => 'appid不存在'));
      }
    }

    public function hiddenResource() {

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

        $returnData = Res::where($where)->update($updateData);

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

      $sort = $request->param('sort', '1');

      $sortName = array(
        1 => '图文',
        2 => '视频',
        3 => '问答',
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
          'cover' => $cateCover
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

      $this->redirect('/admincp/resource/category?sort='.$sort);
    }

    public function hiddenCategory() {

      $appInfo = new App();
      $loginInfo = $appInfo->getLoginInfo();

      $openId = $loginInfo['openId'];
      $appId = $loginInfo['appId'];
      $username = $loginInfo['username'];
      $uid = $loginInfo['uid'];

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
