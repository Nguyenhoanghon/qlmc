<?php require_once('header.php');
$msg = isset($_GET['msg']) ? $_GET['msg'] : '';
$tieuchuan = new TieuChuan();$tieuchuan_list = $tieuchuan->get_all_list();
$keysearch = isset($_GET['keysearch']) ? $_GET['keysearch'] : '';
$minhchung = new MinhChung();$loaivanban = new LoaiVanBan();
if($keysearch){
	$query = array('$or' => array(
        array('kyhieu' => new MongoRegex('/'.$keysearch . '/i')),
        array('maminhchung' => new MongoRegex('/'.$keysearch . '/i')),
        array('ten' => new MongoRegex('/'.$keysearch . '/i')),
		array('noiphathanh' => new MongoRegex('/'.$keysearch . '/i')),
		array('sovanban' => new MongoRegex('/'.$keysearch . '/i')),
		array('sovanbanden' => new MongoRegex('/'.$keysearch . '/i')),
		array('nguoiky' => new MongoRegex('/'.$keysearch . '/i')),
		array('noidung' => new MongoRegex('/'.$keysearch . '/i')),
	));
	//$query = array('ten' => new MongoRegex('/'.$keysearch . '/i'));
	$minhchung_list = $minhchung->get_list_condition($query);
}

?>
<link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
<link href="assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
<link href="assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
<!-- begin page-header -->
<h1 class="page-header"><i class="fa fa-search"></i> TÌM KIẾM</h1>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
        	<div class="panel-body">
        	<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="GET" class="form-horizontal" name="timkiemform" id="timkiemform">
        		<div class="form-group">
        			<div class="col-md-10">
        				<input type="text" name="keysearch" id="keysearch" class="form-control" placeholder="Từ khoá tìm kiếm" value="<?php echo isset($keysearch) ? $keysearch : ''; ?>"/>
                    </div>
                    <div class="col-md-2 text-left">
                    	<button type="submit" name="submit" id="submit" class="btn btn-primary"><i class="fa fa-search"></i> Tìm kiếm</button>
                    </div>
        		</div>
        	</form>
        	</div>
        </div>
    </div>
</div>
<?php if(isset($minhchung_list) && $minhchung_list): ?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
        	<div class="panel-body">
        		<table id="data-table" class="table table-striped table-bordered table-hovered" style="font-size:12px;">
                    <thead>
                        <tr>
                            <th width="10" style="vertical-align: middle;">STT</th>
                            <th width="40" style="vertical-align: middle;">Ký hiệu</th>
                            <th style="text-align:center;vertical-align: middle;">Tên</th>
                            <!--<th>Ngày ký</th>
                            <th>Người ký</th>
                            <th>Ngày nhập</th>-->
                            <th style="text-align: center;vertical-align: middle;" >Số, tài liệu, ngày ban hành</th>
                            <th style="text-align: center;vertical-align: middle;">Nơi ban hành</th>
                            <!--<th>Loại văn bản</th>
                            <th>Người nhập</th>-->
                            <th class="text-center" width="60" style="vertical-align: middle;">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if($minhchung_list){
                        $i = 1;
                        foreach ($minhchung_list as $mc) {
                            //$tieuchuan->id = $mc['id_tieuchuan']; $tc = $tieuchuan->get_one();
                            //$vb = $loaivanban->get_vanban($mc['id_loaivanban']);
                            //$users->id = $mc['id_user']; $u = $users->get_one();
                            /*<td>'.($mc['ngayky'] ? date("d/m/Y", $mc['ngayky']->sec) : '').'</td>
                            <td>'.$mc['nguoiky'].'</td>
                            <td>'.date("d/m/Y", $mc['date_post']->sec).'</td>
                            <td>'.$vb.'</td>
                            <td>'.$u['person'].'</td>*/
                            if(!file_exists('uploads/' . $mc['dinhkem'][0]['aliasname'])){
                                $class = 'style="color:#ff0000;font-weight:bold;vertical-align: middle;"';
                            } else { $class='vertical-align: middle;';}
                            echo '<tr>
                                <td class="text-center" style="vertical-align: middle;">'.$i.'</td>
                                <td '.$class.' class="text-center">'.$mc['kyhieu'].'</td>
                                <td style="vertical-align: middle;">'.$mc['ten'].'</td>
                                <td style="vertical-align: middle;" class="text-center">'.$mc['sovanban'].'</td>
                                <td style="vertical-align: middle;" class="text-center">'.$mc['noiphathanh'].'</td>
                                <td class="text-center">
                                <a href="get.minhchung.html?id='.$mc['_id'].'&act=xem#modal-xemminhchung" class="xemminhchung" data-toggle="modal""><i class="fa fa-eye"></i></a>&nbsp;&nbsp;&nbsp;
                                <a href="uploads/'.$mc['dinhkem'][0]['aliasname'].'" target="_blank"><i class="fa fa-download"></i></a>
                                </td>
                            </tr>';$i++;
                        }
                    }
                    ?>
                    </tbody>
                </table>
        	</div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-xemminhchung">
<form action="post.minhchung.html" method="POST" class="form-horizontal" data-parsley-validate="true" name="minhchungform" id="minhchungform">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-info"></i> THÔNG TIN MINH CHỨNG</h4>
            </div>
            <div class="modal-body" id="thongtinminhchung">
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-sm btn-primary" data-dismiss="modal">Đóng</a>
            </div>
        </div>
    </div>
</form>
</div>
<?php endif;?>
<div style="clear:both;"></div>
<?php require_once('footer.php'); ?>
<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="assets/plugins/gritter/js/jquery.gritter.js"></script>
<script src="assets/plugins/DataTables/media/js/jquery.dataTables.js"></script>
<script src="assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js"></script>
<script src="assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/js/table-manage-default.demo.min.js"></script><!-- begin page-header -->
<script src="assets/js/apps.min.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
<script>
    $(document).ready(function() {
    	$(".xemminhchung").click(function(){
            var _link = $(this).attr("href");
            $.get(_link, function(data){
                $("#thongtinminhchung").html(data);
            });
        });
        App.init();TableManageDefault.init();
    });
</script>
