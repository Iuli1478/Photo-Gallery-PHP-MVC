<?php

class UserController extends BaseController {
    function LogIn() {
        if ($this->isPost) {
            $model = new UserModel();
            $user = $_POST['user'];
            //$pass = md5($_POST['pass']);
            $pass = $_POST['pass'];
            
            if ($model->logIn($user, $pass)) {
                $this->redirect('home');
                $this->addInfoMessage($this->msg);
            }   else {
                $this->redirect('home');
                $this->addErrorMessage($this->msg);
            }
        }  
    }
}
