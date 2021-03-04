<?php
header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
require_once "vendor/autoload.php";
use \Models\Users;
use \Models\SessionManager;
$session = new SessionManager();
$users = new Users();

require_once('inc/functions.inc.php');
require_once('inc/config.inc.php');
if(!$users->isLoggedIn()){ transfers_to('./login.html?url=' . $_SERVER['REQUEST_URI']); }
$user_default = $users->get_one_default();
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Hệ thống quản lý Hồ sơ minh chứng Trường Đại học An Giang</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="Hệ thống quản lý Hồ sơ minh chứng Trường Đại học An Giang" />
    <meta content="Hệ thống quản lý Hồ sơ minh chứng Trường Đại học An Giang" />
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<!--<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<link href="assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="assets/css/animate.min.css" rel="stylesheet" />
	<link href="assets/css/style.min.css" rel="stylesheet" />
	<link href="assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="assets/css/theme/blue.css" rel="stylesheet" id="theme" />
	<!-- ================== END BASE CSS STYLE ================== -->
    <link href="assets/plugins/ionicons/css/ionicons.min.css" rel="stylesheet" />
    <link rel="author" href="assets/css/custom.css">
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	<!-- begin #page-container -->
	<div id="page-container" class="page-container fade page-without-sidebar page-header-fixed page-with-top-menu">
		<!-- begin #header -->
		<div id="header" class="header navbar navbar-default navbar-fixed-top">
			<!-- begin container-fluid -->
			<div class="container-fluid">
				<!-- begin mobile sidebar expand / collapse button -->
				<div class="navbar-header">
					<a href="index.html" class="navbar-brand">
					<i class="fa fa-book text-primary"></i>&nbsp;QUẢN LÝ HỒ SƠ MINH CHỨNG
					</a>
					<button type="button" class="navbar-toggle" data-click="top-menu-toggled">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<!-- end mobile sidebar expand / collapse button -->
				<!-- begin header navigation right -->
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown navbar-user">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-user"></i>
							<span class="hidden-xs"><?php echo $user_default['person']; ?></span> <b class="caret"></b>
						</a>
						<ul class="dropdown-menu animated fadeInLeft">
                            <?php if($users->is_admin()) : ?>
                            	<li class="arrow"></li>
                            	<li><a href="users.html"><span class="fa fa-users"></span> Danh sách tài khoản</a></li>
                            <?php endif; ?>
                            <li class="arrow"></li>
                            <?php if($users->get_username() != 'dhag'): ?>
							 <li><a href="change_password.html"><span class="fa fa-refresh"></span> Thay đổi mật khẩu</a></li>
							 <li class="divider"></li>
                            <?php endif; ?>
							<li><a href="logout.html"><span class="fa fa-sign-out"></span> Đăng xuất</a></li>
						</ul>
					</li>
				</ul>
				<!-- end header navigation right -->
			</div>
			<!-- end container-fluid -->
		</div>
		<!-- end #header -->
		<!-- begin #top-menu -->
		<div id="top-menu" class="top-menu">
            <!-- begin top-menu nav -->
            <ul class="nav">
                <li>
                    <a href="index.html">
                        <i class="fa fa-home"></i>
                        <span>TRANG CHỦ</span>
                    </a>
                </li>
                <?php if($users->is_admin()) : ?>
            	<li class="has-sub">
	                <a href="#">
	                	<b class="caret pull-right"></b>
	                    <i class="fa fa-list"></i>
	                    <span>DANH MỤC</span>
	                </a>
	                <ul class="sub-menu">
                        <li class="divider"></li>
                        <li><a href="tieuchuan.html">Tiêu chuẩn - Tiêu chí</a></li>
	                 	<li class="divider"></li>
                        <li><a href="loaivanban.html">Loại văn bản</a></li>
                        <li class="divider"></li>
                    </ul>
                </li>
            	<?php endif; ?>
            	<?php if($users->is_admin() || $users->is_manager()) : ?>
                <li>
                    <a href="minhchung.html">
                        <i class="fa fa-sun-o"></i>
                        <span>MINH CHỨNG</span>
                    </a>
                </li>
            	<?php endif; ?>
                <li class="has-sub">
                    <a href="#">
                    	<b class="caret pull-right"></b>
                        <i class="fa fa-bar-chart-o"></i>
                        <span>THỐNG KÊ MINH CHỨNG</span>
                    </a>
                    <ul class="sub-menu">
                    	<li class="divider"></li>
                        <li><a href="thongkeminhchung.html">Thống kê minh chứng</a></li>
                        <li class="divider"></li>
                        <li><a href="thongketheotieuchi.html">Theo Tiêu chuẩn - Tiêu chí</a></li>
                        <li class="divider"></li>
                        <li><a href="thongkeminhchungchuaco.html">Minh chứng chưa có</a></li>
                        <li class="divider"></li>
                    </ul>
                </li>
                <!--<li class="has-sub">
                    <a href="#">
                      <b class="caret pull-right"></b>
                        <i class="fa fa-briefcase"></i>
                        <span>MINH CHỨNG BỔ SUNG</span>
                    </a>
                    <ul class="sub-menu">
                      <li class="divider"></li>
                        <li><a href="bosungphuluc_a.html">Bổ sung theo phu lục A</a></li>
                        <li class="divider"></li>
                        <li><a href="bosungphuluc_c.html">Bổ sung theo phu lục C</a></li>
                        <li class="divider"></li>
                        <li><a href="minhchungsau_15062017.html">Minh chứng sau ngày 15/06</a></li>
                        <li class="divider"></li>
                        <li><a href="minhchung_csdl.html">Minh chứng CSDL</a></li>
                        <li class="divider"></li>
                    </ul>
                </li>-->
                <li>
                    <a href="timkiem.html">
                        <i class="fa fa-search"></i>
                        <span>TÌM KIẾM</span>
                    </a>
                </li>
                <li class="menu-control menu-control-right">
                    <a href="#" data-click="next-menu"><i class="fa fa-angle-right"></i></a>
                </li>
            </ul>
            <!-- end top-menu nav -->
		</div>
		<!-- end #top-menu -->
		<!-- begin #content -->
		<div id="content" class="content">

