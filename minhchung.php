<?php
require_once('header.php');
check_permis($users->is_admin() || $users->is_manager());
use Models\TieuChuan;
use Models\LoaiVanBan;
use Models\MinhChung;
$msg = isset($_GET['msg']) ? $_GET['msg'] : '';
$tieuchuan = new TieuChuan();$tieuchuan_list = $tieuchuan->get_all_list();
$loaivanban = new LoaiVanBan(); $loaivanban_list = $loaivanban->get_all_list();
$minhchung = new MinhChung(); $minhchung_list = $minhchung->get_all_list();
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
<h3 class="text-align:center;">
    Tổng cộng: <?php echo format_number(count($minhchung_list)); ?>
</h3>
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
            	<a href="#modal-minhchung" data-toggle="modal" class="btn btn-primary m-10 themminhchung"><i class="fa fa-plus"></i> Thêm mới</a>
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
                            <th style="text-align: center;vertical-align: middle;">Minh chứng trùng</th>
                            <th>Dung lượng</th>
                            <!--<th>Loại văn bản</th>
                            <th>Người nhập</th>-->
                            <th class="text-center" width="60" style="vertical-align: middle;">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    /*if($minhchung_list){
                        $i = 1;
                        foreach ($minhchung_list as $mc) {
                            //$tieuchuan->id = $mc['id_tieuchuan']; $tc = $tieuchuan->get_one();
                            //$vb = $loaivanban->get_vanban($mc['id_loaivanban']);
                            //$users->id = $mc['id_user']; $u = $users->get_one();
                            /*<td>'.($mc['ngayky'] ? date("d/m/Y", $mc['ngayky']->sec) : '').'</td>
                            <td>'.$mc['nguoiky'].'</td>
                            <td>'.date("d/m/Y", $mc['date_post']->sec).'</td>
                            <td>'.$vb.'</td>
                            <td>'.$u['person'].'</td>
                            if(!file_exists('uploads/' . $mc['dinhkem'][0]['aliasname'])){
                                $class = 'style="color:#ff0000;font-weight:bold;vertical-align: middle;"';
                            } else { $class='vertical-align: middle;';}
                            echo '<tr>
                                <td class="text-center" style="vertical-align: middle;">'.$i.'</td>
                                <td '.$class.' class="text-center">'.$mc['kyhieu'].'</td>
                                <td style="vertical-align: middle;">'.$mc['ten'].'</td>
                                <td style="vertical-align: middle;" class="text-center">'.$mc['sovanban'].'</td>
                                <td style="vertical-align: middle;" class="text-center">'.$mc['noiphathanh'].'</td>
                                <td class="text-center">
                                <a href="get.minhchung.html?id='.$mc['_id'].'&act=copy#modal-minhchung" class="copyminhchung" data-toggle="modal"><i class="fa fa-copy"></i></a>
                                <a href="get.minhchung.html?id='.$mc['_id'].'&act=xem#modal-xemminhchung" class="xemminhchung" data-toggle="modal""><i class="fa fa-eye"></i></a>
                                <a href="get.minhchung.html?id='.$mc['_id'].'&act=edit#modal-minhchung" class="suaminhchung" data-toggle="modal"><i class="fa fa-edit"></i></a>
                                <a href="#modal-xoaminhchung" name="'.$mc['_id'].'" data-toggle="modal" onclick="return false;" class="xoaminhchung"><i class="fa fa-trash"></i></a>
                                <a href="uploads/'.$mc['dinhkem'][0]['aliasname'].'" target="_blank"><i class="fa fa-download"></i></a>
                                </td>
                            </tr>';$i++;
                        }
                    }*/
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-minhchung">
<form action="post.minhchung.html" method="POST" class="form-horizontal" data-parsley-validate="true" name="minhchungform" id="minhchungform">
	<input type="hidden" name="id" id="id" />
    <input type="hidden" name="act" id="act" />
    <input type="hidden" name="url" id="url" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">THÔNG TIN MINH CHỨNG MỚI</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-md-2 control-label">Tên minh chứng</label>
                    <div class="col-md-10">
                        <input type="text" name="ten" id="ten" value="" class="form-control" data-parsley-required="true"/>
                    </div>
                </div>
                <div class="form-group">
                	<label class="col-md-2 control-label">Tiêu chí</label>
                	<div class="col-md-4">
                		<select name="id_tieuchuan" id="id_tieuchuan" class="select2" style="width:100%">
                		<?php
                        if($tieuchuan_list){
                            $list = $tieuchuan_list;
                            showCategories($list);
                        }
                        ?>
                		</select>
                	</div>
                	<label class="col-md-2 control-label">Loại văn bản</label>
                	<div class="col-md-4">
                	<select name="id_loaivanban[]" id="id_loaivanban" multiple="multiple" class="select2" style="width:100%">
                	<?php
                	if($loaivanban_list){
                		foreach ($loaivanban_list as $vb) {
                			echo '<option value="'.$vb['_id'].'">'.$vb['ten'].'</option>';
                		}
                	}
                	?>
                	</select>
                	</div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Số văn bản</label>
                    <div class="col-md-4">
                        <input type="text" name="sovanban" id="sovanban" value="" class="form-control"/>
                    </div>
                    <label class="col-md-2 control-label">Số văn bản đến</label>
                    <div class="col-md-4">
                        <input type="text" name="sovanbanden" id="sovanbanden" value="" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
					<label class="col-md-2 control-label">Ký hiệu</label>
                    <div class="col-md-4">
                        <input type="text" name="kyhieu" id="kyhieu" value="" class="form-control"/>
                    </div>
                    <label class="col-md-2 control-label">Nơi phát hành</label>
                    <div class="col-md-4">
                        <input type="text" name="noiphathanh" id="noiphathanh" value="" class="form-control" data-parsley-required="true"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Người ký</label>
                    <div class="col-md-4">
                        <input type="text" name="nguoiky" id="nguoiky" value="" class="form-control"/>
                    </div>
                    <label class="col-md-2 control-label">Ngày ký</label>
                    <div class="col-md-4">
                        <input type="text" name="ngayky" id="ngayky" value="" class="form-control ngaythangnam" data-date-format="dd/mm/yyyys" data-inputmask="'alias': 'date'" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Nội dung</label>
                    <div class="col-md-10">
                        <textarea name="noidung" id='noidung' class="form-control" placeholder="Nội dung" rows="5"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Đính kèm:</label>
                    <div class="col-md-6">
                        <span class="btn btn-success fileinput-button">
                            <i class="fa fa-plus"></i>
                            <span>Chọn tập tin đính kèm...</span>
                            <input type="file" name="dinhkem[]" class="dinhkem" accept="*" multiple="multiple">
                        </span>
                    </div>
                </div>
                <div class="progress progress-striped active">
                    <div class="progress-bar" style="width:0%">0%</div>
                </div>
                <div id="dinhkem_list">
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
<div class="modal fade" id="modal-xemminhchung">
<form action="post.minhchung.html" method="POST" class="form-horizontal" data-parsley-validate="true" name="minhchungform" id="minhchungform">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-info"></i> THÔNG TIN MINH CHỨNG</h4>
            </div>
            <div class="modal-body" id="thongtinminhchung">
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-sm btn-primary" data-dismiss="modal">Đóng</a>
            </div>
        </div>
    </div>
