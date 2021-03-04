<?php
require_once('header.php');
use Models\DBConnect;
use Models\TieuChuan;
use Models\MinhChung;
use Models\LoaiVanBan;
$msg = isset($_GET['msg']) ? $_GET['msg'] : '';
$tieuchuan = new TieuChuan();$tieuchuan_list = $tieuchuan->get_all_list();
$loaivanban = new LoaiVanBan(); $loaivanban_list = $loaivanban->get_all_list();
$minhchung = new MinhChung(); $minhchung_list = $minhchung->get_all_list();
$id_tieuchuan = isset($_GET['id_tieuchuan']) ? $_GET['id_tieuchuan'] : '5926ad56a40183742000003c';
$list_tieuchuan = $tieuchuan->get_list_condition(array('id_parent' => ''));
$arr_tieuchuan = array();
if($id_tieuchuan){
    $list_child = $tieuchuan->get_list_condition(array('id_parent' => DBConnect::ObjectId($id_tieuchuan)));
    if($list_child){
        foreach ($list_child as $key => $value) {
            $arr_tieuchuan[] = DBConnect::ObjectId($value['_id']);
        }
    }
    $arr_tieuchuan[] = DBConnect::ObjectId($id_tieuchuan);
    $minhchung_list = $minhchung->get_list_condition(array('id_tieuchuan' => array('$in' => $arr_tieuchuan))); //->sort(array('orders' => 1));
}
?>
<link href="assets/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css" rel="stylesheet" />
<link href="assets/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet" />
<link href="assets/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" />
<link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
<link href="assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
<link href="assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
<link href="assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
<link href="assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />
<link href="assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css" rel="stylesheet" />
<h1 class="page-header"><i class="fa fa-book"></i> QUẢN LÝ MINH CHỨNG</h1>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title"><i class="fa fa-list"></i> DANH SÁCH CÁC MINH CHỨNG</h4>
            </div>
            <div class="panel-body">
                <?php
                echo '<div class="btn-group" style="padding:10px;">';
                foreach ($list_tieuchuan as $key => $value) {
                    echo '<a href="thongkeminhchungchuaco.html?id_tieuchuan='.$value['_id'].'" type="button" class="btn btn-white '.($value['_id']==$id_tieuchuan ? 'active' : '').'">'.$value['ten'].'</a>';
                }
                echo '</div>';
                ?>
                <table id="data-table" class="table table-striped table-bordered table-hovered" style="font-size:12px;">
                    <thead>
                        <tr>
                            <th width="10" style="vertical-align: middle;">STT</th>
                            <th width="40" style="vertical-align: middle;">Ký hiệu</th>
                            <th style="text-align:center;vertical-align: middle;">Tên</th>
                            <!--<th>Ngày ký</th>
                            <th>Người ký</th>
                            <th>Ngày nhập</th>-->
                            <th style="text-align: center;vertical-align: middle;" >Số, tài liệu, ngày ban hành</th>
                            <th style="text-align: center;vertical-align: middle;">Nơi ban hành</th>
                            <th style="text-align: center;vertical-align: middle;" width="80">Minh chứng trùng</th>
                            <!--<th>Loại văn bản</th>
                            <th>Người nhập</th>-->
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if($minhchung_list){
                        $i = 1;
                        foreach ($minhchung_list as $mc) {
                            if(!file_exists('uploads/' . $mc['dinhkem'][0]['aliasname'])){
                                $class = 'style="color:#ff0000;font-weight:bold;vertical-align: middle;"';
                            echo '<tr>
                                <td class="text-center" style="vertical-align: middle;">'.$i.'</td>
                                <td '.$class.' class="text-center">'.$mc['kyhieu'].'</td>
                                <td style="vertical-align: middle;"><b>'.$mc['maminhchung'] .'</b> '.$mc['ten'].'</td>
                                <td style="vertical-align: middle;" class="text-center">'.$mc['sovanban'].'</td>
                                <td style="vertical-align: middle;" class="text-center">'.$mc['noiphathanh'].'</td>
                                <td style="vertical-align: middle;" class="text-center">'.$mc['maminhchungtrung'].'</td>
                            </tr>';$i++;
                            }
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div style="clear:both;"></div>
<?php require_once('footer.php'); ?>
<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="assets/plugins/gritter/js/jquery.gritter.js"></script>
<script src="assets/plugins/parsley/dist/parsley.js"></script>
<script src="assets/plugins/select2/dist/js/select2.min.js"></script>
<script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="assets/plugins/DataTables/media/js/jquery.dataTables.js"></script>
<script src="assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js"></script>
<script src="assets/plugins/DataTables/extensions/Buttons/js/dataTables.buttons.min.js"></script>
<script src="assets/plugins/DataTables/extensions/Buttons/js/buttons.bootstrap.min.js"></script>
<script src="assets/plugins/DataTables/extensions/Buttons/js/buttons.flash.min.js"></script>
<script src="assets/plugins/DataTables/extensions/Buttons/js/jszip.min.js"></script>
<script src="assets/plugins/DataTables/extensions/Buttons/js/pdfmake.min.js"></script>
<script src="assets/plugins/DataTables/extensions/Buttons/js/vfs_fonts.min.js"></script>
<script src="assets/plugins/DataTables/extensions/Buttons/js/buttons.html5.min.js"></script>
<script src="assets/plugins/DataTables/extensions/Buttons/js/buttons.print.min.js"></script>
<script src="assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="assets/js/minhchung.js"></script>
<script src="assets/js/apps.min.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
<script>
    $(document).ready(function() {
        /*upload_files();delete_file();
        $("#themminhchung").click(function(){
            $("#id").val();$("#act").val();
        });
        $(".suaminhchung").click(function(){
            var _link = $(this).attr("href");
            $.getJSON(_link, function(data){
                $("#id").val(data.id); $("#act").val(data.act);
                $("#ten").val(data.ten);
                $("#id_tieuchuan").val(data.id_tieuchuan);$("#id_tieuchuan").select2();
                $("#id_loaivanban").val(data.id_loaivanban);$("#id_loaivanban").select2();
                $("#sovanban").val(data.sovanban);$("#sovanbanden").val(data.sovanbanden);
                $("#kyhieu").val(data.kyhieu);$("#noiphathanh").val(data.noiphathanh);
                $("#nguoiky").val(data.nguoiky);$("#ngayky").val(data.ngayky);
                $("#noidung").val(data.noidung);
                $("#dinhkem_list").html(data.dinhkem);delete_file();
            });
        });
        $(".copyminhchung").click(function(){
            var _link = $(this).attr("href");
            $.getJSON(_link, function(data){
                $("#id").val(""); $("#act").val(data.act);
                $("#ten").val(data.ten);
                $("#id_tieuchuan").val("");$("#id_tieuchuan").select2();
                $("#id_loaivanban").val(data.id_loaivanban);$("#id_loaivanban").select2();
                $("#sovanban").val(data.sovanban);$("#sovanbanden").val(data.sovanbanden);
                $("#kyhieu").val(data.kyhieu);$("#noiphathanh").val(data.noiphathanh);
                $("#nguoiky").val(data.nguoiky);$("#ngayky").val(data.ngayky);
                $("#noidung").val(data.noidung);
                $("#dinhkem_list").html(data.dinhkem);remove_form_file();
            });
        });

        $(".xoaminhchung").click(function(){
            var _id = $(this).attr("name");
            $("#id_del").val(_id);
        });
        $(".xemminhchung").click(function(){
            var _link = $(this).attr("href");
            $.get(_link, function(data){
                $("#thongtinminhchung").html(data);
            });
        });
        $(".ngaythangnam").datepicker({todayHighlight:!0});
        $(".ngaythangnam").inputmask();
        $(".select2").select2();$(".progress").hide();*/
        $("#data-table").DataTable({
            responsive:!0,
            "pageLength": 100,
            //dom:"Bfrtip",
            dom: '<"top"Bfrtip<"clear">>rt<"bottom"iflp<"clear">>',
            buttons:[
                {extend:"excel",className:"btn-sm"},
                {extend:"pdf",className:"btn-sm"},
                {extend:"print",className:"btn-sm"}
            ],
        });

        App.init();

    });
</script>
