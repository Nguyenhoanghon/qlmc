<?php
function __autoload($class_name) {
    require_once('cls/class.' . strtolower($class_name) . '.php');
}
$session = new SessionManager();
$users = new Users();
require_once('inc/functions.inc.php');
require_once('inc/config.inc.php');

$start = isset($_GET['start']) ? $_GET['start'] : 0;
$length = isset($_GET['length']) ? $_GET['length'] : 0;
$draw = isset($_GET['draw']) ? $_GET['draw'] : 1;
$keysearch = isset($_GET['search']['value']) ? $_GET['search']['value'] : '';

if(strrpos($keysearch, '###')){
  $arr = explode("###", $keysearch);
  $condition = array('$or' => array(array('kyhieu' => new MongoRegex('/' . $arr[0] . '/i')), array('ten' => new MongoRegex('/' . $arr[0] . '/i')), array('sovanban' => new MongoRegex('/' .$arr[0]. '/i')), array('kyhieu' => new MongoRegex('/' . $arr[1] . '/i')), array('ten' => new MongoRegex('/' . $arr[1] . '/i')), array('sovanban' => new MongoRegex('/' .$arr[1]. '/i'))));
} else {
  $condition = array('$or' => array(array('kyhieu' => new MongoRegex('/' . $keysearch . '/i')), array('ten' => new MongoRegex('/' . $keysearch . '/i')), array('sovanban' => new MongoRegex('/' .$keysearch. '/i'))));
}

$minhchung = new MinhChung();
$minhchung_list = $minhchung->get_list_to_position_condition($condition, $start, $length);
$recordsTotal = $minhchung->count_all();
$recordsFiltered = $minhchung->get_totalFilter($condition);
$arr_minhchung = array();
if(isset($minhchung_list) && $minhchung_list){
    $i= $start+1;
    foreach ($minhchung_list as $mc) {
        /*if(!file_exists('uploads/'.$mc['dinhkem'][0]['aliasname'])){
          $filesize = '';//filesize('uploads/'.$mc['dinhkem'][0]['aliasname']);
                $class = 'style="color:#ff0000;font-weight:bold;vertical-align: middle;"';
        } else {
          $class='style="vertical-align: middle;"';
          $filesize = filesize('uploads/'.$mc['dinhkem'][0]['aliasname']);
          $filesize = round($filesize/1048576,2) . ' MB';
        }*/
        array_push($arr_minhchung, array(
                $i,'<div '.$class.'>' . $mc['kyhieu'] . '</div>',
                $mc['ten'],
                $mc['sovanban'],
                $mc['noiphathanh'],
                '<center><a href="http://exams.agu.edu.vn/qlmc/uploads/'.$mc['dinhkem'][0]['aliasname'].'" target="_blank" class="btn btn-success btn-sm"><i class="fa fa-download"></i> Download</a></center>'));
        $i++;
    }
}

echo json_encode(
  array('draw' => $draw,
        'recordsTotal' => $recordsTotal,
        'recordsFiltered' => $recordsFiltered,
        'data' => $arr_minhchung
    ));
?>
