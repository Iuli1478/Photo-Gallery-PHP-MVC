<?php

class CommentController extends BaseController {
    public function GetAll() {
        
    }
    
    public function AddComment() {
        if ($this->isPost) {
            $model = new CommentModel();

            $description = trim($_POST['comment']);
            $catalogId = $_POST['catalogId'];
            $photoId = $_POST['photoId'];
            
            if ($model->AddNew($description, $catalogId, $photoId)) {
                $this->addInfoMessage($_SESSION['msgContent']);
            } else {
                $this->addErrorMessage($_SESSION['msgContent']);
            }

            if ($photoId != ''){
                $parms = array($photoId);
                return $this->redirect("photos", "getPhotoById", $parms);
            }
            return $this->redirect('gallery');
        } 
    }
    
    public function delete() {
        
        $model = new CommentModel();
        
        $id = $_POST['commentId'];
        $photoUserId = $_POST['photoUserId'];
        $photoId = $_POST['currPhotoId'];
        
        if ($model->delete($id, $photoUserId)) {
            $this->addInfoMessage($_SESSION['msgContent']);
        } else{
            $this->addErrorMessage($_SESSION['msgContent']);
        }
        
        $parms = array($photoId);
        return $this->redirect("photos", "getPhotoById", $parms);
    }
    
    public function edit() {
        
        $model = new CommentModel();
        
        $Id = $_POST['commentId'];
        $commentUserId = $_POST['commentUserId'];
        $description = trim($_POST['description']);
        $isCatalog = $_POST['isCatalog'];
        $photoId = $_POST['photoIdEdit'];
        
        if ($model->edit($Id, $commentUserId, $description)) {
            $this->addInfoMessage($_SESSION['msgContent']);
        } else{
            $this->addErrorMessage($_SESSION['msgContent']);
        }
        
        if ($isCatalog == 1) {
             return $this->redirect("gallery");
        } else {
            $parms = array($photoId);
            return $this->redirect("photos", "getPhotoById", $parms);
        }
        
    }
    
}
