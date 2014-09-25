<?php
//load model class
require_once('./model/user-roles/roles.php');
$roleObj = new roles($db_obj);

$errFlag = false;
$status = false;
$errMsg  = t('Record deleted succesfully');

$pkVal = trim($db_obj->mysql_data_encode($_REQUEST['delId']));
if(empty($pkVal)){
	$errFlag = true;
	$errMsg  = t('Role id can not be empty');
}else{
	if($roleObj->check_active_users($pkVal)){
    $errFlag = true;
    $errMsg = t('This role can not be deleted as there are active usere
    associated with this role');
   }else if(in_array($pkVal, array(SUPER_ADMIN_ID,DELETED_ROLE))){
       $errFlag = true;
       $errMsg = t('These roles are restricted & can not be deleted');
   }
}
if(!$errFlag){
 $roleObj->deleteRole($pkVal,$_SESSION['USER_ID'],time());
 $status = true;
}
$output['status'] = $status;
$output['message'] = $errMsg;
die(json_encode($output));
?>