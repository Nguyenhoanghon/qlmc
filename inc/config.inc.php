<?php
	//DEFINE QUYEN CHO TUNG NGUOI
	$arr_roles = array('ADMIN', 'MANAGER', 'UPDATER');

	$uploads_folder = 'uploads/';
	$files_extension = array('pdf', 'zip', 'rar', 'doc', 'docx', 'xls', 'png', 'gif', 'jpg', 'jpeg', 'bmp', 'rtf');
	$images_extension = array('png', 'gif', 'jpg', 'jpeg', 'bmp');
	$valid_formats = array("jpg", "png", "gif", "zip", "bmp", "doc", "docx", "pdf", "xls", "xlsx", "ppt", "pptx", 'zip', 'rar');
	$max_file_size = 50*1024*1024*1024; //50MB

	$arr_gioitinh = array('M' => 'Nam', 'F' => 'Nữ');
	$arr_dungdenngay = array('D' => 'Ngày', 'M' => 'Tháng', 'Y' => 'Năm');
	$arr_tinhtrang = array(
		0 => 'Đang chờ duyệt',
		1 => 'Đã duyệt',
		2 => 'Không duyệt'
	);

	$arr_visible = array(
		'H2.2.21-1.pdf','H2.2.21-2.pdf','H5.1.19-1.pdf','H5.1.19-2.pdf',
		'H5.1.20-1.pdf','BSA.H5.1.1-1.pdf','H5.3.13-2.pdf'
	);
?>
