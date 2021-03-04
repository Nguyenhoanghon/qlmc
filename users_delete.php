<?php
require_once('header.php');
check_permis($users->is_admin());
$id = isset($_GET['id']) ? $_GET['id'] : '';
$users->id = $id;
$u = $users->get_one();
if(!$users->is_admin()) {
	transfers_to('users.html?msg=Không thể xoá Admin');
	echo 'Không thể xoá Admin. <a href="users.html">Trở về</a>';
} else {
	if($users->delete()){
		transfers_to('users.html?msg=Xoá thành công!');
	} else {
		transfers_to('users.html?msg=Không thể xoá!');
	}
}

?>
<?php require_once('footer.php'); ?>
