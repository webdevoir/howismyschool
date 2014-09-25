<?php
$json_result = array();
$design_id = $_GET['designId'];

if( $_SESSION['USER_ID'] == 0 || empty($_SESSION['USER_ID']) ) {
    $json_result['message']  = t('Illegal operation');
    die(json_encode($json_result));
}

$design_obj = create_model_object($db_obj, DESIGN_PATH, 'Design'); // load model class

if( !$login->is_user_logged_in() ) {
    $json_result['notLoggedIn']  = true;
    $json_result['message']    = t('Please login first');
}
else {
    $user_design = $design_obj->get_design_by_id($design_id)[0];
    $json_result['loggedIn']   = true;
    $json_result['user_design']['HTML'] = $user_design['html_info'];
    if( empty($user_design) ) {
        $json_result['message']  = t('No such record found.');
    }
}
die(json_encode($json_result));
?>