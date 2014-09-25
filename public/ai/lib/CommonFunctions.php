<?php
/**
 * Description : This file used to define all common functions
 * @author 		: rasingh - Q3tech
 * @created on 	: Aug 25, 2014
 * @modified on : Aug 25, 2014
 */
    function check_query_string()
	{
		return false;
	}
	// This function is used to translate in other language
	function t($string,$debug = false){
		$lang_code       = SITE_LANGUAGE;
		$translation_set = $_SESSION['TRANSLATION_SET']; //set during login
		$string         = trim($string);
		$string = preg_replace('/\s+/', ' ', trim($string));
		if($lang_code == ''){
			$lang_code = 'en';
		}
		if($debug){
		  echo strtolower($string).'--'.$string.'--'.SITE_LANGUAGE.'--'.
		  isset($translation_set[$lang_code][strtolower(($string))]).'---'.
		  trim(utf8_encode($translation_set[$lang_code][strtolower($string)]));
		  die;
		}
		if(isset($translation_set[$lang_code][strtolower($string)])){
		 return trim(utf8_encode($translation_set[$lang_code][strtolower($string)]));
		}
		return $string ;
	}


	/*This function is used for debuggin purpose*/
	function pr($val){
		if(is_array($val) or is_object($val)){
			echo '<pre>';
			print_r($val);
			echo '</pre>';
		}
		else{
			echo '<pre>'.$val.'</pre>';
		}
	}

	/* This function is used to sidplay 404 error message*/
	function show_404_page(){
		return 'controller/missing.php';
	}

	/* This function is used return time equivalent of a date*/
	function strtotime_q3($val){
		if(strpos($val, '-') !== FALSE){
			return strtotime($val);
		}else{
		 $arr = explode('/', $val);
		 if(count($arr) != 3){
			 return false;
		 }
		 $date = $arr[2].'-'.$arr[1].'-'.$arr[0];
		 return strtotime($date);
		}
	}

	/* This function is used to validate numeric value */
	function check_numeric_value($value) {
		return is_numeric($value);
	}

	/* This function is used to validate alpha-numeric value */
	function check_alphanumeric_value($value) {
		$value = preg_replace('!\s+!', '', $value);
		return ctype_alnum($value);
	}

	/* This function is used to validate alphabetic value */
	function check_alphabetic_value($value) {
		$value = preg_replace('!\s+!', '', $value);
		return ctype_alpha($value);
	}

	/* This function is used to validate phone numberic */
	function check_phone_number_value($value) {
		return preg_match("/^[0-9\+_\-\s\.\(\)]+$/i", $value);

	}

	/* This function is used to validate multi phone numberic */
	function check_multi_phone_number_value($value) {
		return preg_match("/^[a-zA-Z0-9\+_\-\s\.\(\)]+$/i", $value);
	}

	/**
	 * This function is used to validate email address
	 * @param string $value
	 * @param int $mode (1 = to not check empty $value, 2 = to check emptiness of $value)
	 * @return void
	 */
	function check_email_value($value, $mode=1) {
		if($mode == 2) {
			if(empty($value)) {
				return TRUE;
			}
		}
		return filter_var($value, FILTER_VALIDATE_EMAIL);
	}

	/* This function is used to validate uploaded file */
	function check_file_upload($file_array) {
		$global_allowed_file_types = $GLOBALS['global_allowed_file_types'];
		$max_size = ini_get('upload_max_filesize');
		$max_size_array = explode('M', $max_size);
		$flag = false;
		if (count($max_size_array) == 2) {
			$flag = true;
			$max_file_size = $max_size_array[0] * 1024 * 1024;
		}
		if (!$flag) {
			$max_size_array = explode('G', $max_size);
			if (count($max_size_array) == 2) {
				$flag = true;
				$max_file_size = $max_size_array[0] * 1024 * 1024 * 1024;
			}
		}
		if (!$flag) {
			$max_file_size = 2 * 1024 * 1024;
		}

		$type = $file_array['type'];
		$size = $file_array['size'];
		$error = $file_array['error'];
		if (!in_array($type, $global_allowed_file_types)) {
			return '2';
		}
		if ($size > $max_file_size) {
			return '3';
		}
		if ($error) {
			return '4';
		}
		return '1';
	}

	/* This function is used to validate date value*/
	function validate_date_value($value) {
		$date_explode = explode('/', $value);
		if (count($date_explode) == 3) {
			if(is_numeric($date_explode[1]) && is_numeric($date_explode[2])
			&& is_numeric($date_explode[0])){
			return checkdate($date_explode[1], $date_explode[0], $date_explode[2]);
			}else{
				return FALSE;
			}
		} else {
			return FALSE;
		}
		return FALSE;
	}

	/* This function is used to validate image path */
	function validate_img_url($url) {
		if(!filter_var($url, FILTER_VALIDATE_URL)){
		   return FALSE;
		 }
		else{
		 $file_name = basename($url);
		 if(strpos($file_name, '.') !== FALSE){
		   return true;
		 }else{
		   return false;
		 }
		}
	}

	if (!function_exists('check_dependency')) {
		/* This function is used to validate server site configuration */
		function check_dependency() {
			if (DEPENDENCY_CHECK === FALSE) {
				return TRUE;
			}
			$db_obj = $GLOBALS['db_obj'];
			$return = TRUE;
			$errors = '';
			if (strstr(PHP_OS, 'Linux') == FALSE) {
				$err_str = '<p>Your current operating system is
					' . PHP_OS . '.
						Required Operating System: ' . OPERATING_SYSTEM . '.</p>';
				if (empty($errors)) {
					$errors = $err_str;
				} else {
					$errors .= $err_str;
				}
			}
			$current_php_version = floatval(phpversion());
			$need_php_version = floatval(PHPVERSION);
			if (version_compare($need_php_version, $current_php_version) < 0) {
				$err_str = '<p>Your current PHP version is
					' . $current_php_version . '.
						Required PHP Version: ' . $need_php_version . '
							or greater.</p>';
				if (empty($errors)) {
					$errors = $err_str;
				} else {
					$errors .= $err_str;
				}
				$return = FALSE;
			}
			if (!class_exists('Memcache')) {
				$err_str = '<p>Memcache is not enabled on your server.</p>';
				if (empty($errors)) {
					$errors = $err_str;
				} else {
					$errors .= $err_str;
				}
				$return = FALSE;
			}
			if (_is_curl_enabled() == false) {
				$err_str = '<p>Curl is not enabled on your server.</p>';
				if (empty($errors)) {
					$errors = $err_str;
				} else {
					$errors .= $err_str;
				}
				$return = FALSE;
			}
			$current_mysqli_version = intval($db_obj->get_mysql_version());
			if ($current_mysqli_version < MYSQLIVERSION) {
				$err_str = '<p>Your current MySqli version is
					' . $db_obj->get_mysql_version_info() . '.
						Required Mysqli Version: ' . MYSQLIVERSION_MAJOR_MINOR . '
							or greater.</p>';
				if (empty($errors)) {
					$errors = $err_str;
				} else {
					$errors .= $err_str;
				}
				$return = FALSE;
			}
			if (_check_mod_rewrite_enabled() == false) {
				$err_str = '<p>Enable Mod rewrite.</p>';
				if (empty($errors)) {
					$errors = $err_str;
				} else {
					$errors .= $err_str;
				}
				$return = FALSE;
			}
			if (_is_zip_loaded() == false) {
				$err_str = '<p>Zip extension is not enabled.</p>';
				if (empty($errors)) {
					$errors = $err_str;
				} else {
					$errors .= $err_str;
				}
				$return = FALSE;
			}

			$session = array(
				'error' => $errors,
				'return' => $return
			);
			$_SESSION['dependency_res'] = $session;
			return $return;
		}

	}

	if (!function_exists('_is_curl_enabled')) {
		/*
		 * Function to check curl is enabled on the server
		 * @param none
		 * @return Bool
		 */

		function _is_curl_enabled() {
			if (in_array('curl', get_loaded_extensions())) {
				return true;
			} else {
				return false;
			}
		}

	}

	if (!function_exists('_is_zip_loaded')) {
		/*
		 * Function to check curl is enabled on the server
		 * @param none
		 * @return Bool
		 */

		function _is_zip_loaded() {
			if (in_array('zip', get_loaded_extensions())) {
				return true;
			} else {
				return false;
			}
		}

	}

	if (!function_exists('_check_mod_rewrite_enabled')) {

		function _check_mod_rewrite_enabled() {
			if (function_exists('apache_get_modules')) {
				$modules = apache_get_modules();
				if (in_array('mod_rewrite', $modules)) {
					return TRUE;
				} else {
					return FALSE;
				}
			} else {
				return getenv('HTTP_MOD_REWRITE') == 'On' ? true : false;
			}
		}

	}

	if (!function_exists('convert_str_to_date')) {

		function convert_str_to_date($str) {
			$date_str = trim($str);
			list($d, $m, $y) = explode('/', $date_str);
			$mk = mktime(0, 0, 0, intval($m), intval($d), intval($y));
			$date = strftime('%Y-%m-%d', $mk);
			return $date;
		}

	}

	if (!function_exists('get_formatted_dwelling_unit_no')) {

		function get_formatted_dwelling_unit_no($plot_number) {
			$len = strlen($plot_number);
			if ($len >= 3) {
				return $plot_number;
			} else if ($len == 2) {
				return '0' . $plot_number;
			} else {
				return '00' . $plot_number;
			}
		}

	}

	/* This function is used to display error message */
	function mr($msg = '*', $class="reqField") {
		return '<span class="'.$class.'">' . $msg . '</span>';
	}

	/* This function is used to logged in user id */
	function get_user_id() {
		return $_SESSION['USER_ID'];
	}

	/* This function is used to validate date format */
	function valid_date($date) {
		return (preg_match("/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/", $date));
	}



	/**
	 * Is a Natural number, but not a zero  (1,2,3, etc.)
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	function is_natural_no_zero($str) {
		if (!preg_match('/^[0-9]+$/', $str)) {
			return FALSE;
		}

		if ($str == 0) {
			return FALSE;
		}

		return TRUE;
	}

	/**
	 * Is a Natural number (0,1,2,3, etc.)
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	function is_natural($str) {
		return (bool) preg_match('/^[0-9]+$/', $str);
	}


	/*This function is used to convert object into array */
	function convert_to_array(&$object,$key){
		$key = $key;
	  (array)$object;
	}

	// $dt1 and $dt2 can be any valid date string that DateTime accepts
	// the time zone shouldn't affect anything (since $dt1 and $dt2 use
	// same zone),
	// but you can override the default
	function daysdiff($dt1, $dt2, $time_zone = 'Europe/Dublin') {
	  $t_zone = new DateTimeZone($time_zone);

	  $dt1 = new DateTime($dt1, $t_zone);
	  $dt2 = new DateTime($dt2, $t_zone);

	  // use the DateTime datediff function IF we have a non-buggy version
	  // there is a bug in many Windows implementations that diff() always
	  // returns 6015
	  if( $dt1->diff($dt1)->format("%a") != 6015 ) {
		return $dt1->diff($dt2)->format("%a");
	  }

	  $y1 = $dt1->format('Y');
	  $y2 = $dt2->format('Y');
	  $z1 = $dt1->format('z');
	  $z2 = $dt2->format('z');

	  $diff = intval($y1 * 365.2425 + $z1) - intval($y2 * 365.2425 + $z2);

	  return $diff;
	}

	/* This function used to write log into the file */
	function write_log_file($data = null) {
		$mypath= CUSTOMDIR."/log";
		@chmod($mypath, 0777,TRUE);
		$filename = $mypath.'/log2.txt';
		$somecontent = "************** Log created at : "
		.date("d/m/Y H:i:s")." **************\n\n";
		if(!empty($data)) {
			if(is_array($data)) {
			 $somecontent .= serialize($data);
			} else if(isBoolean($data) === TRUE) {
				$somecontent .= print_r($data, true);
			}
			else {
				$somecontent .= $data;
			}
		}

		$somecontent .= "\n\n******************************* LOG END ******
		***********************\n\n";
		if ($handle = fopen($filename, 'a')) {
			@fwrite($handle, $somecontent);
			fclose($handle);
		}
	}

	/*
	* This function is used to take database backup
	* @param	string $db_name as database name
	* @param	string $storage_dir as define storage directory
	* @return	null
	*/
	function take_db_backup($db_name,$storage_dir){
	  $file_name = $storage_dir.'/'.$db_name.'.sql';
	  $system_call = 'mysqldump --host='.DB_SERVER.' --user='.DB_USERNAME.' --password='.DB_PASSWORD.' --port='.DB_PORT
	  .' --protocol=TCP --routines '.$db_name.' > '.$file_name;
	  exec($system_call);
	}

	/* This function used to valid boolean value */
	function is_boolean($var) {
		if(is_bool($var)) {
			if($var === TRUE || $var === FALSE) {
				return TRUE;
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}

	/*This function is used to check existence of a specific value
	in multi-dimentional array*/
	function check_nested_array_value($arr,$column,$value,$type_col = '',$type_val = ''){
		if(is_array($arr) && count($arr)){
			foreach ($arr as $record) {
				if(strtolower($record[$column]) == strtolower($value)){
				   if($type_col != '' && $type_val != '') {
					 if($record[$type_col] == $type_val){
						return $record;
					 }
				   }else{
					 return $record;
				   }
				}
			}
		}
		return false;
	}

	/* This function used to get php version */
	function get_php_version() {
		return phpversion();
	}

	/* This function used to valid php version */
	function validate_php_version($php_version) {
		if(REQUIRED_PHP_VERSION <= $php_version) {
			return TRUE;
		} else {
			return ERROR_MSG_201;
		}
	}

	/* This function used to get mysql detail */
	function get_mysql_info() {
		return mysqli_get_server_info();
	}

	/* This function used to valid writable file or folder */
	function validate_writable_file_folder($value) {
		$path = $value;
		if(is_writable('../'.$path)) {
			return TRUE;
		} else {
			$component_expl = explode('/', $value);
			$component_name = end($component_expl);
			return $component_name.' should be writable';
		}
	}

	/* This function used to validate curl enable / disable */
	function validate_curl(){
		$status = function_exists('curl_version');
		if($status !== TRUE) {
		   $status = 'Curl should be enable';
		}
		return $status;
	}

	/* This function used to validate php cli */
	function validate_php_cli() {
		$return = exec('PHP -f "'.getcwd().'\check-cli.php"');
		if($return == 'ok') {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	/* This function used to set temp session value */
	function set_temp_session($key, $value) {
		$_SESSION[$key] = $value;
	}

	/* This function used to get temp session value and delete */
	function get_temp_session($key) {
		if(isset($_SESSION[$key]) && isAjaxRequest() == FALSE) {
			$value = $_SESSION[$key];
			unset($_SESSION[$key]);
			return $value;
		} else {
			return '';
		}
	}

	/**
	 * Session Value
	 *
	 * Get the value of session if it is set
	 *
	 * @access  public
	 * @param   session_name    string
	 * @return  string
	 */
	if (!function_exists('get_session_value')) {

		function get_session_value($session_name) {
			if(isset($_SESSION[$session_name])) {
				return $_SESSION[$session_name];
			} else {
				return NULL;
			}
		}

	}

	/* This function used to encode values into utf8 */
	function encode_items_to_UTF8(&$item, $key){
		$key = $key;
	 if(!preg_match('!!u', $item)){
	  $item = utf8_encode($item);
	 }
	}

	/* This function used to encode json into array */
	function encode_json_array($input){
	 array_walk_recursive($input, 'encode_items_to_UTF8');
	 return $input;
	}

	/* This function used to validate timestampencode json into array */
	function is_timestamp($timestamp){
		if(strtotime(date('Y-m',$timestamp))<0){
			return false;
		}
		return true;
	}

	  /**
	  * Delete old cached files
	  * @param $file string File name to be deleted
	  * @return void
	  */
	  function delete_old_cache_file($file) {
		  @unlink($file);
	  }

	  /**
	  * Cache JS files
	  * @param $js_files_array array Name of files
	  * @param $single_file_name string Name of cached file
	  * @param $web_url string Web URL of the file
	  * @param $physical_path string Physical location
	  * @return string  Returns script tags of files
	  */
	  function cache_js_files($js_files_array,$single_file_name = '',
	  $web_url = JS_URL,$physical_path = JS_PHYSICAL_PATH){
		if(!CACHE_SITE){
			return include_js_file($js_files_array);
		}else{
		//delete previous cache files if clear cache request found
		 if(isset($_REQUEST['clear-cc']) && $_REQUEST['clear-cc'] == '1'){
		   delete_old_cache_file(CACHE_PHYSICAL_PATH.'/'.$single_file_name);
		 }
		 if(@file_exists(CACHE_PHYSICAL_PATH.'/'.$single_file_name)){
			 return include_js_file(CACHE_WEB_PATH.'/'.$single_file_name);
		 }
		 else{
		  if(!is_dir(CACHE_PHYSICAL_PATH)){
			mkdir(CACHE_PHYSICAL_PATH, 0777 );
		  }
		  $js = '';

		  foreach ($js_files_array as $file) {
			$file = str_replace($web_url, $physical_path, $file);
			$js .= file_get_contents($file).PHP_EOL;
		  }
		  include_once VENDOR_PHYSICAL_PATH.'minifier/JShrink.php';
		  $js = Minifier::minify($js);
		  delete_old_cache_file(CACHE_PHYSICAL_PATH.'/'.$single_file_name);
		  file_put_contents(CACHE_PHYSICAL_PATH.'/'.$single_file_name,
		  add_gz_string('text/javascript').$js);
		  return include_js_file(CACHE_WEB_PATH.'/'.$single_file_name);
		 }
		}
	  }

	  /**
	  * Cache CSS files
	  * @param $css_files_array array Name of files
	  * @param $single_file_name string Name of cached file
	  * @param $web_url string Web URL of the file
	  * @param $physical_path string Physical location
	  * @return string  Returns link tag of files
	  */
	  function cache_css_files($css_files_array,$single_file_name = '',
	  $web_url = CSS_URL,$physical_path = CSS_PHYSICAL_PATH){
		if(!CACHE_SITE || is_IE_browser()){
			return include_css_file($css_files_array);
		}else{
		//delete previous cache files if clear cache request found
		 if(isset($_REQUEST['clear-cc']) && $_REQUEST['clear-cc'] == '1'){
		   delete_old_cache_file(CACHE_PHYSICAL_PATH.'/'.$single_file_name);
		 }
		 if(@file_exists(CACHE_PHYSICAL_PATH.'/'.$single_file_name)){
			 return include_css_file(CACHE_WEB_PATH.'/'.$single_file_name);
		 }
		 else{
		  if(!is_dir(CACHE_PHYSICAL_PATH)){
			mkdir(CACHE_PHYSICAL_PATH, 0777 );
		  }
		  $css = '';
		  foreach ($css_files_array as $file) {
			$file = str_replace($web_url, $physical_path, $file);
			$css .= file_get_contents($file).PHP_EOL;
		  }
		  include_once VENDOR_PHYSICAL_PATH.'minifier/cssmin-v3.0.1-minified.php';
		  $css = CssMin::minify($css);
		  delete_old_cache_file(CACHE_PHYSICAL_PATH.'/'.$single_file_name);
		  file_put_contents(CACHE_PHYSICAL_PATH.'/'.$single_file_name,
		  add_gz_string('text/css').$css);
		  return include_css_file(CACHE_WEB_PATH.'/'.$single_file_name);
		 }
		}
	  }

	  function add_gz_string($type = 'text/css'){
		  $gzStr  = '<?php '.PHP_EOL;
		  $gzStr .= 'ob_start ("ob_gzhandler");'.PHP_EOL;
		  $gzStr .= 'header("Content-type: '.$type.'; charset: UTF-8");'.PHP_EOL;
		  $gzStr .= '//get the last-modified-date of this very file'.PHP_EOL;
		  $gzStr .= '$lastModified = filemtime(__FILE__);'.PHP_EOL;
		  $gzStr .= '//get a unique hash of this file (etag)'.PHP_EOL;
		  $gzStr .= '$etagFile = md5_file(__FILE__);'.PHP_EOL;
		  $gzStr .= '$etagHeader=(isset($_SERVER["HTTP_IF_NONE_MATCH"]) ?
		  trim($_SERVER["HTTP_IF_NONE_MATCH"]) : false);'.PHP_EOL;
		  $gzStr .= '//set last-modified header'.PHP_EOL;
		  $gzStr .= 'header("Last-Modified: ".gmdate("D, d M Y H:i:s", $lastModified)." GMT");'.PHP_EOL;
		  $gzStr .= '//set etag-header'.PHP_EOL;
		  $gzStr .= 'header("Etag: $etagFile");'.PHP_EOL;
		  $gzStr .= '//make sure caching is turned on'.PHP_EOL;
		  $gzStr .= 'header("Cache-Control: public");'.PHP_EOL;

		  $gzStr .= '//check if page has changed. If not, send 304 and exit'.PHP_EOL;
		  $gzStr .= 'if (@strtotime($_SERVER["HTTP_IF_MODIFIED_SINCE"])==$lastModified ||
		  $etagHeader == $etagFile){'.PHP_EOL;
		   $gzStr .= 'header("HTTP/1.1 304 Not Modified");'.PHP_EOL;
		   $gzStr .= 'exit;'.PHP_EOL;
		  $gzStr .= '}'.PHP_EOL;
		  $gzStr .= '?> '.PHP_EOL;
		  return $gzStr;
	  }

	  /* This function used to include all css files */
	  function include_css_file($files){
		 $css = '';
		 if(is_array($files) && count($files)){
			 foreach ($files as $file) {
			   $css .= '<link
			   rel="stylesheet" type="text/css" href="'.$file.'" />'.PHP_EOL;
			 }
		 }else{
			$css .= '<link
			   rel="stylesheet" type="text/css" href="'.$files.'" />'.PHP_EOL;
		 }
		 return $css;
	  }

	  /* This function used to include all js files */
	  function include_js_file($files){
		 $script = '';
		 if(is_array($files) && count($files)){
			 foreach ($files as $file) {
			   $script .= '<script
			   src="'.$file.'" type="text/javascript"></script>'.PHP_EOL;
			 }
		 }else{
			$script = '<script
				src="'.$files.'" type="text/javascript"></script>'.PHP_EOL;
		 }
		 return $script;
	  }

	  /* This function used to add error message in html formate */
	function design_dyn_error_fields(&$item){
	   $item = '<li>'.$item.'</li>';
	}

	/* This function used convert all error message from array to string */
	function design_dyn_error_string($arr){
	 array_walk_recursive($arr, 'design_dyn_error_fields');
	 return $arr;
	}

	/* This function used to validate IE browser */
	function is_IE_browser(){
	  preg_match('/MSIE (.*?);/', $_SERVER['HTTP_USER_AGENT'], $matches);
	  if(count($matches)<2){
		preg_match('/Trident\/\d{1,2}.\d{1,2}; rv:([0-9]*)/',
		$_SERVER['HTTP_USER_AGENT'], $matches);
	  }
	  return count($matches);
	}

	/* This function used to validate float value */
	function validate_float($value){
	  if (filter_var($value, FILTER_VALIDATE_FLOAT)){
		  return true;
	  }else{
		  return false;
	  }
	}

	/* This function used to validate time */
	function validate_time($value){
		$r = preg_match("/(2[0-3]|[01][0-9]):[0-5][0-9]/", $value); // 24hr
		return $r;
	}

	/* This function used to display search box html */
	function display_search_box($search2){
		?>
		<form id="commonSearchFrm" onsubmit="return false">
		<div class="searchrecords">
				<strong>
				<?php echo t('Search')?>:</strong> &nbsp;<input type="text"
				name="search" id="searchbox"
				value="<?php echo $search2; ?>" />&nbsp;
				<input type="image" name="searchbtn" id="searchbtn" src="
				<?php echo IMAGE_URL?>/search.png" />
			</div>
		</form>
		<?php
	}

	/* This function used to validate entered js */
	function validate_input_js() {
		$js_array   = array();
		$js_array[] = JS_URL.'/validations.js';
		echo cache_js_files($js_array);
	}

	/*THIS FUNCTION IS USED TO CREATE COMMA SEPARATED LIST*/
	function create_comma_separated_list($arr,$column,$mode = 1,$quotes = 1){
	  $return = '';

	  if(is_array($arr) and count($arr)){
		foreach ($arr as $value) {
			if($return!=''){
				$return .= ',';
			}
			if($mode == '2'){
			  $value = (array)$value;
			  if($quotes){
			   $return .= '"'.$value[$column].'"';
			  }else{
				$return .= $value[$column];
			  }
			}else{
				if($quotes){
				 $return .= '"'.$value.'"';
				}else{
				 $return .= $value;
				}
			}
		}
	  }
	  return $return;
	}

	/*THIS FUNCTION IS USED TO SHOW "..." IF MAX LENGTH EXCEEDS*/
	function show_ellipse($value,$maxLength,$truncate = 3){
		if(strlen($value)<=$maxLength){
			return $value;
		}else{
			return substr($value,0, $maxLength - $truncate).'...';
		}

	}

	/*
	* THIS FUNCTION IS USED TO ADD  CSS & JS FILES REQUIRED FOR BLUEIMP OPERATION
	*/
	function add_blueimp_css_js(){
		$css_array   = array();
		$css_array[] = VENDOR_URL.'blueimp/css/jquery.fileupload.css';
		echo include_css_file($css_array);
		$js_array   = array();
		$js_array[] = VENDOR_URL.'blueimp/js/vendor/jquery.ui.widget.js';
		$js_array[] = VENDOR_URL.'blueimp/js/jquery.iframe-transport.js';
		$js_array[] = VENDOR_URL.'blueimp/js/jquery.fileupload.js';
		echo cache_js_files($js_array,'blueimp.js.php',VENDOR_URL,
		VENDOR_PHYSICAL_PATH);
	}

	function check_string_existence($input_str, $search_str) {
		return strlen(strstr($input_str, $search_str));
	}

?>

