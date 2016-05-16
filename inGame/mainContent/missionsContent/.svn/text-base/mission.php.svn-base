<?php 

class mission {
	public $title;
	public $description;
	public $levelReq;
	public $rewards = array();
	
	public function __construct($title, $description, $levelReq, $rewards){
		$this -> title = $title;
		$this -> description = $description;
		$this -> levelReq = $levelReq;		
		foreach($rewards as $reward){
			array_push($this -> rewards, $reward);			
		}		
		//$this -> reward = $reward;
	}
}