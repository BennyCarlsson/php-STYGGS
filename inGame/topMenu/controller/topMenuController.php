<?php

class topMenuController{
	
	public function GetHTML(){
		return "<div class='' id='topMenuDiv'>
		 <a href='/projekt/info/about.html' target='_blank'>About</a> | 
		 <a href='/projekt/info/about.html#contact' target='_blank'>Contact</a> | 
		 <a href='logIn.php'>Log out!</a>
		</div>";
	}
}