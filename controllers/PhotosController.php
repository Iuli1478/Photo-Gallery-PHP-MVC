<?php

class PhotosController extends BaseController {
    public function Index() {
        
    }
    
    public function getPhotoById($Id) {
        $model = new PhotoModel();
        $commentModel = new CommentModel();
        
        $photo = $model->getPhotoById($Id);
        
        if ($photo) {
            $this->comments = $commentModel->getAllPhotoComments($Id);
            $this->photo = $photo;
            return $this->renderView("photoById");
        } else {
            $this->addErrorMessage("Възникна грешка моля опитайте отново");
        }
    }
    
    public function PhotosByCatalog($catalogId, $catalogUserId) {
        $model = new PhotoModel();
        
        $this->photosByCatalog = $model->getByCatalog($catalogId);
        $this->catalogId = $catalogId;
        $this->catalogUserId = $catalogUserId;
        
        $this->renderView("photosByCatalog");
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
    
    public function EditPhoto() {
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
            }
            
            $upload = trim($_FILES['upfile']['name'] );
            $name = trim($_POST['photoName']);
            $description = trim($_POST['photoDescription']);
            $Id = $_POST['Id'];
            $catalogUserId = $_POST['catalogUserId'];
            $catalogId = $_POST['catalogId'];
            
            
            if ((!isset($_SESSION['msgContentImgErr']))) {
                if ($model->EditPhoto($name, $description, $upload, $Id, $catalogUserId)) {
                    $this->addInfoMessage($_SESSION['msgContent']);
                } else{
                    $this->addErrorMessage($_SESSION['msgContent']);
                }  
            } else{
                  $this->addErrorMessage($_SESSION['msgContentImgErr']);
                  unset($_SESSION['msgContentImgErr']);
            }  
        }
        $parms = array($catalogId, $catalogUserId);

        $this->redirect('photos', 'photosByCatalog', $parms);
    }
    
    public function deletePhoto() {
        
        $model = new PhotoModel();

        if ($this->isPost) {
            
            $id = $_POST['photoId'];
            $catalogId = $_POST['catalogId'];
            $catalogUserId = $_POST['catalogUserId'];
            
            if ($model->deletePhoto($id, $catalogUserId)) {
                $this->addInfoMessage($_SESSION['msgContent']);
            } else{
                $this->addErrorMessage($_SESSION['msgContent']);
            }

            $parms = array($catalogId, $catalogUserId);
            
            $this->redirect('photos', 'photosByCatalog', $parms);
        }
    }
    
    public function likePhoto($photoId) {
        $model = new PhotoModel();
        
        if ($model->likePhoto($photoId)) {
            return '';
        } else{
            return $_SESSION['msgContent'];
        }
    }
    
    public function unLikePhoto($photoId) {
        $model = new PhotoModel();
        
        if ($model->unLikePhoto($photoId)) {
            return '';
        } else{
            return $this-> $_SESSION['msgContent'];
        }
    }
}
