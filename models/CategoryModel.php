<?php
class CategoryModel extends BaseModel {
    public function getAll() {
        $statement = self::$db->query(
            "SELECT * FROM `categories` ORDER BY `Id`");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }
}
