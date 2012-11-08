<?php

require_once 'BaseController.php';
require_once APPLICATION_PATH.'/models/MyCart.php';

class ShoppingController extends BaseController
{
	public function showcartAction(){
		$mycart = new MyCart();
		//put mycart into session
		session_start();
		$this->view->books = $mycart->showMyCart($_SESSION['loginuser']['id']);
		$this->view->total_price = $mycart->total_price;
		$this->render('mycart');
	}
    
    public function addproductAction(){
    	//get product Id
    	    	
    	$bookid = $this->getRequest()->getParam('bookid');
    	
    	$mycart = new MyCart();
    	session_start();
    	
    	if($mycart->addProduct($_SESSION['loginuser']['id'], $bookid)){
     		$this->view->geturl = '/hall/gohallui';
    		$this->view->info = 'Add product success!';
    		$this->_forward('success', 'global');
    	}else{
     		$this->view->geturl = '/hall/gohallui';
    		$this->view->info = 'Add product faild!';
    		$this->_forward('error', 'global');
    	}
    }
    
    public function updatecartAction(){
    	$bookids = $this->getRequest()->getParam('bookids');
    	$booknums = $this->getRequest()->getParam('booknums');
    	
    	$mycart = new MyCart();
    	session_start();
    	$userid = $_SESSION['loginuser']['id'];
    	$i = 0;
    	foreach($bookids as $bi){
    		$mycart->updateProduct($userid, $bi, $booknums[$i]);
    		$i++;
    	}
    	$this->view->geturl = '/shopping/showcart';
    	$this->view->info = 'Product number has been renewed in mycart!';
    	$this->_forward('success', 'global');
    }
    
    public function delproductAction(){
    	//get product id
    	
    	$id = $this->getRequest()->getParam('id');
    	$mycart = new MyCart();
    	session_start();
    	
    	if($mycart->delProduct($_SESSION['loginuser']['id'], $id))
    	{
    		$this->view->geturl = '/shopping/showcart';
    		$this->view->info = 'Product has been removed from mycart!';
    		$this->_forward('success', 'global');
    	}else{
    		$this->view->geturl = '/shopping/showcart';
    		$this->view->info = 'delet product faild!';
    		$this->_forward('error', 'global');
    	}
    }

}

