<?php
require_once('header.php');
check_permis($users->is_admin());
use Models\LoaiVanBan;
$msg = isset($_GET['msg']) ? $_GET['msg'] : '';
$loaivanban = new LoaiVanBan();
$loaivanban_list = $loaivanban->get_all_list();
?>
<link href="assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
<link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
<link href="assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
<link href="assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title"><i class="fa fa-list"></i> Danh mục Loại văn bản</h4>
            </div>
            <div class="panel-body">
                <a href="#modal-loaivanban" data-toggle="modal" class="btn btn-primary m-10 themloaivanban"><i class="fa fa-plus"></i> Thêm mới</a>
                <table id="data-table" class="table table-striped table-bordered table-hovered">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên Loại văn bản</th>
                            <th>Thứ tự</th>
                            <th class="text-center"><i class="fa fa-trash"></i></th>
                            <th class="text-center"><i class="fa fa-pencil"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if($loaivanban_list){
                        $i = 1;
                        foreach ($loaivanban_list as $cv) {
                            echo '<tr>
                                <td>'.$i.'</td>
                                <td>'.$cv['ten'].'</td>
                                <td>'.$cv['thutu'].'</td>
                                <td class="text-center"><a href="get.loaivanban.html?id='.$cv['_id'].'&act=del" onclick="return confirm(\'Chắc chắn muốn xoá?\');"><i class="fa fa-trash"></i></a></td>
                                <td class="text-center"><a href="get.loaivanban.html?id='.$cv['_id'].'&act=edit#modal-loaivanban" data-toggle="modal" class="sualoaivanban"><i class="fa fa-pencil"></i></a></td>
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
<div class="modal fade" id="modal-loaivanban">
<form action="post.loaivanban.html" method="POST" class="form-horizontal" data-parsley-validate="true" name="congtyform">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Thông tin Loại văn bản</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-md-2 control-label">TÊN</label>
                    <div class="col-md-6">
                        <input type="hidden" name="id" id="id" />
                        <input type="hidden" name="act" id="act" />
                        <input type="hidden" name="url" id="url" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                        <input type="text" name="ten" id="ten" value="" class="form-control" data-parsley-required="true"/>
                    </div>
                    <label class="col-md-2 control-label">THỨ TỰ</label>
                    <div class="col-md-2">
                        <input type="number" name="thutu" id="thutu" value="" class="form-control"/>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-sm btn-white" data-dismiss="modal">Đóng</a>
                <button type="submit" name="submit" id="submit" class="btn btn-sm btn-primary">Lưu</button>
            </div>
        </div>
    </div>
</form>
</div>
<div style="clear:both;"></div>
<?php require_once('footer.php'); ?>
<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="assets/plugins/gritter/js/jquery.gritter.js"></script>
<script src="assets/plugins/parsley/dist/parsley.js"></script>
<script src="assets/plugins/DataTables/media/js/jquery.dataTables.js"></script>
<script src="assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js"></script>
<script src="assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/js/table-manage-default.demo.min.js"></script>

<script src="assets/js/apps.min.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
<script>
    $(document).ready(function() {
        $("#themloaivanban").click(function(){
            $("#id").val();$("#act").val();
        });
        $(".sualoaivanban").click(function(){
            var _link = $(this).attr("href");
            $.getJSON(_link, function(data){
                $("#id").val(data.id); $("#act").val(data.act);
                $("#ten").val(data.ten); $("#thutu").val(data.thutu);
            });
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
        App.init();TableManageDefault.init();
    });
</script>
