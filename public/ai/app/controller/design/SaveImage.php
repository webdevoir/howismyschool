<?php
$json_result  = array();

$design_obj = create_model_object($db_obj, DESIGN_PATH, 'Design'); // load model class
$seamless_design_id = $design_obj->save_image($db_obj->mysql_data_encode($_POST["html"]));

require_once('../class/DesignImage.php');
$design_image_obj = new DesignImage("jpg");
$image_obj = $design_image_obj->create_design_image($seamless_design_id);

if( $image_obj['design_created'] ) {
    $json_result = $image_obj;
}
else {
    $json_result['message'] = "Failed to create the image. Please try after some time.";
}

die(json_encode($json_result));
?>