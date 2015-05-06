<?php

class PhotoModel extends BaseModel {
    
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

        if (!Security::lenght($description, 0, 200)) {
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
}
