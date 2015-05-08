<?php

class CommentModel extends BaseModel {
   
    public function getAll() {
        $statement = self::$db->query(
            "SELECT * FROM `comments` ORDER BY `Id`");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }
    
    public function getAllPhotoComments($photoId) {
        $statement = self::$db->query(
            "SELECT * FROM `comments` WHERE PhotoId=$photoId ORDER BY `Id`");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }
    
    public function getById($catalogId) {
        $statement = self::$db->query(
            "SELECT * FROM `comments` WHERE CatalogId=$catalogId ORDER BY `Id`");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }
    
    public function AddNew($description, $catalogId, $photoId) {
        $userId  = UserDetails::getUserId();
        $userName = UserDetails::getUserName();
        
        if (!UserDetails::isLogged()) {
            $_SESSION['msgContent'] = "Достъпът отказан";
            return FALSE;
        }
        
        if (!Security::lenght($description, 4, 300)) {
            $_SESSION['msgContent'] = "Допустимата дължина на коментара е от 4 до 300 символа.";
            return FALSE;
        }
        
        if ($photoId != '') {
            $insert = self::$db->prepare(
            "INSERT INTO `comments` (`Description`, `PhotoId`, UserId, UserName)  VALUES (?, ?, ?, ?)");
            $insert->bind_param('siss', $description, $photoId, $userId, $userName);
            $insert->execute();

            $_SESSION['msgContent'] = "коментарът към снимката беше успешно добавен!";
            return TRUE;
        }
        
        if ($catalogId != '') {                   
            $insert = self::$db->prepare(
            "INSERT INTO `comments` (`Description`, `CatalogId`, UserId, UserName)  VALUES (?, ?, ?, ?)");
            $insert->bind_param('siss', $description, $catalogId, $userId, $userName);
            $insert->execute();

            $_SESSION['msgContent'] = "коментарът към албума беше успешно добавен!";
            return TRUE;
        }
        
        $_SESSION['msgContent'] = "коментарът беше успешно добавен!";
        return FALSE;
    }
    
    public function edit($id, $commentUserId, $description) {
        $userId  = UserDetails::getUserId();
        if ($userId != $commentUserId) {
           $_SESSION['msgContent'] = "Достъпът отказан"; 
           return FALSE;
        }
        
        $update = self::$db->prepare(
        "UPDATE `comments` SET `Description`=? WHERE `Id`=?");
        $update->bind_param('si', $description, $id);
        $update->execute();
        
        if ($update) {
            $_SESSION['msgContent'] = "коментарът беше успешно редактирън!";
            return TRUE;
        } else{
            $_SESSION['msgContent'] = "Възникна грешка моля опитайте отново";
            return FALSE;
        }
    }
    
    public function delete($id, $photoUserId) {
        $userId  = UserDetails::getUserId();
        if ($userId != $photoUserId) {
           $_SESSION['msgContent'] = "Достъпът отказан"; 
           return FALSE;
        }
        
        $deleteComment = self::$db->query(
            "DELETE FROM `comments` WHERE Id=$id");
        
        if ($deleteComment) {
            $_SESSION['msgContent'] = "Коментарът беше изтрит успешно"; 
            return TRUE;
        } else{
            $_SESSION['msgContent'] = "Възникна грешка моля опитайте отново"; 
            return FALSE;
        }
    }
}
