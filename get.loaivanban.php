<?php
require_once('header_none.php');
use Models\LoaiVanBan;
$loaivanban = new LoaiVanBan();
$id = isset($_GET['id']) ? $_GET['id'] : '';
$act = isset($_GET['act']) ? $_GET['act'] : '';

if($act == 'edit'){
	$loaivanban->id = $id; $cv = $loaivanban->get_one();
	$arr = array(
		'id' => $id,
		'act' => $act,
		'ten' => $cv['ten'],
		'thutu' => $cv['thutu'],
	);
	echo json_encode($arr);
}

if($act == 'del'){
	$loaivanban->id = $id;
	if($loaivanban->delete()){
		transfers_to('loaivanban.html?msg=Xóa thành công!');
	}
}

?>
