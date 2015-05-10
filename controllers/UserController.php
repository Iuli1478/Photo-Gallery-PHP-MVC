<?php

class UserController extends BaseController {
    
    function getAll(){
        $model = new UserModel();
        $this->users = $model->getAll();
        $this->renderView("index");
    }
    
    function LogIn() {
        if ($this->isPost) {
            $model = new UserModel();
            $user = $_POST['user'];
            $pass = md5($_POST['pass']);
            
            if ($model->logIn($user, $pass)) {
                $this->addInfoMessage($_SESSION['msgContent']);
            }   else {
                $this->addErrorMessage($_SESSION['msgContent']);
            }
            $this->redirect('home');
        }
    }
    
    function LogOut() {
        session_destroy();
        $this->addInfoMessage("Успешен изход");
        $this->redirect('home');
    }
    
    function Register() {
        $model = new UserModel();
        
        if ($this->isPost) {
            $username = trim($_POST['user']);
            $password = trim($_POST['pass']);
            $repassword = md5($_POST['repass']);
            $email = trim($_POST['mail']);

            if ($model->register($username, $password, $repassword, $email)) {
                $this->addInfoMessage($_SESSION['msgContent']);
            } else{
                $this->addErrorMessage($_SESSION['msgContent']);
            }

            $this->redirect('home');
        }
    }
    function changeRole($userId, $role){
        $model = new UserModel();
        
        if ($model->changeRole($userId, $role)) {
            return TRUE;
        } else{
            return FALSE;
        }
    }
}
