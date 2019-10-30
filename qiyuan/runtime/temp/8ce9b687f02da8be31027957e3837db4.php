<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:82:"D:\phpstudy\PHPTutorial\WWW\information/application/admincp\view\plugin\index.html";i:1545193073;s:83:"D:\phpstudy\PHPTutorial\WWW\information/application/admincp\view\common\header.html";i:1545193073;s:81:"D:\phpstudy\PHPTutorial\WWW\information/application/admincp\view\common\menu.html";i:1545193073;s:83:"D:\phpstudy\PHPTutorial\WWW\information/application/admincp\view\common\footer.html";i:1545193073;}*/ ?>
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
    	<li class="breadcrumb-item active">营销组件</li>
  	</ol>
	<h1 class="page-header">营销组件</h1>
	<h4 style="margin-bottom: 15px;">商品营销</h4>
	<div class="row" style="margin-bottom: 30px;">
		<div class="col-lg-3" style="cursor:pointer" onclick="javascript:window.location.href='__ROOT__/admincp/group'">
		<!-- begin widget-card -->
			<div class="note note-primary">
				<div class="note-icon"><i class="fas fa-puzzle-piece"></i></div>
				<div class="note-content">
					<h4><b>拼团</b></h4>
			   		<p>老带新口碑式强营销手段</p>
			  	</div>
			</div>
		<!-- end widget-card -->
		</div>
		<div class="col-lg-3" style="cursor:pointer" onclick="javascript:window.location.href='__ROOT__/admincp/lottery'">
		<!-- begin widget-card -->
			<div class="note note-primary">
				<div class="note-icon"><i class="fas fa-gift"></i></div>
				<div class="note-content">
					<h4><b>抽奖</b></h4>
			   		<p>发礼品、发福利、用户开心传播更给力</p>
			  	</div>
			</div>
		<!-- end widget-card -->
		</div>
	</div>
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