<?php
function s2n($string){
	$len_of_string = strlen($string);
	$i = 0;
	$number = '';
	for($i=0; $i<$len_of_string; $i++){
		if($string[$i] != ".") $number .= $string[$i];
	}
	$number = str_replace(",","",$number);
	//doubleval($number);
	return $number;
}

function convert_string_number($string){
	$len_of_string = strlen($string);
	$i = 0;
	$number = '';
	for($i=0; $i<$len_of_string; $i++){
		if($string[$i] != ".") $number .= $string[$i];
	}
	$number = str_replace(",",".",$number);
	doubleval($number);
	return $number;
}

function transfers_to($url){ 	header('Location: ' . $url); }

function format_number($number){
	return number_format($number, 0, ",", ".");
}

function format_decimal($number, $dec){
	return number_format($number, $dec, ",", ".");
}
function format_date($date){
	return date("d/m/Y",strtotime($date));
}
function show_gioitinh($gioitinh){
	if($gioitinh == 1) return 'Nam';
	else return 'Nữ';
}
function quote_smart($value){
    if(get_magic_quotes_gpc()){
		$value=stripcslashes($value);    
    }
	$value=addslashes($value);
	return $value;    
}
function convert_date_yyyy_mm_dd($str_date){
	$s = explode ("/", $str_date);
	return strtotime($s[2] . '-'. $s[1] . '-' . $s[0] . ' 00:00:00');
}

function convert_date_yyyy_mm_dd_1($str_date, $gio, $phut){
	$s = explode ("/", $str_date);
	return strtotime($s[2] . '-'. $s[1] . '-' . $s[0] . ' '.$gio.':'.$phut.':00');
}

function convert_date_yyyy_mm_dd_2($str_date, $gio, $phut){
	$s = explode ("/", $str_date);
	return strtotime($s[0] . '-'. $s[1] . '-' . $s[2] . ' '.$gio.':'.$phut.':00');
}

function convert_date_mm_yyyy($string_date){
	$s = explode ("/", $string_date);
	return strtotime($s[1] . '-'. $s[0] . '-01 00:00:00');
}

function convert_date_dd_mm_yyyy($string_date){
	if(strlen($string_date) >= 8){
		$s = explode ("/", $string_date);
		if($s[2] && $s[1] && $s[0]){
			return strtotime($s[2].'-'.$s[1].'-'.$s[0] . ' 00:00:00');
		} else {
			return '';
		}
	} else {
		return strtotime($string_date . '-01-01 00:00:00');
	}
}

function checkDateTime($data) {
    if (date('Y-m-d H:i:s', strtotime($data)) == $data) {
        return true;
    } else {
        return false;
    }
}

function show_icon($icon){
	$str_icon = '';
	switch(strtolower($icon)){
		case 'pdf': $str_icon = 'mif-file-pdf'; break;
		case 'doc': $str_icon = 'mif-file-word'; break;
		case 'docx': $str_icon = 'mif-file-word'; break;
		case 'ppt': $str_icon = 'mif-file-powerpoint'; break;
		case 'pptx': $str_icon = 'mif-file-powerpoint'; break;
		case 'xls': $str_icon = 'mif-file-excel'; break;
		case 'xlsx': $str_icon = 'mif-file-excel'; break;
		case 'zip': $str_icon = 'mif-file-zip'; break;
		case 'rar': $str_icon = 'mif-file-zip'; break;
		case '7z': $str_icon = 'mif-file-zip'; break;
		case 'jpg': $str_icon = 'mif-images'; break;
		case 'png': $str_icon = 'mif-images'; break;
		case 'jpeg': $str_icon = 'mif-images'; break;
		case 'gif': $str_icon = 'mif-images'; break;
		default: 
			$str_icon = 'mif-attachment';
	}

	return '<span class="'.$str_icon.'"></span>';
}

//tinh so ngay tru ngay thu 7 & CN
function tinhngay($today, $songay){
	$ngaynghi = 0;$day = '';
	for($i=0; $i<$songay; $i++){
		$day = strtotime(date("Y-m-d", strtotime($today)) . " +".$i." day");
		if(date("D", $day) == 'Sat' || date("D", $day)=='Sun'){
			$ngaynghi++;
		}
	}
	$songay = $songay + $ngaynghi;
	$day = strtotime(date("Y-m-d", strtotime($today)) . " +".$songay." day");
	//return date("Y-m-d", $day);
	return $day();
}

