<?php
require_once('header_none.php');
//$linkfile = new LinkFile();
$filename = isset($_GET['file']) ? $_GET['file'] : '';
//$file = $linkfile->get_one_condition(array('filename' => $filename));

if($users->get_username() =='dhag' && in_array($filename, $arr_visible)){
    echo 'Sorry! Không được phép xem.';
} else  {
    ini_set('memory_limit', '-1');
    $file_path = 'uploads/'.$filename;
    if (file_exists($file_path)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($filename).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file_path));
        readfile($file_path);
        exit;
    } else {
        echo 'Sorry! Tập tin không tồn tại.';
    }
}
?>