</form>
</div>

<div class="modal fade" id="modal-xoaminhchung">
    <form action="post.minhchung.html" method="POST" class="form-horizontal" data-parsley-validate="true" name="minhchungform" id="minhchungform">
        <input type="hidden" name="id" id="id_del" />
        <input type="hidden" name="act" id="act" value="del"/>
        <input type="hidden" name="url" id="url" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-trash"></i> XÁC NHẬN XOÁ</h4>
            </div>
            <div class="modal-body">
                <h3>Chắc chắn xoá?</h3>
                <p>Xoá! dữ liệu sẽ bị mất không thể khôi phục.</p>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-sm btn-white" data-dismiss="modal"><i class="fa fa-close"></i> Không xoá</a>
                <button type="submit" name="submit" id="submit" class="btn btn-sm btn-primary"><i class="fa fa-trash"></i> Đồng ý xoá</button>
            </div>
        </div>
    </form>
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
   	upload_files();delete_file();
        $("#themminhchung").click(function(){
            $("#id").val();$("#act").val();
        });
        $("#data-table").on( "click", 'tbody tr .suaminhchung', function(){
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
        //$(".copyminhchung").click(function(){
        $("#data-table").on( "click", 'tbody tr .copyminhchung', function(){
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

        //$(".xoaminhchung").click(function(){
        $("#data-table").on( "click", 'tbody tr .xoaminhchung', function(){
            var _id = $(this).attr("name");
            $("#id_del").val(_id);
        });
        //$(".xemminhchung").click(function(){
        $("#data-table").on( "click", 'tbody tr .xemminhchung', function(){
            var _link = $(this).attr("href");
            $.get(_link, function(data){
                $("#thongtinminhchung").html(data);
            });
        });
        $(".ngaythangnam").datepicker({todayHighlight:!0});
        $(".ngaythangnam").inputmask();
    	$(".select2").select2();$(".progress").hide();
        /*$("#data-table").DataTable({
            responsive:!0,
            "pageLength": 100,
            //dom:"Bfrtip",
            dom: '<"top"Bfrtip<"clear">>rt<"bottom"iflp<"clear">>',
            buttons:[
                {extend:"excel",className:"btn-sm"},
                {extend:"pdf",className:"btn-sm"},
                {extend:"print",className:"btn-sm"}
            ],
        });*/
        $('#data-table').dataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "dataTable_minhchung.html",
            responsive:!0, "pageLength": 10,
            dom: '<"top"Bfrtip<"clear">>rt<"bottom"iflp<"clear">>',
            buttons:[
                {extend:"excel",className:"btn-sm"},
                {extend:"pdf",className:"btn-sm"},
                {extend:"print",className:"btn-sm"}
            ]
        });
        App.init();
    });
</script>