function dksort($array, $case){
    if(array_key_exists($case,$array)){
        $a[$case] = $array[$case];
        foreach($array as $key=>$val){
            if($case==$key){

            }else{
                $a[$key] = $array[$key];
            }
        }
    }
    return $a;
}

function sort_array($arrays, $orderby, $sortby){
	foreach ($arrays as $id => $array) {
		$array_sort[$id]   = $array[$orderby];
	}
	// Sort the data with weight descending, specialties ascending
	// Add $data as the last parameter, to sort by the common key
	$keys = array_keys($arrays);
	array_multisort(
		$array_sort, $sortby, SORT_STRING,
		$arrays, $keys
	);
	$arrays = array_combine($keys, $arrays);
	return $arrays;
}
function br2nl( $input ) {
 return preg_replace('/<br(\s+)?\/?>/i', "\n", $input);
}

function check_permis($roles){
	if(!$roles){
		echo '
			<div class="row">
		    <div class="col-md-12">
		        <div class="panel panel-danger">
		            <div class="panel-heading">
		                <h4 class="panel-title">Bạn không có quyền</h4>
		            </div>
		            <div class="panel-body">
		                <p>Bạn không được cấp quyền truy cập vào chức năng này. <a href="index.html">Trở về</a></p>
		            </div>
		        </div>
		    </div>
		</div>
		';
		require_once('footer.php');
	echo '<script src="assets/plugins/gritter/js/jquery.gritter.js"></script>
	<script src="assets/js/apps.min.js"></script>
	<script>
	    $(document).ready(function() {
	        App.init();
	    });
	</script>';
		exit();
	}
}

function get_char($str, $from, $to){
	$t = '';
	for($i = $from; $i <= $to; $i++ ){
		$t .= $str[$i];
	}
	return $t;
}

function showCategories($categories, $id_parent = '', $char = '', $arr=array()){
    foreach ($categories as $key => $item){
        // Nếu là chuyên mục con thì hiển thị
        if ($item['id_parent'] == $id_parent){
            echo '<option value="'.$item['_id'].'"'.(in_array($item['_id'], $arr) ? ' selected':'').'>';
                echo $char . $item['ma'] .'. ' .$item['ten'];
            echo '</option>';
            // Xóa chuyên mục đã lặp
            unset($categories[$key]);
            // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
            showCategories($categories, $item['_id'], $char.'---', $arr);
        }
    }
}

function showCategories_Tree($categories, $id_parent = '', $collect=''){
	echo '<ul>';
    foreach ($categories as $key => $item){
        // Nếu là chuyên mục con thì hiển thị
        if ($item['id_parent'] == $id_parent){
        	echo '<li data-jstree=\'{"opened":true}\'>' . $item['ma'] .'. '.$item['ten'] . '<span>&nbsp;&nbsp;&nbsp;<a href="get.'.$collect.'.html?id='.$item['_id'].'&act=edit#modal-'.$collect.'" data-toggle="modal" class="sua'.$collect.'"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;&nbsp;<a href="get.'.$collect.'.html?id='.$item['_id'].'&act=del#modal-del'.$collect.'" data-toggle="modal" class="sua'.$collect.'" ><i class="fa fa-trash-o"></i></a></span>';
            // Xóa chuyên mục đã lặp
            unset($categories[$key]);
            // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
            showCategories_Tree($categories, $item['_id'], $collect);
            echo '</li>';
        }
    }
    echo '</ul>';
}

function showCategories_Tree_1($categories, $id_parent = '', $collect=''){
	echo '<ul>';
    foreach ($categories as $key => $item){
        // Nếu là chuyên mục con thì hiển thị
        if ($item['id_parent'] == $id_parent){
        	echo '<li data-jstree=\'{"opened":true}\'><a href="thongketheotieuchi.html?id_tieuchuan='.$item['_id'].'">' . $item['ma'] .'. '.$item['ten'] . '</a>';
            // Xóa chuyên mục đã lặp
            unset($categories[$key]);
            // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
            showCategories_Tree_1($categories, $item['_id'], $collect);
            echo '</li>';
        }
    }
    echo '</ul>';
}

function showCategories_Menu($categories, $id_parent = '', $level=0){
    echo '<ul id="nav" class="hidden-xs">';
    foreach ($categories as $key => $item){
        // Nếu là chuyên mục con thì hiển thị
        if ($item['id_parent'] == $id_parent){
        	echo '<li class="level0 parent drop-menu">' . $item['ten'];
            // Xóa chuyên mục đã lặp
            unset($categories[$key]);
            // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
            showCategories_Tree($categories, $item['_id']);
            echo '</li>';
        }
    }
    echo '</ul>';
}
?>