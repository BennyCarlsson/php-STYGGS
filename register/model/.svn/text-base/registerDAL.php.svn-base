<?php

require_once 'db/db.php';

class registerDAL {
	
	public function AddNewUser($email, $username, $password, $salt){
		$db = new db();
		$dbConnection = $db->getCon();
		$dbConnection->query("CALL insertUser('$email', '$username', '$password', '$salt')");
		$dbConnection->close();
		$this->addUserStats($username);
	}
	private function addUserStats($username){
		$id = $this->getUserId($username);
		$db = new db();
		$dbConnection = $db->getCon();
		$dbConnection->query("CALL insertStats('$id',100,1,1,0)");
		$dbConnection->close();
		$this->addUserClanStats($id);
	}
	private function addUserClanStats($id){
		$db = new db();
		$dbConnection = $db->getCon();
		$dbConnection->query("Call insertUserClanStats('$id')");
		$dbConnection->close();
	}
	private function getUserId($username){
		$db = new db();
		$dbConnection = $db->getCon();
		$result = $dbConnection->query("CALL getIdOnUsername('$username')");
		$obj = $result->fetch_object();
		$dbConnection->close();
		return $obj->Id;
	}
	
	//Returns true if the username is taken
	public function CheckIfUsernameExists($username){
		$db = new db();
		$dbConnection = $db->getCon();
		
		$rs = $dbConnection->query("CALL usernameExists('$username')");

		if(mysqli_num_rows($rs) < 1){
			$dbConnection->close();
			return false;
		}
		$dbConnection->close();
		return true;
	}
	
	//Returns true if the email is already in use
	public function CheckIfEmailIsUsed($email){
		$db = new db();
		$dbConnection = $db->getCon();

		$rs2 = $dbConnection->query("CALL emailInUse('$email')");

		if(mysqli_num_rows($rs2) < 1){
			$dbConnection->close();
			return false;			
		}	
		$dbConnection->close();	
		return true;
	}
	
}