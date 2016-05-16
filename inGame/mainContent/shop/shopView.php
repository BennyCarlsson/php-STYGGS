<?php

Class ShopView{
	public static $idSession = "idSession";
	
	public function getHTML($errorMessage){
		$html = "
				<p>$errorMessage</p>
				<p>Price: 10 Cash Each</p>
				<form method='POST'>
					Followers: <input name='number' type='number'>
					<input type='submit' value='Buy' name='buyFollowersBtn'>
				</form>
				<p>Use Followers to do random missions or Clan missions!</p>
				";
			return $html;
	}
	public function checkBuyButton(){
		if(isset($_POST['buyFollowersBtn'])){
			return TRUE;
		}
		return FALSE;
	}
	public function getNumber(){
		if(isset($_POST['number'])){
			return $_POST['number'];
		}
		ECHO "SOMETHIGN WHENT WONG YES!";
	}
	public function getUserId(){
		return $_SESSION[self::$idSession];
	}
	
}
