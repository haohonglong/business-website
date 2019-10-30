<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:83:"D:\phpstudy\PHPTutorial\WWW\information/application/admincp\view\setting\index.html";i:1545193073;s:83:"D:\phpstudy\PHPTutorial\WWW\information/application/admincp\view\common\header.html";i:1545193073;s:81:"D:\phpstudy\PHPTutorial\WWW\information/application/admincp\view\common\menu.html";i:1545193073;s:83:"D:\phpstudy\PHPTutorial\WWW\information/application/admincp\view\common\footer.html";i:1545193073;}*/ ?>
<html lang="en">
<!--<![endif]-->
<head>
    <meta charset="utf-8" />
    <title>飞燕管理后台<?php echo !empty($title)?'-'.$title : ''; ?></title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <!--<link rel="shortcut icon" type="image/ico" href="favicon.ico" />-->

    <!-- Vendor styles -->
    <link rel="stylesheet" type="text/css" href="__ROOT__/public/assets/plugins/jquery-ui/jquery-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="__ROOT__/public/assets/plugins/bootstrap/4.1.0/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="__ROOT__/public/assets/plugins/font-awesome/5.0/css/fontawesome-all.min.css" />
    <link rel="stylesheet" type="text/css" href="__ROOT__/public/assets/plugins/animate/animate.min.css" />
    <link rel="stylesheet" type="text/css" href="__ROOT__/public/assets/css/material/style.css" />
    <link rel="stylesheet" type="text/css" href="__ROOT__/public/assets/css/material/style-responsive.min.css" />
    <link rel="stylesheet" type="text/css" href="__ROOT__/public/assets/css/material/theme/default.css" />
    <!-- ================== END BASE CSS STYLE ================== -->
    
    <!-- ================== BEGIN PAGE LEVEL CSS STYLE ================== -->
    <link rel="stylesheet" type="text/css" href="__ROOT__/public/assets/plugins/jquery-jvectormap/jquery-jvectormap.css" />
    <link rel="stylesheet" type="text/css" href="__ROOT__/public/assets/plugins/bootstrap-calendar/css/bootstrap_calendar.css" />
    <link rel="stylesheet" type="text/css" href="__ROOT__/public/assets/plugins/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="__ROOT__/public/assets/plugins/nvd3/build/nv.d3.css" />
    <link rel="stylesheet" type="text/css" href="__ROOT__/public/assets/plugins/bootstrap-sweetalert/sweetalert.css" />
    <!-- ================== END PAGE LEVEL CSS STYLE ================== -->
    

    <link rel="stylesheet" type="text/css" href="__ROOT__/public/assets/plugins/jstree/dist/themes/default/style.min.css" />

    <!-- ================== BEGIN BASE JS ================== -->
    <script type="text/javascript" src="__ROOT__/public/assets/plugins/pace/pace.min.js"></script>

    <link rel="stylesheet" type="text/css" href="__ROOT__/public/assets/plugins/dropzone/min/dropzone.min.css" />

    <link rel="stylesheet" type="text/css" href="__ROOT__/public/assets/plugins/bootstrap-eonasdan-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />
<body>


