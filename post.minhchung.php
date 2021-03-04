<?php
require_once('header_none.php');
use Models\MinhChung;
use Models\DBConnect;
$minhchung = new MinhChung();
$id_user = $users->get_userid();
$id = isset($_POST['id']) ? $_POST['id'] : '';
$act = isset($_POST['act']) ? $_POST['act'] : '';
$url = isset($_POST['url']) ? $_POST['url'] : '';
$ten = isset($_POST['ten']) ? $_POST['ten'] : '';
$id_tieuchuan = isset($_POST['id_tieuchuan']) ? $_POST['id_tieuchuan'] : '';
$id_loaivanban = isset($_POST['id_loaivanban']) ? $_POST['id_loaivanban'] : '';
$kyhieu = isset($_POST['kyhieu']) ? $_POST['kyhieu'] : '';
$noiphathanh = isset($_POST['noiphathanh']) ? $_POST['noiphathanh'] : '';
$sovanban = isset($_POST['sovanban']) ? $_POST['sovanban'] : '';
$sovanbanden = isset($_POST['sovanbanden']) ? $_POST['sovanbanden'] : '';
$nguoiky = isset($_POST['nguoiky']) ? $_POST['nguoiky'] : '';
$ngayky = isset($_POST['ngayky']) ? $_POST['ngayky'] : '';
$noidung = isset($_POST['noidung']) ? $_POST['noidung'] : '';
$arr_dinhkem = array();
$dinhkem_aliasname = isset($_POST['dinhkem_aliasname']) ? $_POST['dinhkem_aliasname'] : '';
$dinhkem_filename = isset($_POST['dinhkem_filename']) ? $_POST['dinhkem_filename'] : '';
$dinhkem_type = isset($_POST['dinhkem_type']) ? $_POST['dinhkem_type'] : '';
$dinhkem_size = isset($_POST['dinhkem_size']) ? $_POST['dinhkem_size'] : '';
if($dinhkem_aliasname){
    foreach ($dinhkem_aliasname as $key => $value) {
        array_push($arr_dinhkem, array('filename' => $dinhkem_filename[$key], 'aliasname' => $value, 'type' => $dinhkem_type[$key], 'size' => $dinhkem_size[$key]));
    }
}
$minhchung->ten = $ten;
$minhchung->id_tieuchuan = $id_tieuchuan;
$minhchung->id_loaivanban = $id_loaivanban;
$minhchung->kyhieu = $kyhieu;
$minhchung->noiphathanh = $noiphathanh;
$minhchung->sovanban = $sovanban;
$minhchung->sovanbanden = $sovanbanden;
$minhchung->nguoiky = $nguoiky;
$minhchung->ngayky = $ngayky ? DBConnect::convertDate($ngayky) : '';
$minhchung->noidung = $noidung;
$minhchung->dinhkem = $arr_dinhkem;
$minhchung->id_user = $id_user;
$l = explode("?", $url); $url = $l[0];
if($act == 'edit'){
	$minhchung->id = $id;
	if($minhchung->edit()) {
		if($url) transfers_to($url . '?msg=Chỉnh sửa thành công.');
		else transfers_to('minhchung.htmlmsg=Chỉnh sửa thành công!');
	}
} else if($act == 'del'){
	$minhchung->id = $id; $mc = $minhchung->get_one();
	$minhchung->delete();
	if(isset($mc['dinhkem']) && $mc['dinhkem']){
		foreach($mc['dinhkem'] as $dk){
			if(file_exists($uploads_folder . $dk['aliasname'])){
				if(!$minhchung->check_dinhkem($dk['aliasname'])){
					@unlink($uploads_folder . $dk['aliasname']);
				}
			}
		}
	}
	if($url) transfers_to($url . '?msg=Xoá thành công.');
	else transfers_to('minhchung.html?msg=Xoá thành công!');
} else {
	if($minhchung->insert()){
		if($url) transfers_to($url . '?msg=Thêm thành công.');
		else transfers_to('minhchung.html?msg=Thêm mới thành công!');
	}
}
?>
