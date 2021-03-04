<?php
require_once('header_none.php');
use Models\DBConnect;
use Models\LoaiVanBan;
use Models\MinhChung;
use Models\TieuChuan;
$loaivanban = new LoaiVanBan();$minhchung = new MinhChung();
$tieuchuan = new TieuChuan();
$id = isset($_GET['id']) ? $_GET['id'] : '';
$act = isset($_GET['act']) ? $_GET['act'] : '';

if($act == 'edit' || $act == 'copy'){
	$minhchung->id = $id; $mc = $minhchung->get_one();
	$dinhkem = '';
	if($mc['dinhkem']){
		foreach ($mc['dinhkem'] as $dk) {
			$dinhkem .= '<div class="items form-group">';
        	$dinhkem .= '<div class="col-md-12">';
            $dinhkem .= '<div class="input-group">
                    <input type="hidden" class="form-control" name="dinhkem_aliasname[]" value="'.$dk['aliasname'].'" readonly/>
                	<input type="text" class="form-control" name="dinhkem_filename[]" value="'.$dk['filename'].'" />
                	<input type="hidden" class="form-control" name="dinhkem_size[]" value="'.$dk['size'].'" readonly/>
                	<input type="hidden" class="form-control" name="dinhkem_type[]" value="'.$dk['type'].'" readonly/>
                    <span class="input-group-addon"><a href="get.xoataptin.html?filename='.$dk['aliasname'].'" onclick="return false;" class="delete_file"><i class="fa fa-trash"></i></a></span>
                </div></div></div>';
		}
	}
	$arr = array(
		'id' => $id,
		'act' => $act,
		'ten' => $mc['ten'],
		'id_tieuchuan' => strval($mc['id_tieuchuan']),
		'id_loaivanban' => $mc['id_loaivanban'],
		'kyhieu' => $mc['kyhieu'],
		'noiphathanh' => $mc['noiphathanh'],
		'sovanban' => $mc['sovanban'],
		'sovanbanden' => $mc['sovanbanden'],
		'nguoiky' => $mc['nguoiky'],
		'ngayky' => $mc['ngayky'] ? DBConnect::getDate($mc['ngayky'], "d/m/Y") : '',
		'noidung' => $mc['noidung'],
		'dinhkem' => $dinhkem
	);
	echo json_encode($arr);
}

if($act == 'xem'){
    $minhchung->id = $id; $mc = $minhchung->get_one();
	if(isset($mc['id_tieuchuan']) && $mc['id_tieuchuan']){
        $tieuchuan->id = $mc['id_tieuchuan']; $tc = $tieuchuan->get_one();
        $tentieuchuan = $tc['ten'];
    } else {
        $tentieuchuan = '';
    }

	echo '
		<div class="form-group">
            <label class="col-md-2 control-label">Tên minh chứng</label>
            <div class="col-md-10 p-t-5">'.$mc['ten'].'</div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Tiêu chí</label>
            <div class="col-md-4 p-t-5">'.$tentieuchuan.'</div>
	        <label class="col-md-2 control-label">Loại văn bản</label>
	        <div class="col-md-4 p-t-5"></div>
    	</div>
    	<div class="form-group">
            <label class="col-md-2 control-label">Số văn bản</label>
            <div class="col-md-4 p-t-5">'.$mc['sovanban'].'</div>
            <label class="col-md-2 control-label">Số văn bản đến</label>
            <div class="col-md-4 p-t-5">'.$mc['sovanbanden'].'</div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Ký hiệu</label>
            <div class="col-md-4 p-t-5">'.$mc['kyhieu'].'</div>
            <label class="col-md-2 control-label">Nơi phát hành</label>
            <div class="col-md-4 p-t-5">'.$mc['noiphathanh'].'</div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Người ký</label>
            <div class="col-md-4 p-t-5">'.$mc['nguoiky'].'</div>
            <label class="col-md-2 control-label">Ngày ký</label>
            <div class="col-md-4 p-t-5">'.($mc['ngayky'] ? DBConnect::getDate($mc['ngayky'],"d/m/Y") : '').'</div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Nội dung</label>
            <div class="col-md-10 p-t-5">'.$mc['noidung'].'</div>
        </div>
        <div class="form-group">
	        <label class="col-md-3 control-label text-left">Đính kèm:</label>
	    </div>
	';
	if($mc['dinhkem']){
		foreach ($mc['dinhkem'] as $dk) {
			echo '<div class="items form-group">';
        	echo '<div class="col-md-12">';
            echo '<div class="input-group">
                    <input type="hidden" class="form-control" name="dinhkem_aliasname[]" value="'.$dk['aliasname'].'" readonly/>
                	<input type="text" class="form-control" name="dinhkem_filename[]" value="'.$dk['filename'].'" />
                	<input type="hidden" class="form-control" name="dinhkem_size[]" value="'.$dk['size'].'" readonly/>
                	<input type="hidden" class="form-control" name="dinhkem_type[]" value="'.$dk['type'].'" readonly/>
                    <span class="input-group-addon"><a href="'.$uploads_folder.$dk['aliasname'].'" target="_blank"><i class="fa fa-eye"></i></a></span>
                </div></div></div>';
		}
	}
}

if($act == 'del'){
	$loaivanban->id = $id;
	if($loaivanban->delete()){
		transfers_to('loaivanban.html?msg=Xóa thành công!');
	}
}

?>