<div id="page-container" class="page-container <?php if($type=='WX'): ?>page-without-sidebar<?php endif; ?> page-sidebar-fixed page-header-fixed">
  <div id="header" class="header navbar-default">
    <!-- begin navbar-header -->
    <div class="navbar-header">
      <a href="__ROOT__/admincp/index" class="navbar-brand">
        飞燕小程序管理后台<?php echo !empty($appInfo['name'])?'-'.$appInfo['name'] : ''; ?>
      </a>
    </div>
    <!-- end navbar-header -->
    
    <!-- begin header-nav -->
    <ul class="navbar-nav navbar-right">
      <li class="navbar-user">
        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
          <span class="d-none d-md-inline">你好，<?php echo $userInfo['username']; ?></span>
          <img src="<?php echo $userInfo['avatar']; ?>" alt="" /> 
        </a>
      </li>
      <li>
        <a href="__ROOT__/admincp/logout" class="icon">
          <i class="fas fa-power-off fa-fw"></i>
        </a>
      </li>
    </ul>
  </div>
  <?php if($type == 'MP'): ?>
  <div id="sidebar" class="sidebar" data-disable-slide-animation="true" style="width: 180px">
    <!-- begin sidebar scrollbar -->
    <div data-scrollbar="true" data-height="100%">
      <!-- begin sidebar nav -->
      <ul class="nav">
        <li class="nav-header"></li>
        <li class="<?php echo \think\Request::instance()->controller()=='Index'?'active' : 'has-sub'; ?>">
          <a href="__ROOT__/admincp/index">
            <i class="fas fa-home fa-fw"></i>
            <span>后台首页</span>
          </a>
        </li>
      </ul>
      <ul class="nav">
        <li class="<?php echo \think\Request::instance()->controller()=='User'?'active' : 'has-sub'; ?>">
          <a href="__ROOT__/admincp/user">
            <i class="fas fa-user fa-fw"></i>
            <span>用户管理</span>
          </a>
        </li>
      </ul>
    
      <ul class="nav">
        <li class="<?php echo \think\Request::instance()->controller()=='Product'?'active' : 'has-sub'; ?>">
          <a href="__ROOT__/admincp/product">
            <i class="fas fa-shopping-cart fa-fw"></i>
            <span>商品管理</span>
          </a>
        </li>
      </ul>
      <ul class="nav">
        <li class="<?php echo \think\Request::instance()->controller()=='Order'?'active' : 'has-sub'; ?>">
          <a href="__ROOT__/admincp/order">
            <i class="fas fa-th-large fa-fw"></i>
            <span>订单管理</span>
          </a>
        </li>
      </ul>
      <ul class="nav">
        <li class="<?php if(in_array((\think\Request::instance()->controller()), is_array($PluginName)?$PluginName:explode(',',$PluginName))): ?>active<?php else: ?>has-sub<?php endif; ?>">
          <a href="__ROOT__/admincp/plugin">
              <i class="fas fa-gift fa-fw"></i>
              <span>营销组件</span>
          </a>
        </li>
      </ul>
      <ul class="nav">
        <li class="<?php echo \think\Request::instance()->controller()=='Resource'?'active' : 'has-sub'; ?>">
          <a href="__ROOT__/admincp/resource/index">
            <i class="fas fa-file fa-fw"></i>
            <span>文章设置</span>
          </a>
        </li>
      </ul>
      <!-- <ul class="nav">
        <li class="<?php echo \think\Request::instance()->controller()=='Resource'?'active' : 'has-sub'; ?>">
          <a href="__ROOT__/admincp/resource/edit?id=2">
            <i class="fas fa-file fa-fw"></i>
            <span>关于我们</span>
          </a>
        </li>
      </ul> -->
      <!--
      <ul class="nav">
        <li class="<?php echo \think\Request::instance()->controller()=='Stats'?'active' : 'has-sub'; ?>">
          <a href="__ROOT__/admincp/stats">
              <i class="fas fa-chart-bar fa-fw"></i>
              <span>数据统计</span>
          </a>
        </li>
      </ul>
      <ul class="nav">
        <li class="<?php echo \think\Request::instance()->controller()=='Material'?'active' : 'has-sub'; ?>">
          <a href="__ROOT__/admincp/material">
              <i class="fas fa-image fa-fw"></i>
              <span>素材管理</span>
          </a>
        </li>
      </ul> -->
      <ul class="nav">
        <li class="<?php echo \think\Request::instance()->controller()=='Setting'?'active' : 'has-sub'; ?>">
          <a href="__ROOT__/admincp/setting">
              <i class="fas fa-cog fa-fw"></i>
              <span>系统设置</span>
          </a>
        </li>
      </ul>
      <?php if($openId): ?>
        <ul class="nav">
          <li class="">
            <a href="__ROOT__/admincp/index/returnlist">
                <i class="fas fa-list fa-fw"></i>
                <span>返回列表</span>
            </a>
          </li>
        </ul>
      <?php endif; ?>
    </div>
  </div>
  <div class="sidebar-bg" style="width: 180px"></div>
  <?php endif; ?>

