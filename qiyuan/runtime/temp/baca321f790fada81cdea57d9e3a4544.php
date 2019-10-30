<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:84:"D:\phpstudy\PHPTutorial\WWW\information/application/admincp\view\resource\index.html";i:1545193073;s:83:"D:\phpstudy\PHPTutorial\WWW\information/application/admincp\view\common\header.html";i:1545193073;s:81:"D:\phpstudy\PHPTutorial\WWW\information/application/admincp\view\common\menu.html";i:1572247718;s:83:"D:\phpstudy\PHPTutorial\WWW\information/application/admincp\view\common\footer.html";i:1545193073;}*/ ?>
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
      <!-- <ul class="nav">
        <li class="nav-header"></li>
        <li class="<?php echo \think\Request::instance()->controller()=='Index'?'active' : 'has-sub'; ?>">
          <a href="__ROOT__/admincp/index">
            <i class="fas fa-home fa-fw"></i>
            <span>后台首页</span>
          </a>
        </li>
      </ul> -->
      <ul class="nav">
        <li class="<?php echo \think\Request::instance()->controller()=='User'?'active' : 'has-sub'; ?>">
          <a href="__ROOT__/admincp/user">
            <i class="fas fa-user fa-fw"></i>
            <span>用户管理</span>
          </a>
        </li>
      </ul>
    
      <!-- <ul class="nav">
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
      </ul> -->
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
      <!-- <ul class="nav">
        <li class="<?php echo \think\Request::instance()->controller()=='Setting'?'active' : 'has-sub'; ?>">
          <a href="__ROOT__/admincp/setting">
              <i class="fas fa-cog fa-fw"></i>
              <span>系统设置</span>
          </a>
        </li>
      </ul> -->
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
    	<li class="breadcrumb-item active">文章管理</li>
  	</ol>
	<h1 class="page-header">文章管理</h1>
	<div class="row">
    <!-- begin col-3 -->
	    <!-- <div class="col-lg-3 col-md-6">
	      <div class="widget widget-stats bg-<?php echo !empty($sort) && $sort==1?'indigo' : 'blue-grey'; ?>" style="cursor:pointer" onclick="javascript:window.location.href='__ROOT__/admincp/resource/index/sort/1'">
	        <div class="stats-icon stats-icon-lg"><i class="fa fa-image fa-fw"></i></div>
	        <div class="stats-content">
	          <div class="stats-title" style="font-size: 18px">图文内容</div>
	            <div class="stats-number"><?php echo $totalNum['totalArticle']; ?> 条</div>
	            <div class="stats-desc">
	            	<a href="__ROOT__/admincp/resource/add?sort=1" class="btn btn-primary btn-sm" style="margin-right: 5px">添加内容</a>
	            	<a href="__ROOT__/admincp/resource/category?sort=1" class="btn btn-warning btn-sm">设置分类</a>
	            </div>
	          </div>
	      </div>
	    </div> -->
	    <!-- end col-3 -->
	    <!-- begin col-3 -->
	    <!-- <div class="col-lg-3 col-md-6">
	      <div class="widget widget-stats bg-<?php echo !empty($sort) && $sort==2?'indigo' : 'blue-grey'; ?>" style="cursor:pointer" onclick="javascript:window.location.href='__ROOT__/admincp/resource/index/sort/2'">
	        <div class="stats-icon stats-icon-lg"><i class="fa fa-film fa-fw"></i></div>
	        <div class="stats-content">
	          <div class="stats-title" style="font-size: 18px">视频内容</div>
	          <div class="stats-number"><?php echo $totalNum['totalVideo']; ?> 条</div>
	          <div class="stats-desc">
	            <a href="__ROOT__/admincp/resource/add?sort=2" class="btn btn-primary btn-sm" style="margin-right: 5px">添加内容</a>
	            <a href="__ROOT__/admincp/resource/category?sort=2" class="btn btn-warning btn-sm">设置分类</a>
	          </div>
	        </div>
	      </div>
	    </div> -->
	    <!-- end col-3 -->
  	</div>
  	<div class="panel panel-inverse" data-sortable-id="table-basic-2">
        <!-- begin panel-heading -->
        <div class="panel-heading">
          <h4 class="panel-title"><?php echo $sortName; ?>内容列表</h4>
        </div>
        <!-- end panel-heading -->
        <!-- begin panel-body -->
        <div class="panel-body" style="padding-bottom: 3px">
        	<div class="row">
        		<!-- <form action="__ROOT__/admincp/resmanage">
		            <div class="col-sm-12">
		              <div id="data-table-default_filter" class="dataTables_filter">
		                <label>
		                  <input type="search" name="keyword" class="form-control input-sm" placeholder="输入资讯标题" aria-controls="data-table-default">
		                </label>
		                <button class="btn btn-success" style="margin-bottom: 3px;">搜索</button>
		              </div>
		            </div>
	            </form> -->
			</div>	
          	<!-- begin table-responsive -->
        	<table id="data-table-default" class="table table-striped table-bordered">
              <thead>
                <tr>
                	<!-- <th>封面图</th> -->
                	<th>标题</th>
                	<!-- <th>分类</th>
                  <th>浏览数</th>
                	<th>点赞数</th> -->
                	<!-- <th>发布时间</th> -->
                	<th>操作</th>
                </tr>
              </thead>
              <tbody>
                <?php if(count($resourceList) > 0): foreach($resourceList as $resource): ?>
	                <tr id="resource<?php echo $resource['id']; ?>">
	                  <!-- <td><img src="<?php echo !empty($resource['cover'])?$resource['cover'] : '__ROOT__/public/image/none.jpg'; ?>" alt="" style="width: 128px;height: 72px" /></td> -->
	                  <td style="width:25%"><?php echo $resource['title']; ?></td>
	                  <!-- <td><?php echo $categoryList[$resource['categoryid']]; ?></td>
	                  <td><?php echo $resource['views']; ?></td>
	                  <td><?php echo $resource['likes']; ?></td>
	                  <td><?php echo $resource['create_time']; ?></td> -->
	                  <td>
	                    <a href="__ROOT__/admincp/resource/edit?id=<?php echo $resource['id']; ?>" class="btn btn-primary btn-sm">编辑</a>
	    				<!-- <div class="btn btn-info btn-sm" onclick="resourceTop(<?php echo $resource['id']; ?>, <?php echo $resource['istop']; ?>)" id="isTopButton<?php echo $resource['id']; ?>"><?php if($resource['istop'] == 0): ?>置顶<?php else: ?>解除置顶<?php endif; ?></div>
	    				<div class="btn btn-warning btn-sm" onclick="hiddenResource(<?php echo $resource['id']; ?>)">删除</div>
	                    <div class="btn btn-inverse btn-sm" onclick="viewLink(<?php echo $resource['id']; ?>)">链接</div> -->
	                  </td>
	                </tr>
	              <?php endforeach; else: ?>
	              <tr>
	                <td colspan="10" style="text-align: center;padding:20px">暂无数据</td>
	              </tr>
	            <?php endif; ?>
              </tbody>
            </table>
            <div style="float: right;"><?php echo $page; ?></div>
          	<!-- end table-responsive -->
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
<script type="text/javascript">
    function resourceTop(id, istop) {
        $.ajax({
            url:'__ROOT__/admincp/resource/resourceTop',
            type:'POST',
            data: {
                id: id,
                istop: istop
            },  
            success: function(msg) {
                var isTopText = istop == 1 ? '置顶' : '解除置顶'
                if(!msg['error']) {
                    $('#product' + id).hide();
                    $("#isTopButton" + id).text(isTopText);
                } else {
                    swal(msg['error'], "", "warning");
                }
            }
        });
    };
    function hiddenResource(id) {
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
            url:'__ROOT__/admincp/resource/hiddenResource',
            type:'POST',
            data: {
                id: id
            },  
            success: function(msg) {
                if(!msg['error']) {
                    $('#resource' + id).hide();
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

    function viewLink(id) {
        swal({
          title: "pages/index/detail?id=" + id, 
          text: '小程序地址',
          type: "warning", 
          closeOnConfirm: true, 
        });
    }
</script>