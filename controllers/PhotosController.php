<?php

class PhotosController extends BaseController {
    public function Index() {
        
    }
    
    public function AddPhoto() {
        if ($this->isPost) {
            $model = new PhotoModel();
            
            $imgName = $_FILES['upfile']['name'];
            
            if ($imgName != '') {
                $filesize = $_FILES['upfile']['size'];
                $imageFileType = strtolower(pathinfo($imgName, PATHINFO_EXTENSION));
                $max_file_size = 3072; // KB 
                $upload_path = "./content/photos";
                $imgErr = $_FILES["upfile"]["error"];
                $tempName = $_FILES['upfile']['tmp_name'];
                $upload_slash = "/";

                $model->UploadImage($imageFileType, $filesize, $max_file_size, $tempName, $upload_path, $imgErr, $upload_slash);

                $upload = trim($_FILES['upfile']['name'] );
                $name = trim($_POST['photoName']);
                $description = trim($_POST['photoDescription']);
                $catalogId = $_POST['photoWithCatalogIdId'];
                
                if ((!isset($_SESSION['msgContentImgErr']) && ($catalogId != NULL))) {
                    if ($model->AddPhoto($name, $description, $upload, $catalogId)) {
                        $this->addInfoMessage($_SESSION['msgContent']);
                    } else{
                        $this->addErrorMessage($_SESSION['msgContent']);
                    }  
                } else{
                      $this->addErrorMessage($_SESSION['msgContentImgErr']);
                      unset($_SESSION['msgContentImgErr']);
                }  
            } else{
                $this->addErrorMessage("Моля изберете снимка");
            }
        }
        $this->redirect('catalog');
    }
}
