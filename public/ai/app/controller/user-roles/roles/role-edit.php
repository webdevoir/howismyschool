<?php
$errorFlag = false;
$pkField = trim($_REQUEST['id']);

$returnURL = '';
if ($_REQUEST['rurl'] != '') {
    $returnURL = URL . trim($_REQUEST['rurl']) . '&sortField='
    .trim($_REQUEST['sortField'])
    . '&sortOrderBy=' . trim($_REQUEST['sortOrderBy'])
    . '&page=' . trim($_REQUEST['page']);
}


//load model class
require_once('./model/user-roles/roles.php');
$roleObj = new roles($db_obj);

$pageURL = URL.$_SERVER['QUERY_STRING'];

//process POST vars
if(!empty($_POST['submit'])){
    //create validation arrays
    $validationArray[] = array('value' => t('Role Name'),'type' => 'input_text',
	'required' => TRUE,'vtype' => 3,'vmax' => 100);
    $dataArray[]   = array('role_name' => $_POST['role_name']);
    $columnArray[] = 'role_name';

    $validationArray[] = array('value' => t('Role Code'),'type' => 'input_text',
	'required' => TRUE,'vtype' => 2,'vmax' => 50);
    $dataArray[]   = array('role_code' => $_POST['role_code']);
    $columnArray[] = 'role_code';


    $validationArray[] = array('value' => t('Status'),'type' => 'radio',
    'required' => TRUE,
	'vtype' => 0,'vmax' => 0,'enum'=>'1~0');
    $dataArray[]   = array('is_active' => $_POST['is_active']);
    $columnArray[] = 'is_active';

    $cnt = count($validationArray);
    $successFlag = false;
    for($i=0;$i<$cnt;$i++){
        if(!$utility_obj->validate_form_field($validationArray[$i],
        $dataArray[$i],$columnArray[$i]) && !$errorFlag){
            $errorFlag = true;
            $utility_obj->set_flash_message($_SESSION['errorMessage'],'error');
            break;
        }
    }

    if(!$errorFlag){
        //save the data
        //check duplicate values
        if($roleObj->check_duplicate_column('role_name',$_POST['role_name'],
        $pkField)){
            $errorFlag = true;
            $utility_obj->set_flash_message(t('This role name already exists'),
            'error');
        }
        if($roleObj->check_duplicate_column('role_code',$_POST['role_code'],
        $pkField)){
            $errorFlag = true;
            $utility_obj->set_flash_message(t('This role code already exists'),
            'error');
        }

        if(!$errorFlag){
            if($roleObj->check_active_users($pkField) && $_POST['is_active'] 
            !='1'){
                $errorFlag = true;
                $utility_obj->set_flash_message(t('This role can not be 
                deactived as there are active usere associated 
                with this role'),'error');
            }
        }

        if(!$errorFlag){
            $data['pk']           = $pkField;
            $data['role_name']    = $_POST['role_name'];
            $data['role_code']    = $_POST['role_code'];
            $data['is_active']     = $_POST['is_active'];

            if($roleObj->save_role_data($data)){
                $successFlag = true;
                $utility_obj->set_flash_message(t('Data saved successfully'),
                'success');
                 $utility_obj->redirect_user($pageURL.'&fancy=1');
                exit;
            }else{
                $errorFlag = true;
                $utility_obj->set_flash_message(t('Data could not be saved'),
                'error');
            }
        }
    }
}else if(!empty($_POST['submit-permission'])){
        include_once('./model/user-roles/permission.php');
        $permissionObj = new permission($db_obj);
        $ret 
        = $permissionObj->save_role_permission($pkField,
        $_POST['permissionChk']);
        if($ret){
            $utility_obj->set_flash_message(t('Permission updated successfully'),
            'success');
            $utility_obj->redirect_user($pageURL.'&fancy=1');
            exit;
        }else{
            $errorFlag = true;
            $utility_obj->set_flash_message(t('Permission could not be saved'),
            'error');
        }
}

$noRecords = false;
if($pkField ==''){
    $noRecords = true;
}else{
    //fetch records
    $resultSet  = $roleObj->load_role_details($pkField);
    
    //fetch permission data
    include_once('./model/user-roles/permission.php');
    $permissionObj = new permission($db_obj);    
    $currentValArray = $permissionObj->getRolePermissionData($pkField);
    if(!$currentValArray){
        $currentValArray = array();
    }else{
        $moduleCodes = create_comma_separated_list($currentValArray,
        'menu_codes',2,0);
        $currentValArray = explode(',', $moduleCodes);
    }
    $permissionHTML = 
    $menu_obj->build_permission_display_items(array(),$currentValArray);
}

require_once('./view/user-roles/roles/role-edit.php');
?>