<?php

class PhotoModel extends BaseModel {
    
    public function getAll() {
        $statement = self::$db->query(
            "SELECT * FROM `photos` ORDER BY `Likes` ASC");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function getTopNImage($count) {
        $statement = self::$db->query(
            "SELECT `Image` FROM `photos` ORDER BY `Likes` DESC LIMIT $count");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }
    
    public function getPhotoById($Id) {
        $statement = self::$db->query(
         "SELECT * FROM `photos` WHERE Id=$Id ORDER BY `Likes` ASC");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }
    
    public function getByCatalog($catalogId) {
        $statement = self::$db->query(
            "SELECT * FROM `photos` WHERE CatalogId=$catalogId  ORDER BY `Likes` ASC");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function AddPhoto($name, $description, $upload, $catalogId) {
        $userId  = UserDetails::getUserId();

        if ($userId == FALSE) {
            $_SESSION['msgContent'] = "Нямате достъп";
            return FALSE;
        }

        if (!Security::lenght($name, 4, 100)) {
            $_SESSION['msgContent'] = "Допустимата дължина на името е от 4 до 20 символа.";
            return FALSE;
        }

        if (!Security::lenght($description, 0, 400)) {
            $_SESSION['msgContent'] = "Допустимата дължина на описанието е до 200 символа.";
            return FALSE;
        }

        $insert = self::$db->prepare(
        "INSERT INTO `photos` (`Name`, `Description`, `Image`, `CatalogId`)  VALUES (?, ?, ?, ?)");
        $insert->bind_param('sssi', $name, $description, $upload, $catalogId);
        $insert->execute();

        $_SESSION['msgContent'] = "снимката беше добавена успешно!";
        return TRUE;
    }

    public function EditPhoto($name, $description, $upload, $Id, $catalogUserId) {
        $userId  = UserDetails::getUserId();

        if ($userId == FALSE || $userId != $catalogUserId) {
            $_SESSION['msgContent'] = "Нямате достъп";
            return FALSE;
        }

        if (!Security::lenght($name, 4, 100)) {
            $_SESSION['msgContent'] = "Допустимата дължина на името е от 4 до 20 символа.";
            return FALSE;
        }

        if (!Security::lenght($description, 0, 400)) {
            $_SESSION['msgContent'] = "Допустимата дължина на описанието е до 200 символа.";
            return FALSE;
        }

        if ($upload == '') {
            $update = self::$db->prepare(
             "UPDATE `photos` SET `Name`=?, `Description`=? WHERE `Id`=$Id");
             $update->bind_param('ss', $name, $description);
        } else{
             $update = self::$db->prepare(
             "UPDATE `photos` SET `Name`=?, `Description`=?, `Image`=? WHERE `Id`=?");
             $update->bind_param('sssi', $name, $description, $upload, $Id);
        }
        $update->execute();

        $_SESSION['msgContent'] = "снимката беше редъктирана успешно!";
        return TRUE;
    }
    
    public function deletePhoto($id, $catalogUserId) {
        $userId  = UserDetails::getUserId();
        if ($catalogUserId != $userId) {
            $_SESSION['msgContent'] = "Нямате право да триете тази снимка";
            return FALSE;
        }
        
        $deleteCommentsStatement = self::$db->prepare("DELETE FROM `comments` WHERE PhotoId=?");
        $deleteCommentsStatement->bind_param("i", $id);
        $deleteCommentsStatement->execute(); 
         
        $statement = self::$db->prepare(
        "DELETE FROM photos WHERE Id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        
        if ($statement->affected_rows > 0) {
            $_SESSION['msgContent'] = "Снимката беше изтрита успешно";
            return TRUE;
        } else{
            $_SESSION['msgContent'] = "Възникна грешка моля опитайте отново";
            return FALSE;
        }
    }
    
    public function likePhoto($photoId) {
        
        $userId  = UserDetails::getUserId();
        if (!$userId) {
            $_SESSION['msgContent'] = "Възникна грешка моля опитайте отново";
            return FALSE;
        }
        $isUserIsLike = Security::IsUserLikePhoto($photoId);  
        if ($isUserIsLike) {
            $_SESSION['msgContent'] = "Достъпът отказан !";
            return FALSE;
        }   
        
        $like = self::$db->query("UPDATE `photos` SET `Likes`= `Likes`+1 WHERE Id=$photoId");
  
        $insertLike = self::$db->prepare("INSERT INTO `likes`(`UserId`, `PhotoId`) VALUES (?, ?)");
        $insertLike->bind_param("ii", $userId, $photoId);
        $insertLike->execute(); 

        return TRUE;
        
    }
    
    public function unLikePhoto($photoId) {
        
        $userId  = UserDetails::getUserId();
        if (!$userId) {
            $_SESSION['msgContent'] = "Възникна грешка моля опитайте отново";
            return FALSE;
        }
        
        $isUserIsLike = Security::IsUserLikePhoto($photoId);  
        if (!$isUserIsLike) {
            $_SESSION['msgContent'] = "Достъпът отказан !";
            return FALSE;
        } 
        
        $like = self::$db->query("UPDATE `photos` SET `Likes`= `Likes`-1 WHERE Id=$photoId");
  
        $insertLike = self::$db->prepare("DELETE FROM `likes` WHERE `UserId`=? AND `PhotoId`=?");
        $insertLike->bind_param("ii", $userId, $photoId);
        $insertLike->execute(); 

        return TRUE;
        
    }
}
