<?php

class AuthorsModel extends BaseModel {
    public function getAll() {
        $statement = self::$db->query(
            "SELECT * FROM users ORDER BY id");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }
    public function createUser($name) {
        if ($name == '') {
            return false;
        }
        $statement = self::$db->prepare(
        "INSERT INTO users (`id`, `Name`, `Phone`) VALUES(NULL, ?, 0)");
        $statement->bind_param("s", $name);
        $statement->execute();
        return $statement->affected_rows > 0; //Връща true или false взависимус далиима инсъртнато нещо в базата
    }

    public function deleteAuthor($id) {
        $statement = self::$db->prepare(
            "DELETE FROM users WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->affected_rows > 0;
    }
}