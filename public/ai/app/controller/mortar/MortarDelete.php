<?php
//load model class
require_once('./model/mortar/Mortar.php');
$mortar_obj = new Mortar($db_obj);

$err_flag = false;
$status = false;
$err_msg  = t('Record deleted succesfully');

$pk_val = trim($db_obj->mysql_data_encode($_REQUEST['delId']));
if(empty($pk_val)){
	$err_flag = true;
	$err_msg  = t('Mortar id can not be empty');
}else{
	if($mortar_obj->check_active_product($pk_val)){
    $err_flag = true;
    $err_msg = t('This mortar can not be deleted as there are active product 
    associated with this mortar');
   }
}
if(!$err_flag){
	// DELETE IMAGE IF EXIST 
	$result_set  = $mortar_obj->load_mortar_details($pk_val);
	$image_path = $result_set['image_path'];
	if(!empty($image_path) && file_exists(MORTAR_IMAGE_PHYSICAL_PATH.'/'.$image_path)){
		@unlink(MORTAR_IMAGE_PHYSICAL_PATH.'/'.$image_path);
	}
	$mortar_obj->delete_mortar($pk_val);
	$status = true;
}
$output['status'] = $status;
$output['message'] = $err_msg;
die(json_encode($output));
?>