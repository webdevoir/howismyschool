<?php
//load model class
require_once('./model/plant/Plant.php');
$plant_obj = new Plant($db_obj);

$err_flag = false;
$status = false;
$err_msg  = t('Record deleted succesfully');

$pk_val = trim($db_obj->mysql_data_encode($_REQUEST['delId']));
if(empty($pk_val)){
	$err_flag = true;
	$err_msg  = t('Plant id can not be empty');
}else{
	if($plant_obj->check_active_product($pk_val)){
    $err_flag = true;
    $err_msg = t('This plant can not be deleted as there are active product 
    associated with this plant');
   }
}
if(!$err_flag){
	// DELETE IMAGE IF EXIST 
	$result_set  = $plant_obj->load_plant_details($pk_val);
	$image_path = $result_set['image_path'];
	if(!empty($image_path) && file_exists(SIZE_IMAGE_PHYSICAL_PATH.'/'.$image_path)){
		@unlink(SIZE_IMAGE_PHYSICAL_PATH.'/'.$image_path);
	}
	$plant_obj->delete_plant($pk_val);
	$status = true;
}
$output['status'] = $status;
$output['message'] = $err_msg;
die(json_encode($output));
?>