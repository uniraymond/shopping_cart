<?php

require_once 'BaseController.php';
require_once APPLICATION_PATH. '/models/Users.php';
class LoginController extends BaseController
{
    public function loginAction()
    {
        // action body
        $userModel = new Users();
        $id = $this->getRequest()->getParam("id", "");
        $pwd = $this->getRequest()->getParam("pwd", "");
        
        $db = $userModel->getAdapter();
        $where = $db->quoteInto("id=?", $id).$db->quoteInto(" AND pwd=?", md5($pwd));
        
        $loginuser = $userModel->fetchAll($where)->toArray();
        
        if(count($loginuser)==1){
        	session_start();
        	$_SESSION['loginuser'] = $loginuser[0];
        	$this->_forward('gohallui', 'hall');
        }else{
        	$this->view->error="<font color='red'>The username or password invalid</font>";
        	
        	$this->_forward('index', 'index');
        }
    }

	public function logoutAction()
	{
		
	}
}