<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">管理后台</a></li>
        <li class="breadcrumb-item active">
            <?php switch($act): case "swiper": ?>首页轮播图设置<?php break; endswitch; ?>
        </li>
    </ol>
    <h1 class="page-header">
        <?php switch($act): case "swiper": ?>首页轮播图设置<?php break; endswitch; ?>
    </h1>
    <div class="row">
        <div class="col-lg-2">
            <div class="widget-list widget-list-rounded">
                <!-- begin widget-list-item -->
                <!--<a href="__ROOT__/admincp/setting" class="widget-list-item">
                    <div class="widget-list-media icon">
                        <i class="fa fa-cogs bg-grey text-inverse text-white"></i>
                    </div>
                    <div class="widget-list-content">
                        <h4 class="widget-list-title">全局设置</h4>
                    </div>
                    <div class="widget-list-action text-nowrap text-grey-darker text-right">
                        <i class="fa fa-angle-right text-muted t-plus-1 fa-lg m-l-5"></i>
                    </div>
                </a>-->
                <a href="__ROOT__/admincp/setting/index/act/swiper" class="widget-list-item">
                    <div class="widget-list-media icon">
                        <i class="fa fa-images bg-grey text-inverse text-white"></i>
                    </div>
                    <div class="widget-list-content">
                        <h4 class="widget-list-title">首页轮播图设置</h4>
                    </div>
                    <div class="widget-list-action text-nowrap text-grey-darker text-right">
                        <i class="fa fa-angle-right text-muted t-plus-1 fa-lg m-l-5"></i>
                    </div>
                </a>
                <!-- <a href="__ROOT__/admincp/setting/index/act/style" class="widget-list-item">
                    <div class="widget-list-media icon">
                        <i class="fa fa-puzzle-piece bg-grey text-inverse text-white"></i>
                    </div>
                    <div class="widget-list-content">
                        <h4 class="widget-list-title">模板设置</h4>
                    </div>
                    <div class="widget-list-action text-nowrap text-grey-darker text-right">
                        <i class="fa fa-angle-right text-muted t-plus-1 fa-lg m-l-5"></i>
                    </div>
                </a> -->
                <!--<a href="__ROOT__/admincp/setting/index/act/pay" class="widget-list-item">
                    <div class="widget-list-media icon">
                        <i class="fa fa-credit-card bg-grey text-inverse text-white"></i>
                    </div>
                    <div class="widget-list-content">
                        <h4 class="widget-list-title">支付设置</h4>
                    </div>
                    <div class="widget-list-action text-nowrap text-grey-darker text-right">
                        <i class="fa fa-angle-right text-muted t-plus-1 fa-lg m-l-5"></i>
                    </div>
                </a>
                <a href="__ROOT__/admincp/setting/index/act/version" class="widget-list-item">
                    <div class="widget-list-media icon">
                        <i class="fa fa-code bg-grey text-inverse text-white"></i>
                    </div>
                    <div class="widget-list-content">
                        <h4 class="widget-list-title">小程序设置</h4>
                    </div>
                    <div class="widget-list-action text-nowrap text-grey-darker text-right">
                        <i class="fa fa-angle-right text-muted t-plus-1 fa-lg m-l-5"></i>
                    </div>
                </a>-->
            </div>
        </div>
        <!-- begin col-6 -->
        <div class="col-lg-10">
            <?php switch($act): case "pay": ?>
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <h4 class="panel-title">支付设置</h4>
                        </div>
                        <!-- end panel-heading -->
                        <!-- begin panel-body -->
                        
                    </div>
                <?php break; case "swiper": ?>
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <h4 class="panel-title">首页轮播图设置</h4>
                        </div>
                        <!-- end panel-heading -->
                        <!-- begin panel-body -->
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <a href="#addSwiper" class="btn btn-primary" style="margin-bottom: 10px;" data-toggle="modal">
                                        新增轮播图
                                    </a>
                                </div>
                            </div>
                            <table id="data-table-default" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>图片</th>
                                        <th>链接</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody id="swiperList">
                                    <?php if(count($swiperList) > 0): if(is_array($swiperList) || $swiperList instanceof \think\Collection || $swiperList instanceof \think\Paginator): if( count($swiperList)==0 ) : echo "" ;else: foreach($swiperList as $key=>$swiper): ?>
                                            <tr id="swiper<?php echo $key; ?>">
                                                <td style="width:20%"><img src="<?php echo $swiper['cover']; ?>" alt="" style="width: 315px;height: 157px" id="cover<?php echo $key; ?>"/></td>
                                                <td style="width:30%" id="link<?php echo $key; ?>"><?php echo $swiper['link']; ?></td>
                                                <td>
                                                    <div class="btn btn-primary btn-sm" onclick="editSwiper(<?php echo $key; ?>)" data-toggle="modal" data-target="#editSwiper">编辑</div>
                                                    <div class="btn btn-warning btn-sm" onclick="hiddenSwiper(<?php echo $key; ?>)">删除</div>
                                                </td>
                                            </tr>
                                        <?php endforeach; endif; else: echo "" ;endif; else: ?>
                                        <tr id="noneSwiper">
                                            <td colspan="9" style="text-align: center;padding:20px">暂无数据</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>   
                        </div>
                    </div>
                <?php break; case "style": break; case "version": ?>
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <h4 class="panel-title">线上版本</h4>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <?php if($versionInfo[2]): ?>
                                    <div class="col-sm-1 f-s-14 m-10 f-w-400">
                                        <div>版本：</div>
                                        <div class="f-w-500" style="font-size: 30px"><?php echo $appTemplate[$versionInfo[2]['version']]['version']; ?></div>
                                    </div>
                                    <div class="col-sm-6 f-s-14 m-10 f-w-400">
                                        <div>发布人：<?php echo $versionInfo[2]['publisher']; ?></div>
                                        <div class="m-t-5">发布时间：<?php echo $versionInfo[2]['create_time']; ?></div>
                                        <div class="m-t-5">版本描述：<?php echo $versionInfo[2]['description']; ?></div>
                                    </div>
                                <?php else: ?>
                                    <div class="width-full m-40 text-center f-s-16">暂没有线上版本</div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <h4 class="panel-title">审核版本</h4>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <?php if($versionInfo[1]): ?>
                                    <div class="col-sm-1 f-s-14 m-10 f-w-400">
                                        <div>版本：</div>
                                        <div class="f-w-500" style="font-size: 30px"><?php echo $appTemplate[$versionInfo[1]['version']]['version']; ?></div>
                                    </div>
                                    <div class="col-sm-6 f-s-14 m-10 f-w-400">
                                        <div>提交人：<?php echo $versionInfo[1]['publisher']; ?></div>
                                        <div class="m-t-5">提交时间：<?php echo $versionInfo[1]['create_time']; ?></div>
                                        <div class="m-t-5">
                                            提交分类：<?php echo $mpCategory[$versionInfo[1]['categoryid']]['first_class']; ?>/<?php echo $mpCategory[$versionInfo[1]['categoryid']]['second_class']; ?>
                                        </div>
                                        <div class="m-t-5">版本描述：<?php echo $versionInfo[1]['description']; ?></div>
                                        
                                    </div>
                                    <div class="col-sm-4 f-s-14 m-10 f-w-400 text-right p-5">
                                        <div class="btn btn-grey" id="auditButton">正在审核中</div>
                                    </div>
                                <?php else: ?>
                                    <div class="width-full m-40 text-center f-s-16">暂没有审核版本</div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <h4 class="panel-title">体验版本</h4>
                        </div>
                        <!-- end panel-heading -->
                        <!-- begin panel-body -->
                        <div class="panel-body">
                            <div class="row">
                                <?php if($versionInfo[0]): ?>
                                    <div class="col-sm-1 f-s-14 m-10 f-w-400">
                                        <div>版本：</div>
                                        <div class="f-w-500" style="font-size: 30px"><?php echo $appTemplate[$versionInfo[0]['version']]['version']; ?></div>
                                    </div>
                                    <div class="col-sm-6 f-s-14 m-10 f-w-400">
                                        <div>提交人：<?php echo $versionInfo[0]['publisher']; ?></div>
                                        <div class="m-t-5">提交时间：<?php echo $versionInfo[0]['create_time']; ?></div>
                                        <div class="m-t-5">版本描述：<?php echo $versionInfo[0]['description']; ?></div>
                                    </div>
                                    <div class="col-sm-4 f-s-14 m-10 f-w-400 text-right p-5">
                                        <div class="btn btn-primary" data-toggle="modal" data-target="#getQrcode" onclick="getQrcode()">扫码体验</div>
                                        <div class="btn btn-primary" data-toggle="modal" data-target="#submitAudit">提交审核</div>
                                    </div>
                                <?php else: ?>
                                    <div class="width-full m-30 text-center f-s-16">
                                        <div class="m-b-15">暂没有体验版本</div>
                                        <div class="btn btn-primary" onclick="uploadVersion()" id="uploadVersion">上传体验版</div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php break; default: ?>
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <h4 class="panel-title">小程序ID设置</h4>
                        </div>
                        <!-- end panel-heading -->
                        <!-- begin panel-body -->
                        <div class="panel-body">
                            <div class="alert alert-secondary">
                                AppID和AppSecre用于生成小程序码和微信支付，如果不填写将没法用这两个功能
                            </div>
                            <form action="__ROOT__/admincp/setting/save" method="post">
                                <div class="form-group row m-b-15">
                                    <label class="col-form-label col-md-2">AppID</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control m-b-5" placeholder="AppID" name="appId" value="<?php echo $wxInfo[0]; ?>"/>
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-form-label col-md-2">AppSecret</label>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control m-b-5" placeholder="AppSecret" name="appSecret" value="<?php echo $appInfo['wxinfo']; ?>"/>
                                    </div>
                                </div>
                                <div class="form-group row m-b-0">
                                    <label class="col-md-2 col-sm-2 col-form-label">&nbsp;</label>
                                    <div class="col-md-9 col-sm-8">
                                        <button type="submit" class="btn btn-primary">提 交</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
            <?php endswitch; ?>
        </div>
    </div>
