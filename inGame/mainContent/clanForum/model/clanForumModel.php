<?php

require_once 'clanForumDB.php';

Class ClanForumModel{
	private $forumDB;
	
	public function __construct(){
		$this->forumDB = new ClanForumDB();
	}
	
	public function modelCheck($title, $text, $userId){
			$title = strip_tags($title);
			$text = strip_tags($text);
			if($title != "" && $title != null && $text != "" && $text != NULL){
				if(strlen($title) < 40 && strlen($text) < 200){
					$this->forumDB->addPost($title, $text, $userId);
					return TRUE;	
				}
			}
			return FALSE;
	}
	
	public function getForumTitles($userId){
		$titlesList = $this->forumDB->getForumTitles($userId);
		return $titlesList;
	}
	public function getForumPost($postId){
		$postForum = $this->forumDB->getForumPost($postId);
		return $postForum;
	}
	public function insertComment($postId, $comment, $userId){
		$comment = strip_tags($comment);
		if($this->modelStripAndCheck($comment)){
			$this->forumDB->insertComment($postId, $comment, $userId);
			return true;
		}
		return false;
	}
	private function modelStripAndCheck($text){
		if($text != "" && $text != NULL){
			if(strlen($text) < 200){
				return TRUE;	
			}
		}
		return FALSE;
	}
	public function getForumComments($postId){
		$comments = $this->forumDB->getForumComments($postId);
		return $comments;
	}
}
	
	
	
	
	
	
	
	
	
	
	
	
	
	