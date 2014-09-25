<?php

//verify sub-module access
$edit_path       = 'color/ColorEdit';
$delete_path     = 'color/ColorDelete';
$add_path        = 'color/ColorAdd';

$add_allowed     = $login->verify_module_access($add_path);
$edit_allowed    = $login->verify_module_access($edit_path);
$delete_allowed  = $login->verify_module_access($delete_path);

 $fields_array = array(
	'sr_no' => array('label' => t('Sr. No'),'style'=>'width:10%;'),
	'name'=>array('label'=>t('Name'),'style'=>'width:40%;',
	'sorting'=>TRUE),
	'image_path'=>array('label'=>t('Image'),'style'=>'width:35%;',
	'sorting'=>FALSE),
 	'IsActive' => array('label'=>t('Active'),'style'=>'width:15%;',
	'sorting'=>TRUE)
	);

 if($edit_allowed){
     $fields_array[EDIT_OP] = array('label'=>t('Edit'),'style'=>'width:13.5%;',
	'sorting'=>FALSE,'PK_FIELD'=>'id','EDIT_TYPE'=>URL_BASED,
	'EDIT_ACTION'=>$edit_path,
 	'NO_EDIT_COLUMN' => 'id','NO_EDIT_COLUMN_VALUE'=>array());
 }
 if($delete_allowed){
     $fields_array[DELETE_OP]= array('label'=>t('Delete'),
     'style'=>'width:13.5%;','sorting'=>FALSE,'PK_FIELD'=>'id',
     'DELETE_TYPE'=>JS_BASED,'DELETE_ACTION'=>'deleteConfirm',
 	'NO_DELETE_COLUMN' => 'id','NO_DELETE_COLUMN_VALUE'=>
     array());
 }

 $default_sort_field = 'name';
 $default_sort_order = 'ASC';

if(isset($_REQUEST['data-list']) && $_REQUEST['data-list'] == '1'){
	/*search*/
	$search      = urldecode($_REQUEST['search']);
	$search      = trim($db_obj->mysql_data_encode($search));

	/*Paging*/
	$limit = $utility_obj->get_data_table_limit(RECORDS_PER_PAGE);
	/*Ordering*/
	$sort_order = $utility_obj->get_data_table_order_by($fields_array,$default_sort_field,
	$default_sort_order);

	//load model class
	include_once('./model/color/Color.php');
	$color_obj = new Color($db_obj);

	$total_records = $color_obj->get_total_colors($search);
	$result_set    = $color_obj->get_color_list($sort_order,$limit,$search);

	//prepare the record set
	$output = $utility_obj->prepare_data_table_rows($result_set,$total_records,$page,
	RECORDS_PER_PAGE,$fields_array);
    die(json_encode(encode_json_array($output)));
}

$record_url = URL."color/ColorList&ajax=1&data-list=1";
$delete_url = URL."color/ColorDelete&ajax=1";
$table_id = 'size_div_table';
$data_list_input = array(
                      'TABLE_ID'=>$table_id,
                      'RECORDS_PER_PAGE'=>RECORDS_PER_PAGE,
                      'LINKS_PER_PAGE'=>LINKS_PER_PAGE,
                      'RECORD_URL'=>$record_url,
                      'FIELDS'=>$fields_array,
					  'DEFAULT_SORT_FIELD'=>$default_sort_field,
					  'DEFAULT_SORT_ORDER'=>$default_sort_order,
                      'LIST_HEADING'=>$utility_obj->get_page_name($page_url,2),
					  'FANCY_FUNC'=>'addFancyBoxEdit("editCell",1,"'.EDIT_FANCY_BOX_WIDTH.'",
                                                     "'.EDIT_FANCY_BOX_HEIGHT.'")'
                    );


$table_html = $utility_obj->display_data_table_listing($data_list_input);
require_once('./view/color/ColorList.php');
?>