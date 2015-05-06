<?php

class CatalogModel extends BaseModel {
  
    public function getAll() {
        $userId  = UserDetails::getUserId();
        $statement = self::$db->query(
            "SELECT * FROM catalogs WHERE UserId=$userId ORDER BY Name");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }
     
    public function delete($Id) {
        $statement = self::$db->prepare(
        "DELETE FROM catalogs WHERE Id = ?");
        $statement->bind_param("i", $Id);
        $statement->execute();
        return $statement->affected_rows > 0;
    }
    
    public function AddCatalog($name, $description, $upload) {
        $userId  = UserDetails::getUserId();

        if ($userId == FALSE) {
            $_SESSION['msgContent'] = "Нямате достъп";
            return FALSE;
        }

        if (!Security::lenght($name, 4)) {
            $_SESSION['msgContent'] = "Допустимата дължина на името е от 4 до 20 символа.";
            return FALSE;
        }

        if (!Security::lenght($description, 4, 200)) {
            $_SESSION['msgContent'] = "Допустимата дължина на описанието е от 4 до 200 символа.";
            return FALSE;
        }

        $insert = self::$db->prepare(
        "INSERT INTO `catalogs` (`Name`, `Description`, `image`, `UserId`)  VALUES (?, ?, ?, ?)");
        $insert->bind_param('sssi', $name, $description, $upload, $userId);
        $insert->execute();

        $_SESSION['msgContent'] = "каталогът беше успешно добавен!";
        return TRUE;
    }
}
