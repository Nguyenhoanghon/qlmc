<?php
require_once('header.php');
check_permis($users->is_admin());
use Models\TieuChuan;
$tieuchuan = new TieuChuan();
$tieuchuan_list = $tieuchuan->get_list_root();
$id = isset($_GET['id']) ? $_GET['id'] : '';
$roles = array();
$password = '';

if(isset($_POST['submit'])){
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $roles = isset($_POST['roles']) ? $_POST['roles'] : '';
    $person = isset($_POST['person']) ? $_POST['person'] : '';
    $id_tieuchuan = isset($_POST['id_tieuchuan']) ? $_POST['id_tieuchuan'] : '';
    $users->id = $id;
    $users->username = $username;
    $users->password = $password;
    $users->roles = $roles;
    $users->person = $person;
    $users->id_tieuchuan = $id_tieuchuan;
    if($id){
        $users->edit();
        transfers_to('users.html');
    } else {
        if($users->check_exist_username()){
            echo '<div class="messages">Tài khoản đã tồn tại, vui lòng chọn tài khoản khác.</div>';
        } else {
            $users->insert();
            transfers_to('users.html');
        }
    }
}

if($id){
    $users->id = $id;
    $edit_user = $users->get_one();
    $id = $edit_user['_id'];
    $username = $edit_user['username'];
    $password = '';
    $roles = iterator_to_array($edit_user['roles']);
    $person = $edit_user['person'];
    $id_tieuchuan = isset($edit_user['id_tieuchuan']) ? iterator_to_array($edit_user['id_tieuchuan']) : array();
}
?>
<link href="assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
<link href="assets/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css" rel="stylesheet" />
<link href="assets/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet" />
<link href="assets/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" />
<link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
<link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" />
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" id="adduserform" class="form-horizontal" data-parsley-validate="true" enctype="multipart/form-data">
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title"><i class="fa fa-search"></i> Thông tin tài khoản người dùng</h4>
            </div>
            <div class="panel-body">
            	<div class="form-group">
            		<label class="col-md-3 control-label">Tài khoản:</label>
            		<div class="col-md-6">
            			<input type="hidden" name="id" id="id" value="<?php echo isset($id) ? $id : ''; ?>" />
                        <input type="hidden" name="act" id="act" value="<?php echo isset($act) ? $act : ''; ?>" />
						<input type="text" name="username" id="username" value="<?php echo isset($username) ? $username : ''; ?>" placeholder="Nhập tài khoản" class="form-control" <?php echo $id ? 'readonly' : ''; ?> data-parsley-required="true"/>
            		</div>
            	</div>
            	<div class="form-group">
            		<label class="col-md-3 control-label">Mật khẩu:</label>
            		<div class="col-md-6">
						<input type="password" name="password" id="password" value="" placeholder="Nhập mật khẩu" class="form-control" data-parsley-required="true" />
            		</div>
            	</div>
            	<div class="form-group">
            		<label class="col-md-3 control-label">Họ tên người được cấp tài khoản:</label>
            		<div class="col-md-6">
						<input type="text" name="person" id="person" value="<?php echo isset($person) ? $person : ''; ?>" placeholder="Nhập họ tên người được cấp" class="form-control" data-parsley-required="true">
            		</div>
            	</div>
            	<div class="form-group">
            		<label class="col-md-3 control-label">Phân quyền:</label>
                    <?php
                        foreach($arr_roles as $role){
                        echo '<div class="col-md-2">';
                            $checked = in_array($role, $roles) ? ' checked': '';
                            echo '<input type="checkbox" name="roles[]" data-render="switchery" data-theme="default"  value="'.$role.'" '.$checked .'> ' . $role;
                        echo '</div>';
                        }
                    ?>
            	</div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Quản lý tiêu chuẩn:</label>
                    <div class="col-md-9">
                    <select name="id_tieuchuan[]" id="id_tieuchuan" multiple="multiple" style="width:100%;">
                    <?php
                    if($tieuchuan_list){
                        foreach($tieuchuan_list as $tc){
                            $selected = in_array(strval($tc['_id']), $id_tieuchuan) ? ' selected' : '';
                            echo '<option value="'.$tc['_id'].'" '. $selected.'>'.$tc['ma'].'. '.$tc['ten'].'</option>';
                        }
                    }
                    ?>
                    </select>
                    </div>
                </div>
            </div>
            <div class="panel-footer text-center">
            	<button name="submit" id="submit" value="OK" class="btn btn-primary"><i class="fa fa-check-circle-o"></i> Cập nhật</button>
				<a href="users.html" class="btn btn-success"><i class="fa fa-mail-reply-all"></i> Trở về danh mục Tài khoản</a>
            </div>
        </div>
    </div>
</div>
</form>
<?php require_once('footer.php'); ?>
<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="assets/plugins/gritter/js/jquery.gritter.js"></script>
<script src="assets/plugins/switchery/switchery.min.js"></script>
<script src="assets/plugins/parsley/dist/parsley.js"></script>
<script src="assets/js/form-slider-switcher.demo.min.js"></script>
<script src="assets/plugins/select2/dist/js/select2.min.js"></script>
<script src="assets/js/apps.min.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
<script>
    $(document).ready(function() {
        $(".select2").select2();
        $("#id_tieuchuan").select2({
            placeholder: "Chọn tiêu chuẩn"
        });
    	<?php if(isset($msg) && $msg): ?>
        $.gritter.add({
            title:"Thông báo !",
            text:"<?php echo $msg; ?>",
            image:"assets/img/login.png",
            sticky:false,
            time:""
        });
        <?php endif; ?>
        App.init();FormSliderSwitcher.init();
    });
</script>
