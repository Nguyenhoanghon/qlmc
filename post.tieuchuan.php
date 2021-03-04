<?php
require_once('header_none.php');
use Models\TieuChuan;
$tieuchuan = new TieuChuan();
$id = isset($_POST['id']) ? $_POST['id'] : '';
$act = isset($_POST['act']) ? $_POST['act'] : '';
$url = isset($_POST['url']) ? $_POST['url'] : '';
$ten = isset($_POST['ten']) ? $_POST['ten'] : '';
$id_parent = isset($_POST['id_parent']) ? $_POST['id_parent'] : '';
$ma = isset($_POST['ma']) ? $_POST['ma'] : '';
$mota = isset($_POST['mota']) ? $_POST['mota'] : '';
$orders = isset($_POST['orders']) ? $_POST['orders'] : '';

$tieuchuan->ten = $ten;
$tieuchuan->id_parent = $id_parent;
$tieuchuan->ma = $ma;
$tieuchuan->mota = $mota;
$tieuchuan->orders = $orders;

$l = explode("?", $url); $url = $l[0];
if($act == 'edit'){
	$tieuchuan->id = $id;
	if($tieuchuan->edit()) {
		if($url) transfers_to($url . '?msg=Chỉnh sửa thành công.');
		else transfers_to('tieuchuan.htmlmsg=Chỉnh sửa thành công!');
	}
} else if($act == 'del'){
	$tieuchuan->id = $id;
	if($tieuchuan->check_dmtieuchuan($id)){
		transfers_to('tieuchuan.html?msg=Không thể xoá, ràng buộc dữ liệu.');
	} else {
		if($tieuchuan->delete()){
			if($url) transfers_to($url . '?msg=Xoá thành công.');
			else transfers_to('tieuchuan.html?msg=Xoá thành công!');
		}
	}
} else {
	if($tieuchuan->insert()){
		if($url) transfers_to($url . '?msg=Thêm thành công.');
		else transfers_to('tieuchuan.html?msg=Thêm mới thành công!');
	}
}
?>
