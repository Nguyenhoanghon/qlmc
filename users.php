<?php
require_once('header.php');
check_permis($users->is_admin());
$msg = isset($_GET['msg']) ? $_GET['msg'] : '';
$keysearch = isset($_GET['keysearch']) ? $_GET['keysearch'] : '';
if(isset($_GET['submit'])){
    $query = array('$or' => array(array('username'=> array('$regex' => '^'.$keysearch, '$options' => 'i')), array('person'=> array('$regex' => '^'.$keysearch, '$options' => 'i'))));
    $users_list = $users->get_list_condition($query);

} else {
    $users_list = $users->get_list_50();
}
?>
<link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title"><i class="fa fa-search"></i> Tìm tài khoản</h4>
            </div>
            <div class="panel-body">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Tên tài khoản</label>
                        <div class="col-md-4">
                            <input type="text" name="keysearch" id="keysearch" value="<?php echo $keysearch; ?>" class="form-control" placeholder="Tìm tài khoản người dùng">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" name="submit" value="OK" class="btn btn-sm btn-success"><i class="fa fa-search"></i> Tìm</button>
                            <a href="users_add.html" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Thêm mới</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php if($users_list): ?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title"><i class="fa fa-list"></i> Danh sách tài khoản người dùng</h4>
            </div>
            <div class="panel-body">
                <table class="table table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Tài khoản người dùng</th>
                    <th>Họ tên</th>
                    <th class="text-center">ADMIN</th>
                    <th class="text-center">MANAGER</th>
                    <th class="text-center">UPDATER</th>
                    <th><span class="fa fa-trash-o"></th>
                    <th><span class="fa fa-pencil"></span></th>
                </tr>
                </thead>
                <?php
                $i =1;
                foreach($users_list as $ul){
                    if($i%2==0) $class='eve'; else $class = 'odd';
                    echo '<tr class="'.$class.'">';
                    echo '<td>'.$i.'</td>';
                    echo '<td>'.$ul['username'].'</td>';
                    echo '<td>'.$ul['person'].'</td>';
                    echo '<td class="text-center">'.((in_array('ADMIN', iterator_to_array($ul['roles']))) ? '<img src="images/icon_yes.png" />' : '<img src="images/icon_no.png" />').'</td>';
                    echo '<td class="text-center">'.((in_array('MANAGER', iterator_to_array($ul['roles']))) ? '<img src="images/icon_yes.png" />' : '<img src="images/icon_no.png" />').'</td>';
                     echo '<td class="text-center">'.((in_array('UPDATER',iterator_to_array($ul['roles']))) ? '<img src="images/icon_yes.png" />' : '<img src="images/icon_no.png" />').'</td>';
                    if(in_array('ADMIN', iterator_to_array($ul['roles']))){
                        echo '<td></td>';
                    } else {
                        echo '<td><a href="users_delete.html?id='.$ul['_id'].'" onclick="return confirm(\'Chắc chắn xoá?\');"><i class="fa fa-trash-o"></i></a></td>';
                    }
                    echo '<td><a href="users_add.html?id='.$ul['_id'].'&act=edit"><i class="fa fa-pencil"></i></a></td>';
                    echo '</tr>';
                    $i++;
                }
                ?>
                </table>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php require_once('footer.php'); ?>
<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="assets/plugins/gritter/js/jquery.gritter.js"></script>
<script src="assets/js/apps.min.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
<script>
    $(document).ready(function() {
        <?php if(isset($msg) && $msg): ?>
        $.gritter.add({
            title:"Thông báo !",
            text:"<?php echo $msg; ?>",
            image:"assets/img/login.png",
            sticky:false,
            time:""
        });
        <?php endif; ?>
        App.init();
    });
</script>
