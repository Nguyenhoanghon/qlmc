<?php
//require_once('header_none.php');
require_once('header.php');
check_permis($users->is_admin());
$tieuchuan = new TieuChuan();$minhchung = new MinhChung();
$filename = 'import/minhchung_BS.xlsx';
require_once('cls/PHPExcel/IOFactory.php');
$objPHPExcel = PHPExcel_IOFactory::load($filename);
$sheetData_import = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
?>
<link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
<link href="assets/plugins/jstree/dist/themes/default/style.min.css" rel="stylesheet" />
<div class="row">
    <div class="col-md-12 p-20">
    	<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
				</div>
				<h4 class="panel-title">DANH SÁCH MINH CHỨNG</h4>
			</div>
			<div class="panel-body">
			<table id="data-table" class="table table-striped table-bordered table-hovered">
                <thead>
                    <tr>
                        <th>_id</th>
                        <th>TIÊU CHÍ</th>
                        <th>MÃ MINH CHỨNG</th>
                        <th>FILE</th>
                        <th>TEN</th>
                        <th>SOVANBAN</th>
                        <th>NOIBANHANH</th>
                        <th>TRUNG</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if($sheetData_import) {
                	foreach ($sheetData_import as $key => $value) {
						if($key >= 2 && $value['A']) {
							$tieuchuan->ma = $value['A'];
							$id_tieuchuan = $tieuchuan->get_id_by_ma();
							$arr_dinhkem = array();
							if(trim($value['H']) != ''){
								array_push($arr_dinhkem, array('filename' => $value['D'], 'aliasname' => str_replace(' ', '',trim($value['H'])).'.pdf', 'type' => 'application/pdf', 'size' => 0));
							} else {
								array_push($arr_dinhkem, array('filename' => $value['D'], 'aliasname' => str_replace(' ', '',trim($value['C'])).'.pdf', 'type' => 'application/pdf', 'size' => 0));
							}
							$minhchung->orders = $value['I'];
							$minhchung->ten = $value['D'];
							$minhchung->id_tieuchuan = $id_tieuchuan;
							$minhchung->id_loaivanban = '';
							$minhchung->kyhieu = str_replace(' ', '',$value['B']);
							$minhchung->maminhchung = str_replace(' ', '',trim($value['C']));
							$minhchung->minhchungtrung = str_replace(' ', '',$value['G']);
							$minhchung->maminhchungtrung = str_replace(' ', '',trim($value['H']));
							$minhchung->noiphathanh = $value['F'];
							$minhchung->sovanban = $value['E'];
							$minhchung->sovanbanden = '';
							$minhchung->nguoiky = '';
							$minhchung->ngayky = '';
							$minhchung->noidung = $value['D'] . ' ' . $value['E'] . ' ' . $value['F'];
							$minhchung->dinhkem = $arr_dinhkem;
							$minhchung->id_user = '5926a9f6a40183742000003a';
							if($minhchung->insert()){
								echo '<tr>';
								echo '<td>'.$id_tieuchuan.'</td>';
								echo '<td>'.$value['A'].'</td>';
								echo '<td>'.$value['B'].'</td>';
								echo '<td>'.str_replace(' ', '',$value['C']).'</td>';
								echo '<td>'.$value['D'].'</td>';
								echo '<td>'.$value['E'].'</td>';
								echo '<td>'.$value['F'].'</td>';
								echo '<td>'.$value['H'].'</td>';
								echo '</tr>';
							}

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
<script src="assets/plugins/jstree/dist/jstree.min.js"></script>
<script src="assets/js/ui-tree.demo.min.js"></script>
<script src="assets/js/apps.min.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
<script>
    $(document).ready(function() {
        App.init();TreeView.init();

    });
</script>
