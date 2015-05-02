<?php

class UserDetails {
    public static function isLogged() {
        if (isset($_SESSION['user']) && isset($_SESSION['pass'])) {
            return true;
        } else {
            return false;
        }
    }
}
