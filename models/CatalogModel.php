<?php

class CatalogModel extends BaseModel {
  
    public function getAll() {
        $statement = self::$db->query(
            "SELECT * FROM catalogs ORDER BY Name");
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
    
    public function delete($Id) {
        
        $deletePhotosStatement = self::$db->prepare("DELETE FROM `photos` WHERE CatalogId=?");
        $deletePhotosStatement->bind_param("i", $Id);
        $deletePhotosStatement->execute(); 
       
        
        $statement = self::$db->prepare(
        "DELETE FROM catalogs WHERE Id = ?");
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
    
    public function EditCatalog($name, $description, $id, $category) {
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

        $update = self::$db->prepare(
        "UPDATE `catalogs` SET `Name`=?,`Description`=?, categoryId=? WHERE `Id`=$id");
        $update->bind_param('sss', $name, $description, $category);
        $update->execute();

        $_SESSION['msgContent'] = "каталогът беше успешно редактирън!";
        return TRUE;
    }
    
}
