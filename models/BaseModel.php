<?php

abstract class BaseModel {
    protected static $db;

    public function __construct() {
      if (self::$db == null) {
        self::$db = new mysqli(
          DB_HOST, DB_USER, DB_PASS, DB_NAME);
          self::$db->set_charset('utf8');
        if (self::$db->connect_errno) {
          die('Cannot connect to database');
        }
      }
    }
    
    public function UploadImage($imageFileType, $filesize, $max_file_size, $tempName, $upload_path, $imgErr, $upload_slash){
      sleep(1);
      if (!isset($imgErr))
      {
         $_SESSION['msgContentImgErr'] = "Възникна грешка при качването на картинката моя опитайте отново";
      } else{
          if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
               && $imageFileType != "gif" ) {
              $_SESSION['msgContentImgErr'] = "Непознат формат при качването на изображение, разрешените формати са JPG, JPEG, PNG & GIF";

          } else if($filesize == 0 || $filesize > ($max_file_size*1024) ) {
              $_SESSION['msgContentImgErr'] = "Размерът на изображението трябва да бъде под ".($max_file_size)." KB! ".
                                               "Текущ размер ".round($filesize/1024)." KB";
          } else{
              if (is_uploaded_file($tempName)) {
                      move_uploaded_file($tempName, $upload_path.$upload_slash.$_FILES['upfile']['name']);
              } 
          }
      }
    }
}