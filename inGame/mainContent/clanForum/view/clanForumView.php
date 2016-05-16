<?php

Class ClanForumView{
	public static $idSession = "idSession";
	public static $comment = 'comment';
	
	public function getHTML($postForum){
		$error = $this->getPostError();
		$html = "
				<p>Use the forum to talk to your Clan members.  The forum can only be seen by your own Clan</p>
				<a id='newPostLink'> New Post </a>
				<a id='newPostLink2'> New Post </a>
				<p>$error</p>
				<div id='newPostDiv'>
					<form method='post'>
						Title: <input type='text' name='forumTitle' placeholder='Title'>
						Text: <input type='text' name='forumText' placeholder='Text..'>
						<input class='btn btn-default' type='submit' id='postForumButton' name='postForumButton'>
					</form> 
				</div>
				$postForum
				";
		return $html;	
	}
	public function getPostHTMl($postForum, $comments){
		$error = $this->getCommentError();
		$html = "
				<a href='inGame.php'><-- Back to Topics!</a>
				<div id='postTextDiv'>
					$postForum
				</div>
				
				$comments
				$error
				<form method='post'>
				<input type='text' name='comment' placeholder='comment..'>
				<button type='submit' class='btn btn-default' name='commentButton'>Submit</button>
				</form>
				";	
		return $html;
	}
	public function checkPostForumButton(){
		if(isset($_POST['postForumButton'])){
			return TRUE;	
		}
		return FALSE;	
	}
	public function checkcommentButton(){
		if(isset($_POST['commentButton'])){
			return TRUE;	
		}
		return FALSE;	
	}
	public function getForumTitle(){
		return $_POST['forumTitle'];	
	}
	public function getForumText(){
		return $_POST['forumText'];
	}
	public function getCommentPost(){
		return $_GET[self::$comment];
	}
	public function getUserId(){
		return $_SESSION[self::$idSession];	
	}
	public function checkCommentGet(){
		if(isset($_GET[self::$comment])){
			return true;
		}
		return false;
	}
	public function getComment(){
		return $_POST['comment'];
	}
	private function getPostError(){
		if($this->checkPostForumButton()){
			$title = $this->getForumTitle();
			$text = $this->getForumText();
			if($title == "" || $title == null){
				return "You must have a Title!";
			}else if($text == "" || $text == null){
				return "You must have Text content";
			}else if(strlen($title)>40){
				return"Title can't be more then 40 characters";
			}else if(strlen($text)>200){
				return"Text can't be more then 200 characters";
			}
		}
			
		return "";
	}
	private function getCommentError(){
		if($this->checkcommentButton()){
			$comment = $this->getComment();
			if($comment == "" || $comment == null){
				return "Comment can't be empty";
			}else if(strlen($comment)>200){
				return "Comment can't be more then 200 characters";
			}
		}
		return "";
	}

}














