<?php

class CommentModel extends BaseModel {
   
    public function getAll() {
        $statement = self::$db->query(
            "SELECT * FROM `comments` ORDER BY `Id`");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }
    
    public function getById($catalogId) {
        $statement = self::$db->query(
            "SELECT * FROM `comments` WHERE CatalogId=$catalogId ORDER BY `Id`");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }
    
    public function AddNew($description, $catalogId) {
        $userId  = UserDetails::getUserId();
        $userName = UserDetails::getUserName();
        
        if (!Security::lenght($description, 4, 300)) {
            $_SESSION['msgContent'] = "Допустимата дължина на коментара е от 4 до 300 символа.";
            return FALSE;
        }
        
        $insert = self::$db->prepare(
        "INSERT INTO `comments` (`Description`, `CatalogId`, UserId, UserName)  VALUES (?, ?, ?, ?)");
        $insert->bind_param('siss', $description, $catalogId, $userId, $userName);
        $insert->execute();

        $_SESSION['msgContent'] = "коментарът беше успешно добавен!";
        return TRUE;
    }
    
}
