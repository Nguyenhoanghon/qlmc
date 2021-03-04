<?php
require_once('header_none.php');
use Models\LoaiVanBan;
$loaivanban = new LoaiVanBan();
$id = isset($_POST['id']) ? $_POST['id'] : '';
$act = isset($_POST['act']) ? $_POST['act'] : '';
$url = isset($_POST['url']) ? $_POST['url'] : '';
$ten = isset($_POST['ten']) ? $_POST['ten'] : '';
$thutu = isset($_POST['thutu']) ? $_POST['thutu'] : 0;
$loaivanban->ten = $ten;$loaivanban->thutu = $thutu;
$l = explode("?", $url); $url = $l[0];

if($act == 'edit'){
	$loaivanban->id = $id;
	if($loaivanban->edit()) {
		if($url) transfers_to($url . '?msg=Chỉnh sửa thành công.');
		else transfers_to('loaivanban.htmlmsg=Chỉnh sửa thành công!');
	}
} else {
	if($loaivanban->insert()){
		if($url) transfers_to($url . '?msg=Thêm thành công.');
		else transfers_to('loaivanban.htmlmsg=Thêm mới thành công!');
	}
}
?>
