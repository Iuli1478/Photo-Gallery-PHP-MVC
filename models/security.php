<?php

class Security {

    public static function lenght($string, $min = 5, $max = 20) {
        if (in_array(mb_strlen($string), range($min, $max))) {
            return true;
        } else {
            return false;
        }
    }
    public static function regex($string, $regexNr = 0, $customRegex = "") {
        $regex[-1] = $customRegex;
        $regex = array('/^[a-zA-Z0-9_]*$/', '/^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4})*$/', '/^[a-zA-Z]*$/', '/^[0-9]*$/');
        $pattern = $regex[$regexNr];

        if (!$pattern) {
            return false;
        }

        if (preg_match($pattern, $string)) {
            return true;
        } else {
            return false;
        }
    }
    public static function IsPermissionsUser() {
        if (UserDetails::isLogged()) {
            return TRUE;
        } else{
            return FALSE;
        }
    }
    public static function IsUserLikePhoto($photoId) {
        $model = new LikeModel();
        return $model->isUserLikePhoto($photoId);  
    }
    public static function IsUserLikeCatalog($catalogId) {
        $model = new LikeModel();
        return $model->isUserLikeCatalog($catalogId);  
    }
}
