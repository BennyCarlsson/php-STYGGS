<?php

require_once 'inGame/mainContent/clanForum/model/clanForumDB.php';
require_once 'inGame/mainContent/clanForum/view/clanForumView.php';
require_once 'inGame/mainContent/clanForum/model/clanForumModel.php';

Class ClanForumController{
	
	private $clanForumView;
	private $clanForumDB;
	private $clanForumModel;
	
	public function __construct(){		
		$this->clanForumView = new ClanForumView();
		$this->clanForumDB = new ClanForumDB();
		$this->clanForumModel = new ClanForumModel();
	}
	
	public function GetHTML(){
		$userId = $this->clanForumView->getUserId();
		
		//check if in a clan
		if($this->clanForumDB->checkIfInClan($userId)){
			//check if making new post
			if($this->clanForumView->checkPostForumButton()){
				$title = $this->clanForumView->getForumTitle();
				$text = $this->clanForumView->getForumText();	
				if($this->clanForumModel->modelCheck($title, $text, $userId)){
						//le successfull post
				}
			}
			//todo
			//check if making new comment
			if($this->clanForumView->checkcommentButton()){
				$postId = $this->clanForumView->getCommentPost();
				$comment = $this->clanForumView->getComment();
				if($this->clanForumModel->insertComment($postId, $comment, $userId)){
					//le sucessfull comment
				}
			}
			//check if going into topic
			if($this->clanForumView->checkCommentGet()){
				//go into topic
				//get post
				$postId = $this->clanForumView->getCommentPost();
				$postForum = $this->clanForumModel->getForumPost($postId);
				$comments = $this->clanForumModel->getForumComments($postId);
				$html = $this->clanForumView->getPostHTMl($postForum, $comments);
			}else{
				//else type out the topics
				$postForum = $this->clanForumModel->getForumTitles($userId);
				$html = $this->clanForumView->getHTML($postForum);
			}
		}else{
			$html = "You are not in a Clan!";
		}
		
		
		return $html;	
	}
}
	