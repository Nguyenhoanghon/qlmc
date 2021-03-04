<?php
//require_once('header_none.php');
require_once('header.php');
check_permis($users->is_admin());
$linkfile = new LinkFile();
$filename = 'import/linkfile.xlsx';
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
        <h4 class="panel-title">DANH SÁCH LINK FILE</h4>
      </div>
      <div class="panel-body">
      <table id="data-table" class="table table-striped table-bordered table-hovered">
                <thead>
                    <tr>
                        <th>LINK</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if($sheetData_import) {
                  foreach ($sheetData_import as $key => $value) {
                    $str = trim($value['A']);
                    $a = explode('|', $str);
                    echo $a[0] .'<br />';
                    echo $a[1] .'<br />';
                    $b = explode('=', $a[1]);
                    echo $b[2];
                    echo '<hr />';
                    $linkfile->filename = $a[0];
                    $linkfile->file_id = $b[2];
                    $linkfile->link = $a[1];
                    $linkfile->insert();
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
