<?php
require_once('header.php');
use Models\MinhChung;
use Models\TieuChuan;
$msg = isset($_GET['msg']) ? $_GET['msg'] : '';
$minhchung = new MinhChung();$tieuchuan = new TieuChuan();
$minhchung_list = $minhchung->get_all_list();
$tieuchuan_list = $tieuchuan->get_all_list();
$tk_tieuchuan = $tieuchuan->get_list_condition(array('id_parent' => ''));
$tk_tieuchi = $tieuchuan->get_list_condition(array('id_parent' => array('$ne' => '')));
$tk_nhomminhhchung = $minhchung->thongkenhom();
$minhchung_list = $minhchung->get_all_list();
$sominhchungcannhap = $minhchung->get_list_condition(array('maminhchungtrung' => ''))->toArray();
$c = 0;
if($sominhchungcannhap){
    foreach($sominhchungcannhap as $mc){
        if(file_exists('uploads/' .$mc['dinhkem'][0]['aliasname'])){
            $c++;
        }
    }
}

/*$ktr = $minhchung->get_list_condition(array('maminhchungtrung' => array('$ne' => '')));
if($ktr){
    foreach ($ktr as $k) {
        if(file_exists('uploads/' . $k['maminhchung'].'.pdf')){
            echo $k['maminhchung'].'.pdf' . '<br />';
        }
    }
}*/
//$arr_minhchungtrung = array();
/*if($minhchung_list){
    foreach ($minhchung_list as $mc) {
        if(file_exists('uploads/' .$mc['dinhkem'][0]['aliasname']) || file_exists('uploads/' .$mc['maminhchungtrung'].'.pdf')){
            $count_file++;
        } else {
            echo $mc['maminhchung'].'.pdf-----'.$mc['maminhchungtrung'].'.pdf<br />';
        }
    }
}*/
/*$minhchungtrungcon = $minhchung->get_list_condition(
        array('_id' => array('$in' => $arr_minhchungtrung),
        'maminhchungtrung' => array('$ne' => '')))->count();
*/
?>
<link href="assets/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css" rel="stylesheet" />
<link href="assets/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet" />
<link href="assets/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" />
<link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
<link href="assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
<link href="assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
<link href="assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
<link href="assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />
<link href="assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css" rel="stylesheet" />
<h1 class="page-header"><i class="fa fa-book"></i> THỐNG KÊ MINH CHỨNG</h1>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-body">
            	<table id="data-table" class="table table-striped table-bordered table-hovered" style="font-size:18px;">
            	<tbody>
            		<tr>
            			<td>Tiêu chuẩn</td>
            			<td><?php echo count($tk_tieuchuan); ?></td>
            		</tr>
            		<tr>
            			<td>Tiêu chí</td>
            			<td><?php echo count($tk_tieuchi); ?></td>
            		</tr>
            		<tr>
            			<td>Nhóm minh chứng</td>
            			<td><?php echo format_number(count($tk_nhomminhhchung)); ?></td>
            		</tr>
                    <tr>
                        <td>Tổng số minh chứng con.</td>
                        <td><?php echo format_number($minhchung->count_all()); ?></td>
                    </tr>
                    <tr>
                        <td>Tổng số minh chứng trùng.</td>
                        <td><?php echo format_number($minhchung->count_all() - count($sominhchungcannhap)); ?></td>
                    </tr>
                    <tr>
                        <td>Số minh chứng CẦN nhập (files)</td>
                        <td><?php echo format_number(count($sominhchungcannhap)); ?></td>
                    </tr>
                    <tr>
                        <td>Số minh chứng ĐÃ nhập (files)</td>
                        <td><?php echo format_number($c); ?></td>
                    </tr>
                    <tr>
                        <td>Còn lại (files)</td>
                        <td><?php echo format_number(count($sominhchungcannhap) - $c); ?></td>
                    </tr>
                    <tr>
                        <td>Tỷ lệ nhập liệu Đạt</td>
                        <td><?php echo format_decimal(($c/count($sominhchungcannhap))*100, 2); ?>%</td>
                    </tr>
            	</tbody>
            	</table>
            </div>
        </div>
    </div>
</div>
<div style="clear:both;"></div>
<?php require_once('footer.php'); ?>
<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="assets/plugins/gritter/js/jquery.gritter.js"></script>
<script src="assets/js/apps.min.js"></script>
<script>
    $(document).ready(function() {
        App.init();
    });
</script>
