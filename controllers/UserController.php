<?php

class UserController extends BaseController {
    function LogIn() {
        if ($this->isPost) {
            $model = new UserModel();
            $user = $_POST['user'];
            //$pass = md5($_POST['pass']);
            $pass = $_POST['pass'];
            
            if ($model->logIn($user, $pass)) {
                $this->addInfoMessage($this->msg);
            }   else {
                $this->addErrorMessage($this->msg);
            }
            $this->redirect('home');
        }  
    }
    function LogOut() {
        session_destroy();
        $this->addInfoMessage("Успешен изход");
        $this->redirect('home');
    }
}
