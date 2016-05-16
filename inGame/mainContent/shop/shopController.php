<?php

require_once 'shopModel.php';
require_once 'shopView.php';
Class ShopController{
	
	private $shopView;
	private $shopModel;
	private $errorMessage = "";
	public function __construct(){
		$this->shopView = new ShopView();
		$this->shopModel = new ShopModel();
	}
	
	public function GetHTML(){
		$userId = $this->shopView->getUserId();
		
		//check buybutton
		if($this->shopView->checkBuyButton()){
			$amount = $this->shopView->getNumber();
			if($this->shopModel->checkInput($amount)){						
				if($this->shopModel->buyFollowers($userId, $amount)){
					$this->errorMessage = " Success!";		
				}else{
					$this->errorMessage = " Not enough Cash";
				}
			}else{
				$this->errorMessage = " Not Valid Input";
			}
		}
		$html = $this->shopView->getHTML($this->errorMessage);
		return $html;
	}
}
