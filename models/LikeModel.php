<?php
class LikeModel extends BaseModel {
    
    public function getLikesCatalog() {
        $userId  = UserDetails::getUserId();
        
        if (!$userId) {
            return;
        }
        
        $statement = self::$db->query(
            "SELECT `CatalogId`, UserId FROM `likes` WHERE `UserId`=$userId");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }
    
    public function isUserLikePhoto($photoId) {
        $userId  = UserDetails::getUserId();
        
        $statement = self::$db->prepare(
        "SELECT `PhotoId` FROM `likes` WHERE `UserId`=? AND `PhotoId`=?");
        $statement->bind_param('ii', $userId, $photoId);
        $statement->execute();
        $statement->bind_result($result);
        $statement->fetch();
        
        if ($result != NULL) {
            return TRUE;
        } else{
            return FALSE;
        }
    }
    public function isUserLikeCatalog($catalogId) {
        $userId  = UserDetails::getUserId();
        
        $statement = self::$db->prepare(
        "SELECT `CatalogId` FROM `likes` WHERE `UserId`=? AND `CatalogId`=?");
        $statement->bind_param('ii', $userId, $catalogId);
        $statement->execute();
        $statement->bind_result($result);
        $statement->fetch();
        
        if ($result != NULL) {
            return TRUE;
        } else{
            return FALSE;
        }
    }
}