</div>
<div class="modal fade" id="getQrcode" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" style="top:200px;">
        <
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    扫码体验
                </h4>
                <div class="close" data-dismiss="modal" aria-hidden="true">×</div>
            </div>
            <div class="modal-body">
                <div class="form-group row m-b-15">
                    <div class="col-md-12 text-center" id="qrCodeImage">
                        
                    </div>
                    <div class="col-md-12 text-center">
                        微信扫码查看体验版
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="submitAudit" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" style="top:200px;">
        <
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    提交审核
                </h4>
                <div class="close" data-dismiss="modal" aria-hidden="true">×</div>
            </div>
            <div class="modal-body">
                <div class="form-group row m-b-15">
                    <label class="col-form-label col-md-2">标签</label>
                    <div class="col-md-9">
                        <input type="text" name="tag" class="form-control m-b-5" placeholder="填写小程序标签，例如电商、母婴, 多个用空格隔开" id="tag">
                    </div>
                </div>
                <div class="form-group row m-b-15">
                    <label class="col-form-label col-md-2">分类</label>
                    <div class="col-md-9">
                        <?php if(is_array($mpCategory) || $mpCategory instanceof \think\Collection || $mpCategory instanceof \think\Paginator): $i = 0; $__LIST__ = $mpCategory;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cate): $mod = ($i % 2 );++$i;?>
                            <div class="radio radio-css">
                                <input type="radio" name="category" id="cssRadio<?php echo $key; ?>" value="<?php echo $key; ?>">
                                <label for="cssRadio<?php echo $key; ?>" class="f-s-14 f-w-400"><?php echo $cate['first_class']; ?> - <?php echo $cate['second_class']; ?></label>
                            </div>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="submitAudit()">提交</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addSwiper" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" style="top:200px;">
        <
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    新增轮播图
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="newcover" id="newcover">
                <div class="form-group row m-b-15">
                    <label class="col-form-label col-md-2">
                        封面图片<br />
                        <small class="f-s-14 m-t-16 text-grey-darker">建议尺寸375*175</small>
                    </label>
                    <div class="col-md-10">
                        <div class="dropzone" id="myDropzone" style="padding:5px;height: 170px;">
                            <div class="am-text-success dz-message" style="margin: 0px;font-size: 20px;">
                                <img src="" alt="" style="width: 315px;height: 157px;" id="newCoverShow"/>
                                <div id="uploadTips" style="padding-top:50px;font-size: 20px;">将文件拖拽到此处或点此上传文件</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row m-b-15">
                    <label class="col-form-label col-md-2">链接</label>
                    <div class="col-md-10">
                        <input type="text" name="newlink" class="form-control m-b-5" placeholder="链接" id="newlink">
                        <ul class="parsley-errors-list filled" id="noneLinkTips" style="display: none;"><li class="parsley-required">没有填写链接</li></ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="addSwiper()">提交</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editSwiper" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" style="top:200px;">
        <
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">编辑幻灯片</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="swiperId" id="swiperId">
                <input type="hidden" name="editcover" id="editcover">
                <div class="form-group row m-b-15">
                    <label class="col-form-label col-md-2">
                        封面图片<br />
                        <small class="f-s-14 m-t-16 text-grey-darker">建议尺寸375*175</small>
                    </label>
                    <div class="col-md-10">
                        <div class="dropzone" id="editDropzone" style="padding:5px;height: 170px;">
                          <div class="am-text-success dz-message" style="margin: 0px;">
                            <img src="" alt="" style="width: 315px;height: 157px;" id="editCoverShow"/>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row m-b-15">
                    <label class="col-form-label col-md-2">链接</label>
                    <div class="col-md-10">
                        <input type="text" name="editlink" class="form-control m-b-5" placeholder="链接" id="editlink" value="">
                        <ul class="parsley-errors-list filled" id="noneLinkTips" style="display: none;"><li class="parsley-required">没有填写链接</li></ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="editPostSwiper()">提交</button>
            </div>
        </div>
    </div>
