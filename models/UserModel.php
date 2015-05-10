<?php

class UserModel extends BaseModel {
    
   public function getAll() {
        $statement = self::$db->query(
            "SELECT Id, UserName, Email, Role FROM users ORDER BY Id");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }
    
    public function getMail($userId) {
        $statement = self::$db->query(
            "SELECT Email FROM users WHERE Id=$userId ORDER BY Id");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }
    
    public function logIn($user, $pass) {
        
        if (!empty($user) && !empty($pass)) {
            $statement = self::$db->prepare(
            "SELECT `Id`, `UserName`, `Password` FROM `users` WHERE `UserName`=? AND `Password`=?");
            $statement->bind_param('ss', $user, $pass);
            $statement->execute();
            $statement->bind_result($id, $userName, $password);
            $Userid = $statement->fetch();

            if ($id != NULL && $userName != NULL && $password != NULL) {
                $_SESSION['UserId'] = $id;
                $_SESSION['user'] = $userName;
                $_SESSION['pass'] = $password;
                $_SESSION['msgContent'] = "Успешен вход";
                return TRUE;
            } else {
                $_SESSION['msgContent'] =  "Неразпознати данни за вход.";
                return FALSE;
            }
        } else {
            $_SESSION['msgContent'] =  "Моля попълнете всички полета.";
             return FALSE;
        }
    }
    
    public function isAdmin($userId) {
        $statement = self::$db->prepare(
        "SELECT `Role` FROM `users` WHERE `Id`=?");
        $statement->bind_param('i', $userId);
        $statement->execute();
        $statement->bind_result($isAdmin);
        $statement->fetch();

        if ($isAdmin == 3) {
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    public function register($username, $password, $repassword, $email) {
        
        if (!Security::regex($username)) {
            $_SESSION['msgContent'] = "Невалидно потребителско име.";
            return FALSE;
        }

        if (!Security::lenght($username, 4)) {
            $_SESSION['msgContent'] = "Допустимата дължина на потребителското име е от 4 до 20 символа.";
            
            return FALSE;
        }

        if (!Security::lenght($password, 6)) {
            $_SESSION['msgContent'] = "Допустимата дължина на паролата е от 6 до 20 символа.";
            return FALSE;
        }

        if (md5($password) != $repassword) {
            $_SESSION['msgContent'] = "паролите не съвпадат.";
            return FALSE;
        }

        if ($email == "") {
            $_SESSION['msgContent'] = "Моля въведете имейл адрес";
            return FALSE('zsdsadsada');
        }
        
        $statement = self::$db->prepare(
        "SELECT `UserName` FROM `users` WHERE `UserName`=?");
        $statement->bind_param('s', $username);
        $statement->execute();
        $statement->num_rows();
       
        $num_rows = (int) $statement->fetch();

        if ($num_rows != 0) {
            $_SESSION['msgContent'] = "Потребителсктоо име е заето.";
            return FALSE;
        }
        
        if (!Security::regex($email, 1)) {
            $_SESSION['msgContent'] = "Невалиден e-mail адрес.";
            return FALSE;
        }
        
        $email_statement = self::$db->prepare(
        "SELECT `Email` FROM `users` WHERE `Email`=?");
        $email_statement->bind_param('s', $email);
        $email_statement->execute();
        $email_statement->num_rows();
        $e_num_rows = (int) $email_statement->fetch();

        if ($e_num_rows != 0) {
            $_SESSION['msgContent'] = "E-mail адресът е зает.";
            return FALSE;
        }
        
        $password_statement = self::$db->prepare(
        "SELECT `Password` FROM `users` WHERE `Password`=?");
        $password_statement->bind_param('s', md5($password));
        $password_statement->execute();
        $password_statement->num_rows();
        $p_num_rows = (int) $password_statement->fetch();

        if ($p_num_rows != 0) {
            $_SESSION['msgContent'] = "Паролата е заета";
            return FALSE;
        }
        
        
        $insert = self::$db->prepare(
        "INSERT INTO `users` (`UserName`, `Password`, `Email`)  VALUES (?, ?, ?)");
        $insert->bind_param('sss', $username, md5($password), $email);
        $insert->execute();

        $_SESSION['msgContent'] = "Вие успешно се регистрирахте! Моля влезете в акаунта си!";
        return TRUE;
    }
    
    function changeRole($userId, $role){
        $insert = self::$db->prepare(
        "UPDATE `users` SET `Role`=? WHERE Id=?");
        $insert->bind_param('si', $role, $userId);
        $insert->execute();
    }
}
