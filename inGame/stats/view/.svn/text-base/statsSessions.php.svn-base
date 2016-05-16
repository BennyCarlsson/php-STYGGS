<?php

Class StatsSessions{
	
	private static $nameSession = "nameSession";
	private static $idSession = "idSession";
	private static $moneySession = "moneySession";
	private static $lvlSession = "lvlSessions";
	private static $xpSession = "xpSession";
	private static $followersSession = "followersSession";
	private static $dailyMissionsRemainingSession = "dailymissionsRemainingSession";
	private static $clanSession = "clanSession";
	
	public function getUserId(){
		$userId = $_SESSION[self::$idSession];
		return $userId; 
	}
	
	public function getUsername(){
		$username = $_SESSION[self::$nameSession];
		return $username;
	}
	
	public function getLevel(){
		return $_SESSION[self::$lvlSession];
	}
	
	public function getMoney(){
		return $_SESSION[self::$moneySession];
	}
	
	public function getXp(){
		return $_SESSION[self::$xpSession];
	}
	
	public function getFollowers(){
		return $_SESSION[self::$followersSession];
	}
	
	public function createStatsSessions($money, $lvl, $xp, $followers, $dailyMissionsRemaining,$clanName){
		$_SESSION[self::$moneySession] = $money;
		$_SESSION[self::$lvlSession] = $lvl;
		$_SESSION[self::$xpSession] = $xp;
		$_SESSION[self::$followersSession] = $followers;
		$_SESSION[self::$dailyMissionsRemainingSession] = $dailyMissionsRemaining;
		$_SESSION[self::$clanSession] = $clanName;
	}
}