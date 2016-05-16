<?php
require_once 'db/db.php';

Class ClanForumDB{
	
	public function __construct(){
		
	}
	
	public function addPost($title, $text, $userId){
		$clanID = $this->getClanId($userId);
		$db = new DB();
		$connection = $db -> getCon();
		$connection->query("CALL insertForumPost('$title', '$text', '$userId','$clanID')");
		$connection->close();
	}
	public function insertComment($postId, $comment, $userId){
		$db = new DB();
		$connection = $db -> getCon();
		$connection->query("CALL insertComment('$postId', '$comment', '$userId')");
		$connection->close();
	}
	private function getClanId($userId){
		$db = new DB();
		$connection = $db -> getCon();
		$result = $connection->query("CALL getClanIdOnUserId('$userId')");
		$connection->close();
		$obj = $result->fetch_object();
		if($obj == "" || $obj == NULL){
			return "";
		}
		return $obj->ClanId;
	}
	public function getForumTitles($userId){
		$clanID = $this->getClanId($userId);
		
		$db = new DB();
		$connection = $db -> getCon();
		$result = $connection->query("CALL getForumPostsOnClanId('$clanID')");
		$connection->close();
		
		$titlesList = "<ul>";
		while($obj = $result->fetch_object()){
			$username = $this->getUsername($obj->Id);
			$titlesList .= "
							<div class='threadClass'>
							<li>	
								<a href='inGame.php?comment=$obj->PostId'>
								$obj->Title by $username
								</a>	
								<p>Submit Date: $obj->SubmitDate</p>
								<p>Last active: $obj->LastActive</p>
							</li>
							</div>
							";
		}
		$titlesList .=	"</ul>";
		return $titlesList;
	}
		public function getForumComments($postId){
		$db = new DB();
		$connection = $db->getCon();
		$result = $connection->query("CALL getCommentsOnPostId('$postId')");
		$connection->close();
		$comments = "<div class='comments'>";
		while($obj = $result->fetch_object()){
			$username = $this->getUsername($obj->Id);
				$comments .= "
							<div class='comment'>
							<p>$obj->Comment</p>
							<p>By $username ($obj->SubmitDate)</p>
							</div>	
							";
		}
		$comments .= "</div>";
		return $comments;
	}
	
	public function getForumPost($postId){
		$db = new DB();
		$connection = $db->getCon();
		$result = $connection->query("CALL getPostDataOnPostId('$postId')");
		$obj = $result->fetch_object();
		$html = "
				<p>Titel: $obj->Title </p>
				<p>Text: $obj->Text </p>
				<p>Submitted $obj->SubmitDate</p>
				";
		return $html;
	}
	private function getUsername($id){
		$db = new DB();
		$connection = $db -> getCon();
		$result = $connection->query("CALL getUsernameOnId('$id')");
		$connection->close();
		$obj = $result->fetch_object();
		return $obj->Username;
	}
	
	public function checkIfInClan($id){
		$db = new DB();
		$connection = $db->getCon();
		$result = $connection->query("CALL getClanNameOnUserId('$id')");
		$obj = $result->fetch_object();
		$connection ->close();
		if($obj == null || $obj == ""){
			return FALSE;	
		}
		return TRUE;
	}
	
}
	
	
	
	
	
	
	
	
	
	