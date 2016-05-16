<?php

Class eventsDAL {
	
	public function GetCurrentMission()
	{
		$db = new DB();
		$connection = $db -> getCon();
		$result = $connection->query("CALL getActiveEvent()");
		$row = $result->fetch_object();			
		$connection->close();
		return $row;
	}
	
	public function CheckComplete($userId){		
		$db = new DB();
		$connection = $db -> getCon();
		$result = $connection->query("CALL checkEventCompletionOnIds('$userId')");
		$row = $result->fetch_object();			
		$connection->close();
		return $row;
	}
	
	public function MarkComplete($userId){
		$db = new DB();
		$connection = $db -> getCon();
		$connection->query("CALL markDone('$userId')");			
		$connection->close();	
	}
	
	//extra check by benny because of bug
	public function checkIfEventIsDone($userId){
		$db = new DB();
		$connection = $db -> getCon();
		$result = $connection->query("CALL checkEventCompletionOnIds('$userId')");		
		$connection->close();
		if($row = $result->fetch_object() == null){
			return TRUE;
		}	
		return FALSE;
	}
}
