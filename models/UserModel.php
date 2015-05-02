<?php

class UserModel extends BaseModel {
    public function logIn($user, $pass) {
        
        if (!empty($user) && !empty($pass)) {
            $statement = self::$db->prepare(
            "SELECT `UserName`, `Password` FROM `users` WHERE `UserName`=? AND `Password`=?");
           // $statement = $this->db->prepare("Select `UserName`, `Password` From `users` Where `UserName`=? and `Password`=?");
            $statement->bind_param('ss', $user, $pass);
            $statement->execute();
            $statement->num_rows();
            $num_rows = (int) $statement->fetch();
            
            if ($num_rows === 1) {
                $_SESSION['user'] = $user;
                $_SESSION['pass'] = $pass;
                $this->msg = "Успешен вход";
                return TRUE;
            } else {
                $this->msg =  "Неразпознати данни за вход.";
                return FALSE;
            }
        } else {
            $this->msg =  "Моля попълнете всички полета.";
             return FALSE;
        }
    }
}
