<?php
$returnURL = '';
if($_REQUEST['rurl']!=''){
	$returnURL = URL.'dashboard';
}

$pkField = trim($_REQUEST['Id']);

//can not edit other people's profile
if($pkField != $_SESSION['USER_ID']){
	echo ACCESS_DENIED_MESSAGE;
	return;
}

//load model class
require_once('./model/user-roles/users.php');
$userObj = new users($db_obj);

$pageURL = URL.$_SERVER['QUERY_STRING'];

$noRecords = false;
if($pkField ==''){
	$noRecords = true;
}else{
	//fetch records
	$resultSet  = $userObj->load_user_details($pkField);
}

//process POST vars
if(!empty($_POST['submit'])){
	foreach ($_POST as &$value) {
		$value = trim($value);
	}
    $validationArray[] = array('value' => t('Username'), 'type' => 'input_text',
	'required' => TRUE, 'vtype' => 0, 'vmax' => 20);
	$dataArray[] = array('user_name' => $_POST['user_name']);
	$columnArray[] = 'user_name';

	$validationArray[] = array('value' => t('Password'), 'type' => 'input_text',
	'required' => TRUE, 'vtype' => 0, 'vmax' => 10);
	$dataArray[] = array('user_password' => $_POST['user_password']);
	$columnArray[] = 'user_password';

	$validationArray[] = array('value' => t('Confirm Password'), 
	'type' => 'input_text', 'required' => TRUE, 'vtype' => 0, 'vmax' => 10);
	$dataArray[] = array('confirm_password' => $_POST['confirm_password']);
	$columnArray[] = 'confirm_password';
	
	$validationArray[] = array('value' => t('Full Name'), 
	'type' => 'input_text', 'required' => TRUE, 'vtype' => 3, 'vmax' => 50);
	$dataArray[] = array('full_name' => $_POST['full_name']);
	$columnArray[] = 'full_name';
	
	$validationArray[] = array('value' => t('Email'), 'type' => 'input_text', 
	'required' => TRUE, 'vtype' => 5, 'vmax' => 50);
	$dataArray[] = array('email_id' => $_POST['email_id']);
	$columnArray[] = 'email_id';

    if(empty($_POST['role_id'])){
	    $_POST['role_id'] = '';
	}
	$validationArray[] = array('value' => t('Role'), 'type' => 'select', 
	'required' => TRUE, 'vtype' => 0, 'vmax' => 0);
	$dataArray[] = array('role_id' => $_POST['role_id']);
	$columnArray[] = 'role_id';
	
	$cnt = count($validationArray);
	$errorFlag = false;
	$successFlag = false;
	for ($i = 0; $i < $cnt; $i++) {
		if (!$utility_obj->validate_form_field($validationArray[$i], 
		    $dataArray[$i], $columnArray[$i])) {
			$errorFlag = true;
			$utility_obj->set_flash_message($errorMessage, 'error');
			break;
		}
	}

	if (trim($_POST['user_password']) != trim($_POST['confirm_password']) &&
	     !$errorFlag) {
		$errorFlag = true;
		$utility_obj->set_flash_message(t('Passwords do not matched'), 'error');
	}

	if(!$errorFlag){
		//save the data
		//check duplicate values
		if($userObj->check_duplicate_username('user_name',
		    $_POST['user_name'],$pkField)){
			$errorFlag = true;
			$utility_obj->set_flash_message(t('This username already exists'),
			'error');
		}

		if (isset($_POST['email_id']) && !empty($_POST['email_id'])
            && $userObj->check_duplicate_useremail('email_id', $_POST['email_id'],
            $pkField) and !$errorFlag) {
			$errorFlag = true;
			$utility_obj->set_flash_message(t('This email id already exists'), 
			'error');
		}

		if(!$errorFlag){
			$data['pk']             = $pkField;
			$data['user_name'] = trim($_POST['user_name']);
			$data['user_password'] = trim($_POST['user_password']);
			$data['role_id'] = trim($_POST['role_id']);
			$data['is_active'] = 1;
			$data['full_name'] = trim($_POST['full_name']);
			$data['email_id'] = trim($_POST['email_id']);

			
            $extraMsg = ''; 
			if($userObj->save_user_data($data)){
				$_SESSION['USER_NAME']  = $data['full_name'];
               	$_SESSION['USER_EMAIL'] = $data['email_id'];
				$successFlag = true;
				$utility_obj->set_flash_message(t('Data saved successfully'.$extraMsg)
				,'success');
				$pageURLArray = explode('rurl', $_SERVER['QUERY_STRING']);
				$utility_obj->redirect_user(URL.'user-roles/users/profile-edit&Id='.$pkField.'&rurl'.$pageURLArray[1]);
				exit;
			}else{
				$errorFlag = true;
				$utility_obj->set_flash_message(t('Data could not be saved'),
				'error');
			}
		}
	}
}

$rolesData  = $userObj->load_role_list();
$rolesArray = array();
$rolesArray[] = t('Select');
if(is_array($rolesData) && count($rolesData)){
    foreach ($rolesData as $role){
        $rolesArray[$role['id']] = $role['role_code'];
    }
}
$selectedRole = '';
if(isset($_POST['role_id'])){
 $selectedRole = trim($_POST['role_id']);      
}else{
 $selectedRole  = $resultSet['role_id'];   
}

require_once('./view/user-roles/users/profile-edit.php');
?>