<?php

class HashAndSalt{
	const saltSize = 10; 
	
	public function GetSalt(){
		$salt = mcrypt_create_iv(self::saltSize, MCRYPT_DEV_RANDOM);
		$saltLeng = strlen($salt);
		return base64_encode($salt);
	}
	
	public function HashPassword($password, $salt){
		$options = array(
		'salt' => $salt,
		);
		
		return crypt($password, $salt);
		//return password_hash($password, PASSWORD_BCRYPT, $options);
	}
}