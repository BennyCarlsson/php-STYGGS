<?php

require_once 'db/db.php';
require_once 'Hashing/HashAndSalt.php';

Class LogInDB{
	private $con;
	private $db;
	private $hashing;
	
	public function __construct(){
		$this -> hashing = new HashAndSalt();
	}
	
	public  function checkUsernameAndPassword($username, $password){
		//db connection
		//$db = new DB();
		//$connection = $db -> getCon();
		
		//check if username/mail exists
		if($this->checkUsernameExist($username))
		{
			//gets the salt for the password @return salted password
			$saltPass = $this->getSaltOnUsername($username, $password);	
		}else if($this->checkMailExist($username)){
			$saltPass = $this->getSaltOnMail($username, $password);
		}
		else{
			//username/mail don't exists
			return false;
		}
		if($this->checkUsernameAndPasswordToDB($username, $saltPass) || $this->checkMailAndPassword($username, $saltPass)){
			return TRUE;
		}
		else{
			return FALSE;	
		}
	}
	private function checkUsernameAndPasswordToDB($username, $saltPass){
		$db = new DB();
		$connection = $db -> getCon();
		$rs = $connection->query("CALL checkUsernameAndPassword('$username', '$saltPass')");
		while($row = $rs->fetch_object()){
			if(isset($row->Id)){
				$connection -> close();
				return true;
			}else{
				$connection -> close();
				return false;
			}
		}
		$connection -> close();
		return false;
	}
	private function checkMailAndPassword($username, $saltPass){
		$db = new DB();
		$connection = $db -> getCon();
		$rs = $connection->query("CALL checkMailAndPassword('$username', '$saltPass')");
		while($row = $rs->fetch_object()){
			if(isset($row->Id)){
				$connection -> close();
				return true;
			}else{
				$connection -> close();
				return false;
			}
		}
		$connection -> close();
		return false;
	}
	
	public function checkUsernameExist($username){
		$db = new DB();
		$connection = $db -> getCon();
		
		$rs = $connection->query("CALL usernameExists('$username')");
		$row =$rs->fetch_object();
		if(isset($row->Id)){
	 		$connection -> close();
		 	return TRUE;
		 }
		$connection -> close();
		return FALSE;
	}
	public function checkMailExist($username){
		$db = new DB();
		$connection = $db -> getCon();
		
		$rs = $connection->query("CALL mailExists('$username')");
		$row =$rs->fetch_object();
		if(isset($row->Id)){
	 		$connection -> close();
		 	return TRUE;
		 }
		$connection -> close();
		return FALSE;
	}
	
	//gets salt and salts password
	private function getSaltOnUsername($username, $password){
		$db = new DB();
		$connection = $db -> getCon();
		
		$rs2 = $connection->query("CALL getSaltOnUsername('$username')");
		while($row = $rs2->fetch_object()){
			$saltat = $row->SALT;
		}
		$connection -> close();
		return $this -> hashing -> HashPassword($password, $saltat);
	}
	private function getSaltOnMail($username, $password){
		$db = new DB();
		$connection = $db -> getCon();
		
		$rs2 = $connection->query("CALL getSaltOnMail('$username')");
		while($row = $rs2->fetch_object()){
			$saltat = $row->SALT;
		}
		$connection -> close();
		return $this -> hashing -> HashPassword($password, $saltat);
	}
	
	public function getIdOnUsername($username){
		if($this->checkUsernameExist($username)){
			$db = new DB();
			$connection = $db -> getCon();
			$result = $connection->query("CALL getIdOnUsername('$username')");
			$obj = $result->fetch_object();
			$connection->close();
			return $obj->Id;	
		}else if($this->checkMailExist($username)){
			$db = new DB();
			$connection = $db -> getCon();
			$result = $connection->query("CALL getIdOnMail('$username')");
			$obj = $result->fetch_object();
			$connection->close();
			return $obj->Id;
		}
		
	}
}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	