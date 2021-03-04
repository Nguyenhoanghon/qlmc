<?php require_once('header.php');
$msg = isset($_GET['msg']) ? $_GET['msg'] : '';
?>
<link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
<link href="assets/plugins/nvd3/build/nv.d3.css" rel="stylesheet" />
<!-- begin page-header -->
<h1 class="page-header"><i class="fa fa-book"></i> THỐNG KÊ THEO THỜI GIAN NHẬP</h1>
<div style="clear:both;"></div>
<?php require_once('footer.php'); ?>
<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="assets/plugins/gritter/js/jquery.gritter.js"></script>
<script src="assets/ajax/libs/d3/3.5.2/d3.js"></script>
<script src="assets/plugins/nvd3/build/nv.d3.js"></script>
<script src="assets/js/chart-d3.demo.min.js"></script>
<script src="assets/js/apps.min.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
<script>
    $(document).ready(function() {
        App.init();ChartNvd3.init();

    });
</script>