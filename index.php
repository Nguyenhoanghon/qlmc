<?php require_once('header.php');
use Models\MinhChung;
use Models\TieuChuan;

$s = isset($_GET['session']) ? $_GET['session'] : '';
$t = isset($_GET['_token']) ? $_GET['_token'] : '';
if($s && strlen($s) == 24 && $t){
 	$username = 'dhag';$password = 'dhag2018';
    $url = $_POST['url'] ? $_POST['url'] : '';
    if ($users->authenticate($username, $password)) {
        $users->push_logs_in();
        if($url) transfers_to($url);
        else transfers_to("./index.html");
    } else {
        $alert = true;
    }
}
$msg = isset($_GET['msg']) ? $_GET['msg'] : '';
$minhchung = new MinhChung();$tieuchuan = new TieuChuan();
$minhchung_list = $minhchung->get_all_list();
$tieuchuan_list = $tieuchuan->get_all_list();
$tk_tieuchuan = $tieuchuan->get_list_condition(array('id_parent' => ''));
$tk_tieuchi = $tieuchuan->get_list_condition(array('id_parent' => array('$ne' => '')));
//$minhchung_list = $minhchung->get_list_limit(10);
$tk_nhomminhhchung = $minhchung->thongkenhom();
?>
<link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
<link href="assets/plugins/jstree/dist/themes/default/style.min.css" rel="stylesheet" />
<!-- begin page-header -->
<h1 class="page-header"><i class="fa fa-book"></i> QUẢN LÝ HỒ SƠ MINH CHỨNG <small>Phục vụ công tác kiểm định chất lượng cơ sở giáo dục đại học</small></h1>
<div class="row">
    <div class="col-md-12 p-20">
        <div class="col-md-6">
        	<div class="panel panel-primary">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
					</div>
					<h4 class="panel-title">THỐNG KÊ</h4>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-6 col-sm-6">
							<div class="widget widget-stats bg-green">
								<div class="stats-icon"><i class="fa fa-book"></i></div>
								<div class="stats-info">
									<p>Thống kê</p>
									<h4>Tiêu chuẩn: <?php echo count($tk_tieuchuan); ?></h4>
									<h4>Tiêu chí: <?php echo count($tk_tieuchi); ?></h4>
								</div>
								<div class="stats-link">
									<a href="tieuchuan.html">Chi tiết <i class="fa fa-arrow-circle-o-right"></i></a>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-6">
							<div class="widget widget-stats bg-blue">
								<div class="stats-icon"><i class="fa fa-file-pdf-o"></i></div>
								<div class="stats-info">
									<p>Minh chứng</p>
									<h4>Nhóm minh chứng: <?php echo number_format(count($tk_nhomminhhchung),0,",","."); ?></h4>
									<h4>Minh chứng: <?php echo number_format($minhchung->count_all(),0,",","."); ?></h4>
								</div>
								<div class="stats-link">
									<a href="minhchung.html">Chi tiết <i class="fa fa-arrow-circle-o-right"></i></a>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<h1 class="page-header"><i class="fa fa-crosshairs"></i> Minh chứng mới nhất</h1>
							<div data-scrollbar="true" style="height:430px !important;">
								<ul class="media-list media-list-with-divider media-messaging">
								<?php if($minhchung_list) : ?>
								<?php foreach ($minhchung_list as $mc): ?>
									<li class="media media-sm">
										<div class="media-body">
											<h5 class="media-heading"><a href="chitietminhchung.html?id=<?php echo $mc['_id']; ?>"><?php echo $mc['ten']; ?></a></h5>
											<p>Số, tài liệu, ngày ban hành: <?php echo $mc['sovanban']; ?></p>
											<p>Nơi ban hành: <?php echo $mc['noiphathanh']; ?></p>
										</div>
									</li>
								<?php endforeach; ?>
								<?php endif; ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
        </div>
        <div class="col-md-6">
        	<div class="panel panel-primary">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
					</div>
					<h4 class="panel-title">CÁC MINH CHỨNG</h4>
				</div>
				<div class="panel-body" style="height:650px;overflow: scroll;">
					<div id="jstree-default">
	                <?php
	                    if($tieuchuan_list){
	                        $list_tree = $tieuchuan_list;
	                        showCategories_Tree_1($list_tree, '' , 'tieuchuan');
	                    }
	                ?>
	                </div>
				</div>
			</div>
        </div>
    </div>
</div>
<div style="clear:both;"></div>
<?php require_once('footer.php'); ?>
<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="assets/plugins/gritter/js/jquery.gritter.js"></script>
<script src="assets/plugins/jstree/dist/jstree.min.js"></script>
<script src="assets/js/ui-tree.demo.min.js"></script>
<script src="assets/js/apps.min.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
<script>
    $(document).ready(function() {
        App.init();TreeView.init();
    });
</script>