</div>

<div id="uploadPreview" style="display: none;">
    <img src="" alt="" style="width: 100%;height: 200px" id="editCoverShow"/>
</div>
<?php if(\think\Request::instance()->controller() != 'Login'): ?>
	<div id="footer" class="footer">
		2017-2019 飞燕小程序技术支持
	</div>
<?php endif; ?>
</div>
<script type="text/javascript" src="__ROOT__/public/assets/plugins/jquery/jquery-2.2.4.min.js"></script>
<script type="text/javascript" src="__ROOT__/public/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="__ROOT__/public/assets/plugins/bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script>
<!--[if lt IE 9]>
	<script src="../assets/crossbrowserjs/html5shiv.js"></script>
	<script src="../assets/crossbrowserjs/respond.min.js"></script>
	<script src="../assets/crossbrowserjs/excanvas.min.js"></script>
<![endif]-->
<script type="text/javascript" src="__ROOT__/public/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script type="text/javascript" src="__ROOT__/public/assets/plugins/js-cookie/js.cookie.js"></script>
<script type="text/javascript" src="__ROOT__/public/assets/js/theme/material.min.js"></script>
<script type="text/javascript" src="__ROOT__/public/assets/js/apps.min.js"></script>
<!-- ================== END BASE JS ================== -->
	
