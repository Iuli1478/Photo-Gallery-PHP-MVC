<?php

class UserDetails {
    public static function isLogged() {
        if (isset($_SESSION['user']) && isset($_SESSION['pass'])) {
            return true;
        } else {
            return false;
        }
    }
    public static function isAdmin() {
        $model = new UserModel();
        
        if (isset($_SESSION['user']) && isset($_SESSION['pass'])) {
            if ($model->isAdmin(UserDetails::getUserId())) {
                return TRUE;
            } else{
                return FALSE;
            }
        } else{
            return FALSE;
        }
    }
    public static function getUserId() {
        if (isset($_SESSION['UserId'])) {
            return $_SESSION['UserId'];
        } else {
            return FALSE;
        }
    }
    public static function getUserName() {
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        } else {
            return FALSE;
        }
    }
    public static function getMailAddres() {
        $model = new UserModel();
        $mails = $model->getMail(UserDetails::getUserId());
        foreach ($mails as $mail) {
            return  $mail['Email'];
        }
    }
}