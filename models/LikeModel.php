<?php
class LikeModel extends BaseModel {
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
}
