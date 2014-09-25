<?php
//calculate IDLE time settings
$idleWidget = FALSE;
if(ENABLE_IDLE_TIME_OUT){
	$idleTime = $gcm = ini_get('session.gc_maxlifetime');
	if($gcm!=''){
	  $idleWidget = TRUE;
	  if( ($gcm/120) > 10){
	  	 $idleTime = $gcm - 60;
	  }
	  $pollingInterval = ceil($gcm/4);
	}
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
<title><?php
echo $utility_obj->get_page_name($pageURL,1);
$login_flag = $login->is_user_logged_in();
?></title>
<!-- meta -->
<meta name="description" content="<?php echo $meta_description;?>" />
<meta name="keywords" content="<?php echo $meta_keyword;?>" />
<meta name="page-topic" content="<?php echo $meta_title;?>" />

<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<?php
 if($_REQUEST['fancy'] != '1'){
	$cssArray[] = CSS_URL.'/bootstrap.min.css';
	$cssArray[] = CSS_URL.'/font-awesome.min.css';
	$cssArray[] = CSS_URL.'/ionicons.min.css';
	$cssArray[] = CSS_URL.'/morris/morris.css';
	$cssArray[] = CSS_URL.'/jvectormap/jquery-jvectormap-1.2.2.css';
	$cssArray[] = CSS_URL.'/fullcalendar/fullcalendar.css';
	$cssArray[] = CSS_URL.'/daterangepicker/daterangepicker-bs3.css';
	$cssArray[] = CSS_URL.'/datatables/dataTables.bootstrap.css';
	$cssArray[] = CSS_URL.'/datatables/ColVis.css';
	$cssArray[] = CSS_URL.'/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css';
	$cssArray[] = CSS_URL.'/fonts.css';
	$cssArray[] = CSS_URL.'/font_kaushan.css';
	$cssArray[] = CSS_URL.'/AdminLTE.css';
	$cssArray[] = CSS_URL.'/custom.css';
	$cssArray[] = CSS_URL.'/jquery-ui.css';
	$cssArray[] = CSS_URL.'/jquery.fancybox.css';
 }else{
 	$cssArray[] = CSS_URL.'/bootstrap.min.css?v=1&f=1';
	$cssArray[] = CSS_URL.'/font-awesome.min.css?v=1&f=1';
	$cssArray[] = CSS_URL.'/ionicons.min.css?v=1&f=1';
	$cssArray[] = CSS_URL.'/morris/morris.css?v=1&f=1';
	$cssArray[] = CSS_URL.'/jvectormap/jquery-jvectormap-1.2.2.css?v=1&f=1';
	$cssArray[] = CSS_URL.'/fullcalendar/fullcalendar.css?v=1&f=1';
	$cssArray[] = CSS_URL.'/daterangepicker/daterangepicker-bs3.css?v=1&f=1';
	$cssArray[] = CSS_URL.'/datatables/dataTables.bootstrap.css?v=1&f=1';
	$cssArray[] = CSS_URL.'/datatables/ColVis.css?v=1&f=1';
	$cssArray[] = CSS_URL.'/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css?v=1&f=1';
	$cssArray[] = CSS_URL.'/fonts.css?v=1&f=1';
	$cssArray[] = CSS_URL.'/font_kaushan.css?v=1&f=1';
	$cssArray[] = CSS_URL.'/AdminLTE.css?v=1&f=1';
	$cssArray[] = CSS_URL.'/custom.css?v=1&f=1';
	$cssArray[] = CSS_URL.'/jquery-ui.css?v=1&f=1';
	$cssArray[] = CSS_URL.'/jquery.fancybox.css?v=1&f=1';
 }
if($login_flag == '1' && $idleWidget){
    $cssArray[] = CSS_URL.'/idle/idle.css';
}
if(!CACHE_SITE || is_IE_browser()){
  $cssArray[] = CSS_URL.'/nocache.css';
}

if($pageURL == WALL_URL || check_string_existence($pageURL, WALL_IMAGE_URL) > 0 ){
  $wallCssArray = array();
  $wallCssArray[] = CSS_URL.'/accurate-image/bootstrap.min.css?v='.CURRENT_CSS_VERSION; // Core CSS
  $wallCssArray[] = CSS_URL.'/accurate-image/custom.css?v='.CURRENT_CSS_VERSION; // Custom styles
  $wallCssArray[] = CSS_URL.'/accurate-image/media.css?v='.CURRENT_CSS_VERSION; // Media styles
  $wallCssArray[] = CSS_URL.'/accurate-image/font-awesome.css?v='.CURRENT_CSS_VERSION; // Fonts styles
  $wallCssArray[] = CSS_URL.'/accurate-image/accurate_image.css?v='.CURRENT_CSS_VERSION;
  $wallCssArray[] = CSS_URL.'/accurate-image/jquery.contextMenu.css?v='.CURRENT_CSS_VERSION;
  echo cache_css_files($wallCssArray,'wall.css.php',CSS_URL,CSS_PHYSICAL_PATH);
}
else {
	echo cache_css_files($cssArray,'main.css.php',CSS_URL,CSS_PHYSICAL_PATH);
}

//HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries
//WARNING: Respond.js doesn't work if you view the page via file://
?>
<script src="../assets/js/accurate-image/ie10-viewport-bug-workaround.js"></script>
<!--[if lt IE 9]>
 <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
 <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<?php
 //JavaScript
$jsArray   = array();
$jsArray[] = JS_URL.'/themeJs/jquery.min.js';
$jsArray[] = JS_URL.'/themeJs/jquery-ui-1.10.3.min.js';
$jsArray[] = JS_URL.'/jquery-ui.js';
$jsArray[] = JS_URL.'/common.js';
$jsArray[] = JS_URL.'/jquery.nicescroll.js';
echo cache_js_files($jsArray,'header.js.php');

if(is_IE_browser()){
  $jsArray   = array();
  $jsArray[] = JS_URL.'/jquery.placeholder.js';
  echo cache_js_files($jsArray,'placeholder.js.php');
}

?>

<script type="text/javascript">

     var jsURL = '<?php echo URL;?>';
	 var jsImgURL = '<?php echo IMAGE_URL;?>';
     var jsLangCode = '<?php echo $_SESSION["USER_LANGUAGE_CODE"];?>';
     var jsUserName = '<?php echo $_SESSION["USER_NAME"];?>';
     var jsUserCode = '<?php echo $_SESSION["USER_CODE"];?>';
     var js_links_per_page = <?php echo LINKS_PER_PAGE; ?>;
     var js_records_per_page = <?php echo RECORDS_PER_PAGE; ?>;
     var access_denied_msg = '<?php echo ACCESS_DENIED_MESSAGE ?>';
     var ALL_VALUES_SELECT = '<?php echo ALL_VALUES_SELECT; ?>';
     var ALL_VALUES_TEXT  = '<?php echo ALL_VALUES_TEXT; ?>';

	 <?php //JS Lang Constants; ?>
	 var okString = '<?php echo t('Ok');?>';
     var yesString = '<?php echo t('Yes');?>';
     var noString = '<?php echo t('No');?>';
     var saveString = '<?php echo t('Save');?>';
     var cancelString = '<?php echo t('Cancel');?>';

    $(document).ready(function(){
       <?php
       if(is_IE_browser()){
           ?>
           $('input, textarea').placeholder();
           <?php
       }
       ?>
       <?php
         if($login_flag == '1' && $idleWidget){
       ?>
        $.idleTimeout('#idletimeout', '#idletimeout a', {
			idleAfter: <?php echo $idleTime; ?>,
			pollingInterval: <?php echo $pollingInterval?>,
			keepAliveURL: 'keepalive.php',
			serverResponseEquals: 'OK',
			onTimeout: function(){
				$(this).slideUp();
				window.location = jsURL+'logout&idle=1';
			},
			onIdle: function(){
				$(this).slideDown(); // show the warning bar
			},
			onCountdown: function( counter ){
				$(this).find("span").html( counter ); // update the counter
			},
			onResume: function(){
				$(this).slideUp(); // hide the warning bar
			}
		});
       <?php
        }
       ?>
    });

</script>

<!-- url -->
<link rel="bookmark" href="index.php" title="<?php echo t('Masonry Designer');?>" />
<link rel="canonical" href="index.php" />
<!-- icons -->
<link rel="icon" href="favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
</head>
<?php
 $analyticsBG = '';
 $bgPages = array('login',FORGOT_PASSWORD_LINK,RESET_PASSWORD_LINK);
 if(in_array($pageURL, $bgPages)){
   $analyticsBG = 'analyticsBG login-page';
 }else if($pageURL == 'dashboard' || $pageURL == '/dashboard'){
   $analyticsBG = 'home-dashboard';
 }
 $extraClass = $headerDisplay = '';
 if($_REQUEST['fancy'] == '1'){
   $headerDisplay = 'style = "display:none;"';
   $extraClass = 'popup-body';
 }
 $deClass = '';
 if(SITE_LANGUAGE == 'DE'){
   $deClass = 'de-body';
 }
?>
<body class="skin-blue">
<div class="main-container">
<?php
if( $pageURL != WALL_URL && check_string_existence($pageURL, WALL_IMAGE_URL) == 0 ) {
?>
 <header class="header" <?php echo $headerDisplay;?>>
            <a href="<?php echo URL ?>" class="logo" style="float:left !important;">
            <?php
            if(file_exists(IMAGE_PHYSICAL_PATH.'/'.SITE_HEADER_IMG)
            && SITE_HEADER_IMG!='') { ?>
				   <img
                src="<?php echo IMAGE_URL.'/'.SITE_HEADER_IMG;?>"
                title="<?php echo SITE_NAME;?>">
			<?php 	}else { ?>
               <img
                src="<?php echo IMAGE_URL.'/lisa-logo.png';?>"
                title="<?php echo SITE_NAME;?>">
             <?php }  ?>
            </a>
            <?php // Header Navbar: style can be found in header.less ;?>
            <nav class="navbar navbar-static-top" role="navigation">
                <?php //Sidebar toggle button ?>
                <div class="navbar-right">
       			<?php if($login->is_user_logged_in()){?>
       			  <ul class="nav navbar-nav">
				        <?php  echo $topMenuHTML;?>
				   </ul>
                   	 <ul class="nav navbar-nav">
                   	 	 <li class="dropdown user user-menu">
                        <?php // Messages: style can be found in dropdown.less ;?>

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo t('Welcome').' :&nbsp;'.t($_SESSION['USER_NAME']);?>
                                    <i class="caret"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <?php // User image ?>
                                <li class="user-header bg-light-blue">

                                    <p>
                                        <?php echo t($_SESSION['USER_NAME']);?> -
                                        <?php echo t($_SESSION['USER_ROLE_NAME']);?>
                                    </p>
                                </li>
                                <?php // Menu Body ?>

                                <?php // Menu Footer ?>
                                <li class="user-footer">
                                    <div class="pull-left">
                                    	<?php
										 echo link_create(t('Edit Profile'),
										 array('href'=>'user-roles/users/profile-edit&Id='
                              			 .$_SESSION['USER_ID'].'&rurl='.$_SERVER['QUERY_STRING'],
										 'class'=>'btn btn-success'));
										?>
                                   </div>
                                    <div class="pull-right">
                                    	<?php
										 echo link_create(t('Logout'),
										 array('href'=>'logout',
										 'class'=>'btn btn-primary btn-success'));
										?>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        </li>
                    </ul>
                   <?php } ?>
                </div>
            </nav>
        </header>
<?php
}
?>