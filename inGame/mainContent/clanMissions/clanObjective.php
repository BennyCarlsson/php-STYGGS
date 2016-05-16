<?php

class clanObjective {
	public $objectiveId;
	public $ownerId;
	public $ownerName;
	public $objectiveName;
	public $posX;
	public $posY;
	public $baseXpIncome;
	public $baseCashIncome;
	public $incomeUpgrade;
	
	public function __construct($objectiveId, $ownerId, $ownerName, $objectiveName, $posX, $posY, $baseXpIncome, $baseCashIncome, $incomeUpgrade){
		$this -> objectiveId = $objectiveId;
		$this -> ownerId = $ownerId;
		$this->ownerName = $ownerName;
		$this->objectiveName = $objectiveName;
		$this->posX = $posX;
		$this->posY = $posY;
		$this->baseXpIncome = $baseXpIncome;
		$this->baseCashIncome = $baseCashIncome;
		$this->incomeUpgrade = $incomeUpgrade;
	}
	
}