<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script type="text/javascript" src="__ROOT__/public/assets/js/d3.min.js"></script>
<script type="text/javascript" src="__ROOT__/public/assets/plugins/nvd3/build/nv.d3.js"></script>
<script type="text/javascript" src="__ROOT__/public/assets/plugins/jquery-jvectormap/jquery-jvectormap.min.js"></script>
<script type="text/javascript" src="__ROOT__/public/assets/plugins/jquery-jvectormap/jquery-jvectormap-world-merc-en.js"></script>
<script type="text/javascript" src="__ROOT__/public/assets/plugins/bootstrap-calendar/js/bootstrap_calendar.min.js"></script>
<script type="text/javascript" src="__ROOT__/public/assets/plugins/gritter/js/jquery.gritter.js"></script>

<script type="text/javascript" src="__ROOT__/public/assets/plugins/bootstrap-sweetalert/sweetalert.min.js"></script>
<script type="text/javascript" src="__ROOT__/public/assets/plugins/drag-arrange.min.js"></script>

<!-- ================== END PAGE LEVEL JS ================== -->

<script type="text/javascript" src="__ROOT__/public/assets/plugins/dropzone/dropzone.js"></script>
<script type="text/javascript" src="__ROOT__/public/assets/plugins/moment/moment.min.js"></script>
<script type="text/javascript" src="__ROOT__/public/assets/plugins/bootstrap-eonasdan-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>

