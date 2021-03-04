<?php require_once('header.php');
$msg = isset($_GET['msg']) ? $_GET['msg'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : '';
$minhchung = new MinhChung();$tieuchuan = new TieuChuan();$loaivanban = new LoaiVanBan();
$minhchung->id = $id; $mc = $minhchung->get_one();
$tieuchuan->id = $mc['id_tieuchuan']; $tc = $tieuchuan->get_one();
?>
<link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
<!-- begin page-header -->
<div class="row">
    <div class="col-md-12 p-20">
        <div class="col-md-12">
        	<div class="panel panel-primary">
				<div class="panel-body">
					<h1 class="page-header"><i class="fa fa-book"></i> CHI TIẾT MINH CHỨNG</h1>
					<div class="form-group row">
			            <label class="col-md-3 control-label">Tên minh chứng</label>
			            <div class="col-md-9 p-t-5"><?php echo $mc['ten'];?></div>
			        </div>
			        <div class="form-group row">
			            <label class="col-md-3 control-label">Tiêu chí</label>
			            <div class="col-md-9 p-t-5"><?php echo $tc['ten'];?></div>
			       	</div>
			       	<div class="form-group row">
				        <label class="col-md-3 control-label">Loại văn bản</label>
				        <div class="col-md-9 p-t-5"><?php echo $loaivanban->get_vanban($mc['id_loaivanban']); ?></div>
			    	</div>
			    	<div class="form-group row">
			            <label class="col-md-3 control-label">Số văn bản</label>
			            <div class="col-md-9 p-t-5"><?php echo $mc['sovanban'];?></div>
			        </div>
			        <div class="form-group row">
			            <label class="col-md-3 control-label">Số văn bản đến</label>
			            <div class="col-md-9 p-t-5"><?php echo $mc['sovanbanden'];?></div>
			        </div>
			        <div class="form-group row">
			            <label class="col-md-3 control-label">Ký hiệu</label>
			            <div class="col-md-9 p-t-5"><?php echo $mc['kyhieu'];?></div>
			        </div>
			        <div class="form-group row">
			            <label class="col-md-3 control-label">Nơi phát hành</label>
			            <div class="col-md-9 p-t-5"><?php echo $mc['noiphathanh'];?></div>
			        </div>
			        <div class="form-group row">
			            <label class="col-md-3 control-label">Người ký</label>
			            <div class="col-md-9 p-t-5"><?php echo $mc['nguoiky'];?></div>
			        </div>
			        <div class="form-group row">
			            <label class="col-md-3 control-label">Ngày ký</label>
			            <div class="col-md-9 p-t-5"><?php echo $mc['ngayky'] ? date("d/m/Y", $mc['ngayky']->sec) : '';?></div>
			        </div>
			        <div class="form-group row">
			            <label class="col-md-3 control-label">Nội dung</label>
			            <div class="col-md-9 p-t-5"><?php echo $mc['noidung'];?></div>
			        </div>
			        <div class="form-group row">
				        <label class="col-md-3 control-label text-left">Đính kèm:</label>
				        <div class="col-md-9 p-t-5">
				        <?php
				        if($mc['dinhkem']){
				        	echo '<ul style="padding-left:15px;">';
				        	foreach ($mc['dinhkem'] as $key => $value) {
				        		echo '<li><a href="'.$uploads_folder . $value['aliasname'].'" target="_blank">'.$value['filename'].'</a></li>';
				        	}
				        	echo '</ul>';
				        }
				        ?>
				        </div>
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
<script src="assets/js/apps.min.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
<script>
    $(document).ready(function() {
        App.init();
    });
</script>