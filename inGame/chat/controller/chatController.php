<?php

require_once('inGame/chat/view/chatView.php');

class chatController{
	
	public function GetHTML(){
		return "<div id='chatDiv'>
		<p>chat!</p>
		</div>";
	}
}