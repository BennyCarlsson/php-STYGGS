<?php

require_once('ResetDAL.php');

Class ActionResults{
	private $ResetDAL;
	
	public function __construct(){
		$this -> ResetDAL = new ResetDAL();
	}
	
	public function actionResultsFunction($objectiveName, $winningClanId, $defendingClanId, $defendingUnits, $greatestAttackerId, $greatestAttackerUnits){
		$this->ResetDAL->setActionResult($objectiveName, $winningClanId, $defendingClanId, $defendingUnits, $greatestAttackerId, $greatestAttackerUnits);	
	}
	
}
