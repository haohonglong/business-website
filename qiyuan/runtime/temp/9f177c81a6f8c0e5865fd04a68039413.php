<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:80:"D:\phpstudy\PHPTutorial\WWW\information/application/admincp\view\index\user.html";i:1572248157;s:83:"D:\phpstudy\PHPTutorial\WWW\information/application/admincp\view\common\header.html";i:1572247769;s:81:"D:\phpstudy\PHPTutorial\WWW\information/application/admincp\view\common\menu.html";i:1572248120;s:83:"D:\phpstudy\PHPTutorial\WWW\information/application/admincp\view\common\footer.html";i:1545193073;}*/ ?>
<html lang="en">
<!--<![endif]-->
<head>
    <meta charset="utf-8" />
    <title>邀请函管理后台<?php echo !empty($title)?'-'.$title : ''; ?></title>
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
        邀请函管理后台<?php echo !empty($appInfo['name'])?'-'.$appInfo['name'] : ''; ?>
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
        <li class="<?php echo \think\Request::instance()->controller()=='Index'?'active' : 'has-sub'; ?>">
          <a href="__ROOT__/admincp/user">
            <i class="fas fa-user fa-fw"></i>
            <span>人员管理</span>
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
    	<li class="breadcrumb-item active">用户管理</li>
  	</ol>
	<h1 class="page-header">用户管理</h1>

	<div class="panel panel-inverse">
		<div class="panel-heading">
			<h4 class="panel-title">用户列表</h4>
		</div>
		<div class="panel-body">
			<table id="data-table-default" class="table table-striped table-bordered">
				<div class="row">
					<form action="__ROOT__/admincp/user">
						<div class="col-sm-12">
							<div id="data-table-default_filter" class="dataTables_filter">
								<label>
									<input type="search" name="keyword" class="form-control input-sm" placeholder="请输入微信昵称" aria-controls="data-table-default" value="<?php echo $keyword; ?>">
								</label>
								<button class="btn btn-primary" style="margin-bottom: 3px;">搜索</button>
								<?php if($keyword): ?>
									<div class="btn btn-success" style="margin-bottom: 3px;" onclick="javascript:window.location.href='__ROOT__/admincp/user/index/keyword/'">清空搜索</div>
								<?php endif; ?>

								<a href="__ROOT__/admincp/Excel/outUser"><span class="btn btn-indigo" style="margin-bottom: 3px;" >导出用户信息</span><a/>
							</div>
						</div>
					</form>
				</div>	
				<thead>
					<tr>
						<th style="text-align: center;">头像</th>
						<th class="text-nowrap">微信昵称</th>
						<th class="text-nowrap">用户组</th>
						<th class="text-nowrap">性别</th>
						<th class="text-nowrap">所在地区</th>
						<!-- <th class="text-nowrap">积分</th> -->
						<th class="text-nowrap">注册时间</th>
						<!-- <th class="text-nowrap">操作</th> -->
					</tr>
				</thead>
				<tbody>
					<?php if(count($userList) > 0): foreach($userList as $user): ?>
							<tr class="odd gradeX">
								<td width="1%" class="with-img">
									<img src="<?php echo $user['avatar']; ?>" class="img-rounded height-40" style="margin:3px;border-radius: 50%" />
								</td>
								<td><?php echo $user['nickname']; ?></td>
								<td><?php echo !empty($user['admingroup']) && $user['admingroup']==1?'管理员' : '普通会员'; ?></td>
								<td><?php if($user['gender'] == 1): ?>男<?php else: ?>女<?php endif; ?></td>
								<td><?php echo $user['province']; ?> / <?php echo $user['city']; ?></td>
								<!-- <td>0</td> -->
								<td><?php echo $user['create_time']; ?></td>
								<!-- <td>
									<a href="__ROOT__/admincp/usermanage/edit?id=<?php echo $user['id']; ?>" class="btn btn-primary btn-sm">详情</a>
									
									 <a href="#userPermission" class="btn btn-info btn-sm" data-toggle="modal" onclick="getPermission(<?php echo $user['id']; ?>)">设置权限</a>
									<a href="" class="btn btn-warning btn-sm">发送通知</a>
								</td> -->
							</tr>
						<?php endforeach; else: ?>
	                  <tr>
	                    <td colspan="7" style="text-align: center;padding:20px">暂无用户</td>
	                  </tr>
	                <?php endif; ?>
				</tbody>
			</table>
			<div style="float: right;"><?php echo $page; ?></div>
		</div>
	</div>
</div>

<div class="modal fade" id="userPermission" style="display: none;" aria-hidden="true">
	<div class="modal-dialog" style="top:200px;">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">
					设置<span id="username"></span>用户权限
				</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<div class="modal-body">
				<input type="hidden" name="uid" id="userId">
                <div class="form-group row m-b-10">
                    <div class="col-md-12">
                    	<?php foreach($modulePermission as $module): ?>
	                        <div class="checkbox checkbox-css checkbox-inline m-l-0 m-r-5">
								<input type="checkbox" value="<?php echo $module['controller']; ?>" id="<?php echo $module['controller']; ?>" name="permission"/>
								<label for="<?php echo $module['controller']; ?>"><?php echo $module['name']; ?></label>
	                        </div>
                       	<?php endforeach; ?>
                    </div>
                </div>
			</div>
			<div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="postPermission()">提交</button>
			</div>
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
	function getPermission(id) {
		$("#userId").attr("value", id);

        $.ajax({
            url:'__ROOT__/admincp/User/getPermission',
            type:'POST',
            data: {
                id: id,
            },  
            success: function(msg) {
                if(!msg['error']) {
                    
                } else {
                    swal(msg['error'], "", "warning");
                }
            }
        });
    };

	function postPermission() {
        var id = $("#userId").val();
        var id = $("#permission").val();
        
        $.ajax({
            url:'__ROOT__/admincp/User/editPermission',
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
</script>