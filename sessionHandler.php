<?php
session_start();

require_once 'userObject.php';

Class logInSessionHandler{
		private static $userSession = "userSession";
		private static $loggedInSession = "loggedInSession";
		private static $nameSession = "nameSession";
		private static $mailSession = "mailSession";
		public static $idSession = "idSession";
		public $user;
	
	public function setUserSession(){
		$this->user = new UserObject($_SESSION[self::$idSession]);
	}
	public function getUserObj(){
		return $this->user;
	}
	public function getUserId(){
		$userId = $_SESSION[self::$idSession];
		return $userId; 
	}
	
	public function setIdSession($Id){
		$_SESSION[self::$idSession] = $Id;
	}
	public function setNameSession($username){
		$_SESSION[self::$nameSession] = $username;
	}
	public function destroyNameSession(){
		if(isset($_SESSION[self::$nameSession])){
			unset($_SESSION[self::$nameSession]);
		}
	}
	public function getNameSession(){
		if(isset($_SESSION[self::$nameSession])){
			return $_SESSION[self::$nameSession];	
		}
		return "";
	}
	public function setMailSession($mail){
		$_SESSION[self::$mailSession] = $mail;
		
	}
	public function destroyMailSession(){
		if(isset($_SESSION[self::$mailSession])){
			unset($_SESSION[self::$mailSession]);
		}
	}
	public function getMailSession(){
		if(isset($_SESSION[self::$mailSession])){
			return $_SESSION[self::$mailSession];	
		}
		return "";
	}
	
	//
	public function unsetLoggedInSession(){
		if(isset($_SESSION[self::$loggedInSession])){
			unset($_SESSION[self::$loggedInSession]);
		}
	}
	
	//destroy loggedinsession
	private function destroyLoggedInSession(){
		unset($_SESSION[self::$loggedInSession]);
   		session_destroy();
		//TODO:
		//destroy stats sessions
	}	
	/*
     * create session 
	 * redirect to ingame.php
     */
    public function createLoggedInSession(){
            $_SESSION[self::$loggedInSession] = true; 
            $_SESSION["session_security"] = array();
            $_SESSION["session_security"]["webbläsare"] = $this->getUserAgent();
			header("Location: inGame.php");
    }
    
    /*
     * checks session
     */
    public function checkSession(){
    	if(isset($_SESSION["session_security"]["webbläsare"])){
            if($_SESSION["session_security"]["webbläsare"] == $this->getUserAgent() && isset($_SESSION[self::$loggedInSession]) && $_SESSION[self::$loggedInSession] == true){
            	return true;
            }else {
                    unset($_SESSION[self::$loggedInSession]);
                    session_destroy();
					return false;
            }
		}else{
			return false;	
		}               
    }
    // Magic happens in this function to find out the users browser
    //http://stackoverflow.com/questions/9693574/user-agent-extract-os-and-browser-from-string-php
	private static function getUserAgent(){
    	static $agent = null;

	    if ( empty($agent) ) {
	        $agent = $_SERVER['HTTP_USER_AGENT'];
	
	        if ( stripos($agent, 'Firefox') !== false ) {
	            $agent = 'firefox';
	        } elseif ( stripos($agent, 'MSIE') !== false ) {
	            $agent = 'ie';
	        } elseif ( stripos($agent, 'iPad') !== false ) {
	            $agent = 'ipad';
	        } elseif ( stripos($agent, 'Android') !== false ) {
	            $agent = 'android';
	        } elseif ( stripos($agent, 'Chrome') !== false ) {
	            $agent = 'chrome';
	        } elseif ( stripos($agent, 'Safari') !== false ) {
	            $agent = 'safari';
	        } elseif ( stripos($agent, 'AIR') !== false ) {
	            $agent = 'air';
	        } elseif ( stripos($agent, 'Fluid') !== false ) {
	            $agent = 'fluid';
	        }
	
	    }
	    return $agent;
	}
}












	