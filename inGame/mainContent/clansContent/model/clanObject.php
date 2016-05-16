<?php

Class ClanObject{
	public $name;
	public $numberOfMembers;
	public $averagelvl;
	public function __construct($name, $numberOfMembers, $averagelvl){
		$this->name = $name;
		$this->numberOfMembers = $numberOfMembers;
		$this->averagelvl = $averagelvl;
	}
	
}
