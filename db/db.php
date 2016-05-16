<?php

Class DB{
	private $con;
	
		public function __construct(){
				
			$this->con = mysqli_connect("ip", "username", "password", "db");
		
			// Check connection
			if (mysqli_connect_errno())
			{
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
	}
		
	public function getCon(){
		return $this->con;	
	} 
}