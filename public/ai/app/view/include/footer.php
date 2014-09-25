<div id="dialog-confirm" class="dialog-pop-up"></div>
<div id="dialog-databox" class="dialog-pop-up"></div>

<?php if( $pageURL != WALL_URL) { ?>
<img src="<?php echo IMAGE_URL.'/ajax-loader.gif';?>" id="ajaxLoader" />
<?php } ?>

<div id="blockUI"></div>
<div class="push-box"></div>
</div> <!-- Main Container closed -->

<?php

  $footerClass = 'gen-footer';
  if(in_array($pageURL, $bgPages)){
    $footerClass = 'login-footer';
  }
  if(!isset($_REQUEST['fancy']) || isset($_REQUEST['fancy']) != '1'){
    if( $pageURL != WALL_URL) {
?>
      <div class="footer <?php echo $footerClass;?>">
      &copy; <?php echo t('All rights reserved.');?>
      </div>
<?php
    }
  }
?>

<?php
//cache Bootstrap JS files
$jsArray   = array();
$jsArray[] = JS_URL.'/themeJs/bootstrap.min.js';
$jsArray[] = JS_URL.'/themeJs/raphael-min.js';
$jsArray[] = JS_URL.'/themeJs/plugins/morris/morris.min.js';
$jsArray[] = JS_URL.'/themeJs/plugins/sparkline/jquery.sparkline.min.js';
$jsArray[] = JS_URL.'/themeJs/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js';
$jsArray[] = JS_URL.'/themeJs/plugins/jvectormap/jquery-jvectormap-world-mill-en.js';
$jsArray[] = JS_URL.'/themeJs/plugins/fullcalendar/fullcalendar.min.js';
$jsArray[] = JS_URL.'/themeJs/plugins/jqueryKnob/jquery.knob.js';
$jsArray[] = JS_URL.'/themeJs/plugins/daterangepicker/daterangepicker.js';
$jsArray[] = JS_URL.'/themeJs/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js';
$jsArray[] = JS_URL.'/themeJs/plugins/iCheck/icheck.min.js';
$jsArray[] = JS_URL.'/themeJs/plugins/slimScroll/jquery.slimscroll.js';
$jsArray[] = JS_URL.'/themeJs/my-app.js';
$jsArray[] = JS_URL.'/jquery.fancybox.js';

if($loginFlag == '1' && $idleWidget){
  $jsArray[] = JS_URL.'/idle/jquery.idletimeout.js';
  $jsArray[] = JS_URL.'/idle/jquery.idletimer.js';
}
//DataTables
$jsArray[] = JS_URL.'/themeJs/plugins/datatables/jquery.dataTables.js';
$jsArray[] = JS_URL.'/themeJs/plugins/datatables/dataTables.bootstrap.js';
$jsArray[] = JS_URL.'/themeJs/plugins/datatables/ColVis.js';
$jsArray[] = JS_URL.'/my_datatable_helpers.js';

if( $pageURL == WALL_URL || check_string_existence($pageURL, WALL_IMAGE_URL) > 0 ) {
  $wallJsArray = array();
  $wallJsArray[] = JS_URL.'/accurate-image/application.js?v='.CURRENT_JS_VERSION;
  $wallJsArray[] = JS_URL.'/accurate-image/window_events.js?v='.CURRENT_JS_VERSION;
  $wallJsArray[] = JS_URL.'/accurate-image/jquery.contextMenu.js?v='.CURRENT_JS_VERSION;
  $wallJsArray[] = JS_URL.'/accurate-image/json_data.js?v='.CURRENT_JS_VERSION;
  $wallJsArray[] = JS_URL.'/accurate-image/accurate_image_events.js?v='.CURRENT_JS_VERSION;
  $wallJsArray[] = JS_URL.'/accurate-image/accurate_image.js?v='.CURRENT_JS_VERSION;


  $wallJsArray[] = JS_URL.'/accurate-image/html2canvas.js?v='.CURRENT_JS_VERSION;
  $wallJsArray[] = JS_URL.'/accurate-image/user.js?v='.CURRENT_JS_VERSION;
  $wallJsArray[] = JS_URL.'/accurate-image/user_events.js?v='.CURRENT_JS_VERSION;
  $wallJsArray[] = JS_URL.'/accurate-image/iscroll.js?v='.CURRENT_JS_VERSION;
  $wallJsArray[] = JS_URL.'/accurate-image/common.js?v='.CURRENT_JS_VERSION;

  if($pageURL == WALL_IMAGE_URL){
    $wallJsArray[] = JS_URL.'/accurate-image/initialize_image.js?v='.CURRENT_JS_VERSION;
  }else{
    $wallJsArray[] = JS_URL.'/accurate-image/initialize.js?v='.CURRENT_JS_VERSION;
  }

  echo cache_js_files($wallJsArray,'wall.js.php');
}
else {
  echo cache_js_files($jsArray,'bootstap_datatables.js.php');

  if( $pageURL == 'dashboard' ) {
    //AdminLTE App
    $jsArray2   = array();
    $jsArray2[] = JS_URL.'/themeJs/AdminLTE/app.js';
    $jsArray2[] = JS_URL.'/themeJs/AdminLTE/dashboard.js';
    echo cache_js_files($jsArray2,'bootstap_dashboard.js.php');
  }
}

?>

<script>
function reloadGrid(){
	try{
		<?php if($table_id != ''){?>
		<?php echo $table_id;?>.fnReloadAjax();
		<?php }?>
	}catch(e){}
}
</script>
</body>
</html>