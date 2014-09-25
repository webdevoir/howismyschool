<?php
/**
 * This class used to catch site bugs and send mail to admin. this
 * class also create log 
 * @author 		: rasingh - Q3tech
 * @created on 	: Aug 25, 2014
 * @modified on : Aug 25, 2014
 */
interface IException {
	/* Protected methods inherited from Exception class */
	public function getMessage();                 // Exception message
	public function getCode();                    // User-defined Exception code
	public function getFile();                    // Source filename
	public function getLine();                    // Source line
	public function getTrace();                   // An array of the backtrace()
	public function getTraceAsString();           // Formated string of trace
	 
	/* Overrideable methods inherited from Exception class */
	public function __to_string();                 // formated string for display
	public function __construct($message = null, $code = 0);
}

// Extend the built-in exception class and implements IException to throw MySQL-related exceptions
class CustomException extends Exception implements IException {
	protected $message = 'Unknown exception';     		// Exception message
	protected $code    = 0;                       		// User-defined exception code
	protected $file;                              		// Source filename of exception
	protected $line;                              		// Source line of exception
	private   $path_to_exception_file = '../exception.html';	// Path of file to show user incase of exception
	
	/**
	 *
	 * This is a constructor function where variables are intialized automatically
	 * when object is created of this class
	 * @param string $message
	 * @param int $code
	 * @return null
	 */
	public function __construct($message = null, $code = 0){
		if (!$message){
			throw new $this('Unknown '. get_class($this));
		}
		parent::__construct($message, $code);
	}
	 
	/**
	 * Function to override the default method
	 * of Exception class and make customize message.
	 *
	 * @return	$message
	 */
	public function __to_string(){
		$message = "Exception '".__CLASS__ ."' with message '".$this->getMessage()."'";
		$message .= "<br />Source filename of exception : ".$this->getFile()." : at line no. '".$this->getLine()."'";
		return $message;
	}

	/**
	 * Function to show releveant message to user
	 * and send error email to Admin.
	 * @return	$message
	 */
	public function show_exception_message(){
		echo file_get_contents($this->path_to_exception_file);
		$body = $this->__to_string();
		$db_obj = $GLOBALS['db_obj'];
		$this->logger($body);
	}


	/**
	 * Function to build destination email address,
	 * subject and content for sending mail to Admin.
	 *
	 * @param	$body
	 */
	public function send_mail_to_admin($body){
		// Code here
	}

	/**
	 * Function to send mails.
	 *
	 * @param	string $to as destination mail address
	 * @param	string $subject as subject for mail
	 * @param	string $message as content of mail
	 * @return	null
	 */
	public function send($to, $subject, $message){
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		// Additional headers
		$headers .= 'Liquidation Channel <'.ADMIN_MAIL_ADDRESS.'>' . "\r\n";
		// Mail it
		mail($to, $subject, $message, $headers);
	}

	/**
	 * This function is used to add log.
	 *
	 * @param  string $data
	 * @return	null
	 */
	public function logger($data = null) {
		$mypath="../log";
		@chmod($mypath, 0777,TRUE);
		$filename = $mypath.'/log.txt';
		$somecontent = "************** Log created at : ".date("d/m/Y H:i:s")." **************\n\n";
		if(!empty($data)) {
			if(is_array($data)) {
			 $somecontent .= 'is_array';
			}
			else {
				$somecontent .= $data;
			}
		}

		$somecontent .= "\n\n******************************* LOG END *****************************\n\n";
		if ($handle = fopen($filename, 'a')) {
			@fwrite($handle, $somecontent);
			fclose($handle);
		}
	}
}
?>