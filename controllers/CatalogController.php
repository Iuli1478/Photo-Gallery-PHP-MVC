<?php

class CatalogController extends BaseController {
    public function Index() {
        $model = new CatalogModel();
        $modelCategory = new CategoryModel();
        
        if (isset($_SESSION['msgContentS'])) {
            $this->addInfoMessage($_SESSION['msgContentS']);
            unset($_SESSION['msgContentS']);
        } else if (isset($_SESSION['msgContentErr'])) {
            $this->addErrorMessage($_SESSION['msgContentErr']);
             unset($_SESSION['msgContentErr']);
        }
        $this->catalogs = $model->getAllById();
        $this->categories = $modelCategory->getAll();
        
        $this->renderView("index");
    }
    
    public function Delete($Id, $catalogUserId) {
        $model = new CatalogModel();
         if ($model->delete($Id, $catalogUserId)) {
             $_SESSION['msgContentS'] = "каталогът беше успешно изтрит";
        } else{
            $_SESSION['msgContentErr'] = "възникна грешка моля опитайте отново";
        }
    }
    
    public function DeleteComment() {
        $model = new CatalogModel();
        
        $Id = $_POST['commentId'];
        $commentUserId = $_POST['commentUserId'];
        
        if ($model->deleteComment($Id, $commentUserId)) {
           $this->addInfoMessage('Коментарът беше успешно изтрит');
        } else {
            $this->addErrorMessage($_SESSION['msgContent']);
        }
        return $this->redirect("gallery");
    }
    
    public function AddNew() {
        
        if ($this->isPost) {
            $model = new CatalogModel();
            
            $imgName = $_FILES['upfile']['name'];
            if ($imgName != '') {
                $filesize = $_FILES['upfile']['size'];
                $imageFileType = strtolower(pathinfo($imgName, PATHINFO_EXTENSION));
                $max_file_size = 3072; // KB 
                $upload_path = "./content/galleryPhoto";
                $imgErr = $_FILES["upfile"]["error"];
                $tempName = $_FILES['upfile']['tmp_name'];
                $upload_slash = "/";
                
                $model->UploadImage($imageFileType, $filesize, $max_file_size, $tempName, $upload_path, $imgErr, $upload_slash);
            }

            
            $upload = trim($_FILES['upfile']['name'] );
            if ($upload == '') {
                $upload = "noImg.png";
            }
            $name = trim($_POST['catalogName']);
            $description = trim($_POST['catalogDescription']);
            $category = $_POST['category'];
            
            if (!isset($_SESSION['msgContentImgErr'])) {
                if ($model->AddCatalog($name, $description, $upload, $category)) {
                    $this->addInfoMessage($_SESSION['msgContent']);
                } else{
                    $this->addErrorMessage($_SESSION['msgContent']);
                }  
            } else{
                  $this->addErrorMessage($_SESSION['msgContentImgErr']);
                  unset($_SESSION['msgContentImgErr']);
            }
        }
         $this->redirect('catalog');
    }
     
    public function editCatalog() {
        if ($this->isPost) {
            $model = new CatalogModel();
            $name = trim($_POST['catalogName']);
            $description = trim($_POST['catalogDescription']);
            $category = $_POST['category'];
            $userId = $_POST['catalogUserId'];
            $id = $_POST['id'];
            if ($model->EditCatalog($name, $description, $id, $category, $userId)) {
                 $this->addInfoMessage($_SESSION['msgContent']);
            } else{
                $this->addErrorMessage($_SESSION['msgContent']);
            }
            $this->redirect('catalog');
        }
    }
    
    public function likeCatalog($catalogId) {
        $model = new CatalogModel();
        
        if ($model->likeCatalog($catalogId)) {
            return '';
        } else{
            return $_SESSION['msgContent'];
        }
    }
    
    public function unLikeCatalog($catalogId) {
        $model = new CatalogModel();
        
        if ($model->unLikeCatalog($catalogId)) {
            return '';
        } else{
            return $this-> $_SESSION['msgContent'];
        }
    }
    
}
