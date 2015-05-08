<?php

class CatalogModel extends BaseModel {
  
    public function getAll() {
        $statement = self::$db->query(
            "SELECT * FROM catalogs ORDER BY Name");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }
    
    public function getTopN($count) {
        $statement = self::$db->query(
            "SELECT * FROM `catalogs` ORDER BY `Likes` DESC LIMIT $count");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }
    
    public function getAllById() {
        $userId  = UserDetails::getUserId();
        $statement = self::$db->query(
            "SELECT * FROM catalogs WHERE UserId=$userId ORDER BY Name");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }
     
    public function getByCategoryId($categoryId) {

        $statement = self::$db->query(
            "SELECT * FROM catalogs WHERE categoryId=$categoryId ORDER BY Name");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }
    
    public function delete($Id, $catalogUserId) {
        
         $userId  = UserDetails::getUserId();
        
        if ($catalogUserId != $userId){
            $_SESSION['msgContent'] = "Достъпът отказан";
            return FALSE;
        }
        
        $deletePhotosStatement = self::$db->prepare("DELETE FROM `photos` WHERE CatalogId=?");
        $deletePhotosStatement->bind_param("i", $Id);
        $deletePhotosStatement->execute(); 
       
        $deleteCommentsStatement = self::$db->prepare("DELETE FROM `comments` WHERE CatalogId=?");
        $deleteCommentsStatement->bind_param("i", $Id);
        $deleteCommentsStatement->execute(); 
         
        $statement = self::$db->prepare(
        "DELETE FROM catalogs WHERE Id = ?");
        $statement->bind_param("i", $Id);
        $statement->execute();
        return $statement->affected_rows > 0;   
    }
    
    public function deleteComment($Id, $commentUserId) {     
         $userId  = UserDetails::getUserId();
         if ($commentUserId != $userId) {
            $_SESSION['msgContent'] = "Нямате достъп";
            return FALSE;
         }
         
        $statement = self::$db->prepare(
        "DELETE FROM comments WHERE Id = ?");
        $statement->bind_param("i", $Id);
        $statement->execute();
        return $statement->affected_rows > 0;   
    }
    
    public function AddCatalog($name, $description, $upload, $category) {
        $userId  = UserDetails::getUserId();

        if ($userId == FALSE) {
            $_SESSION['msgContent'] = "Нямате достъп";
            return FALSE;
        }

        if (!Security::lenght($name, 4, 100)) {
            $_SESSION['msgContent'] = "Допустимата дължина на името е от 4 до 20 символа.";
            return FALSE;
        }

        if (!Security::lenght($description, 0, 200)) {
            $_SESSION['msgContent'] = "Допустимата дължина на описанието е до 200 символа.";
            return FALSE;
        }

        $insert = self::$db->prepare(
        "INSERT INTO `catalogs` (`Name`, `Description`, `image`, `UserId`, categoryId)  VALUES (?, ?, ?, ?, ?)");
        $insert->bind_param('sssii', $name, $description, $upload, $userId, $category);
        $insert->execute();

        $_SESSION['msgContent'] = "каталогът беше успешно добавен!";
        return TRUE;
    }
    
    public function EditCatalog($name, $description, $id, $category, $catalogUserId) {
        $userId  = UserDetails::getUserId();

        if ($catalogUserId != $userId) {
            $_SESSION['msgContent'] = "Достъпът отказан";
            return FALSE;
        }
        
        if ($userId == FALSE) {
            $_SESSION['msgContent'] = "Достъпът отказан";
            return FALSE;
        }

        if (!Security::lenght($name, 4, 100)) {
            $_SESSION['msgContent'] = "Допустимата дължина на името е от 4 до 20 символа.";
            return FALSE;
        }

        if (!Security::lenght($description, 0, 200)) {
            $_SESSION['msgContent'] = "Допустимата дължина на описанието е до 200 символа.";
            return FALSE;
        }

        $update = self::$db->prepare(
        "UPDATE `catalogs` SET `Name`=?,`Description`=?, categoryId=? WHERE `Id`=$id");
        $update->bind_param('sss', $name, $description, $category);
        $update->execute();

        $_SESSION['msgContent'] = "каталогът беше успешно редактирън!";
        return TRUE;
    }
    
    public function likeCatalog($catalogId) {
        
        $userId  = UserDetails::getUserId();
        if (!$userId) {
            $_SESSION['msgContent'] = "Възникна грешка моля опитайте отново";
            return FALSE;
        }
        $isUserLike = Security::IsUserLikeCatalog($catalogId);  
        if ($isUserLike) {
            $_SESSION['msgContent'] = "Достъпът отказан !";
            return FALSE;
        }   
        
        $like = self::$db->query("UPDATE `catalogs` SET `Likes`= `Likes`+1 WHERE Id=$catalogId");
  
        $insertLike = self::$db->prepare("INSERT INTO `likes`(`UserId`, `CatalogId`) VALUES (?, ?)");
        $insertLike->bind_param("ii", $userId, $catalogId);
        $insertLike->execute(); 

        return TRUE;
        
    }
    public function unLikeCatalog($catalogId) {
        
        $userId  = UserDetails::getUserId();
        if (!$userId) {
            $_SESSION['msgContent'] = "Възникна грешка моля опитайте отново";
            return FALSE;
        }
        
        $isUserLike = Security::IsUserLikeCatalog($catalogId);  
        if (!$isUserLike) {
            $_SESSION['msgContent'] = "Достъпът отказан !";
            return FALSE;
        } 
        
        $like = self::$db->query("UPDATE `catalogs` SET `Likes`= `Likes`-1 WHERE Id=$catalogId");
  
        $insertLike = self::$db->prepare("DELETE FROM `likes` WHERE `UserId`=? AND `CatalogId`=?");
        $insertLike->bind_param("ii", $userId, $catalogId);
        $insertLike->execute(); 

        return TRUE;
        
    }
    
}