</body>
</html>
<script type="text/javascript">

    checkAuditStatus();

    function getQrcode() {
        $.ajax({
            url:'__ROOT__/admincp/setting/getQrCode',
            type:'POST',
            data: {},  
            success: function(msg) {
                if(!msg['error']) {
                    $('#qrCodeImage').html('<img src="'+msg['url']+'" width="150" height="150"/>');
                } else {
                   
                }
            }
        });
    };

    function submitAudit() {
        var category = $("input[name='category']:checked").val();
        var tag = $("#tag").val();

        $.ajax({
            url:'__ROOT__/admincp/setting/submitAudit',
            type:'POST',
            data: {
                category: category,
                tag: tag
            },  
            success: function(msg) {
                if(!msg['error']) {
                    swal("提交审核成功",'',"success");
                    window.location.href='__ROOT__/admincp/setting/index/act/version';
                } else {
                    swal(msg['errmsg'], "", "warning");
                }
            }
        });
    };

    function checkAuditStatus() {
        $.ajax({
            url:'__ROOT__/admincp/setting/checkAuditStatus',
            type:'POST',
            data: {},  
            success: function(msg) {
                var buttonTxt = '';
                if(msg['errcode'] == 0) {
                    if(msg['status'] == 1) {
                        buttonTxt = '审核失败';
                    } else if(msg['status'] == 2) {
                        buttonTxt = '正在审核中';
                    } else {
                        buttonTxt = '审核通过';
                    }
                    $("#auditButton").text(buttonTxt);
                } else {

                }
            }
        });
    };

    function uploadVersion() {
        swal({ 
        title: "确定上传体验版？", 
        type: "warning",
        showCancelButton: true, 
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "确定", 
        cancelButtonText: "取消",
        closeOnConfirm: false, 
        closeOnCancel: false  
      },
      function(isConfirm){ 
        if (isConfirm) { 
            $.ajax({
                url:'__ROOT__/admincp/setting/uploadVersion',
                type:'POST',
                data: {},  
                success: function(msg) {
                    if(!msg['errcode']) {
                        swal("上传成功",'',"success");
                        window.location.href='__ROOT__/admincp/setting/index/act/version';
                    } else {
                        swal(msg['errmsg'],'',"error"); 
                    }
                }
            });
        } else { 
          swal("已取消上传",'',"error"); 
        } 
      });
    };

    $("#newCoverShow").hide();
    function addSwiper() {
        var newlink = $("#newlink").val();
        var newcover = $("#newcover").val();

        /*if(!newlink) {
            $('#noneLinkTips').show();
            return;
        }*/

        $.ajax({
            url:'__ROOT__/admincp/Page/addSwiper',
            type:'POST',
            data: {
                cover: newcover,
                link: newlink
            },  
            success: function(msg) {
                $('#addSwiper').modal('hide');
                var msg = JSON.parse(msg);
                if(!msg['error']) {
                    $('#noneSwiper').hide();
                    var addDiv = $("<tr><td style='width:10%'><img src='" + newcover + "' style='width: 315px;height: 157px;' /></td><td style='width:30%'>" + newlink + "</td><td><div class='btn btn-primary btn-sm onclick='editSwiper("+msg['id']+") data-toggle='modal' data-target='#editSwiper'>编辑</div> <div class='btn btn-warning btn-sm' onclick='hiddenSwiper("+msg['id']+")' data-toggle='modal' data-target='#hiddenSwiper'>删除</div></td></tr>");
                    addDiv.appendTo("#swiperList");
                } else {
                    swal(msg['msg'], "", "warning");
                }
            }
        });
    };

    function settingSwiper() {
        var swiper = {}

        var isAuto = $("#swiperIsAuto").val();
        var isShowDot = $("#swiperIsShowDot").val();
        var interval = $("#swiperInterval").val();

        swiper = {
            'isAuto':isAuto,
            'isShowDot':isShowDot,
            'interval':interval
        };

        $.ajax({
            url:'__ROOT__/admincp/Page/setting',
            type:'POST',
            data: {
                act: 'swiper',
                swiper: swiper
            },  
            success: function(msg) {
                if(!msg['error']) {
                    swal("设置提交成功",'',"success"); 
                } else {
                    swal(msg['msg'], "", "warning");
                }
            }
        });
    };

    function editSwiper(id) {
        $.ajax({
            url:'__ROOT__/admincp/Page/swiperDetail',
            type:'POST',
            data: {
                id: id,
            },  
            success: function(msg) {
                if(!msg['error']) {
                    var msg = JSON.parse(msg);
                    $("#swiperId").attr("value",id);
                    $("#editlink").attr("value",msg['link']);
                    $("#editcover").attr("value",msg['cover']);
                    $("#editCoverShow").attr("src",msg['cover']);
                } else {
                    swal(msg['error'], "", "warning");
                }
            }
        });
    };

    function hiddenSwiper(id) {
        swal({ 
            title: "确定删除该数据？", 
            text: "你将无法恢复该数据！", 
            type: "warning",
            showCancelButton: true, 
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "确定", 
            cancelButtonText: "取消",
            closeOnConfirm: false, 
            closeOnCancel: false  
        },
        function(isConfirm){ 
            if (isConfirm) { 
              $.ajax({
                url:'__ROOT__/admincp/Page/hiddenSwiper',
                type:'POST',
                data: {
                    id: id,
                },  
                success: function(msg) {
                    if(!msg['error']) {
                        $('#swiper' + id).hide();
                        swal("数据已删除",'',"success"); 
                    } else {
                        swal(msg['error'], "", "warning");
                    }
                }
              });
            } else { 
              swal("已取消删除",'',"error"); 
            } 
        });
    };

    function editPostSwiper() {
        var id = $("#swiperId").val();
        var editlink = $("#editlink").val();
        var editcover = $("#editcover").val();

        $.ajax({
            url:'__ROOT__/admincp/Page/editSwiper',
            type:'POST',
            data: {
                id: id,
                cover: editcover,
                link: editlink
            },  
            success: function(msg) {
                if(!msg) {
                    $('#editSwiper').modal('hide');
                    $("#cover" + id).attr("src",editcover);
                    $("#link" + id).text(editlink);
                } else {
                    swal(msg, "", "warning");
                }
            }
        });
    };

    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone("#myDropzone", {
        url: "__ROOT__/admincp/Ajax/upload",
        addRemoveLinks: true,
        method: 'post',
        filesizeBase: 1024,
        maxFiles:10,
        maxFilesize: 1,
        acceptedFiles: ".jpg,.gif,.png",
        dictMaxFilesExceeded: "一次最多只能上传10个文件！",
        dictInvalidFileType: "你不能上传该类型文件,文件类型只能是*.jpg,*.gif,*.png。",
        dictFileTooBig: '文件太大了，图片文件大小不能超过1MB',
        dictRemoveFile: '删除素材',
        previewsContainer: '#uploadPreview',
        sending: function(file, xhr, formData) {
            formData.append('fileInfo', file);
        },
        success: function (file, response, e) {
            $("#newcover").attr("value",response['url']);
            $("#newCoverShow").attr("src",response['url']);
            $("#newCoverShow").show();
            $("#uploadTips").hide();
        }
    });

    var editDropzone = new Dropzone("#editDropzone", {
        url: "__ROOT__/admincp/Ajax/upload",
        addRemoveLinks: true,
        method: 'post',
        filesizeBase: 1024,
        maxFiles:10,
        maxFilesize: 1,
        acceptedFiles: ".jpg,.gif,.png",
        dictMaxFilesExceeded: "一次最多只能上传10个文件！",
        dictInvalidFileType: "你不能上传该类型文件,文件类型只能是*.jpg,*.gif,*.png。",
        dictFileTooBig: '文件太大了，图片文件大小不能超过1MB',
        dictRemoveFile: '删除素材',
        previewsContainer: '#uploadPreview',
        sending: function(file, xhr, formData) {
            formData.append('fileInfo', file);
        },
        success: function (file, response, e) {
            $("#editCoverShow").attr("src",response['url']);
            $("#editcover").attr("value",response['url']);
        }
    });

</script>