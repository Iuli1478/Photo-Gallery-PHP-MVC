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
    
    public function delete($id, $photoUserId, $photoId) {
        
        $model = new CommentModel();
        
        if ($model->delete($id, $photoUserId)) {
            $this->addInfoMessage($_SESSION['msgContent']);
        } else{
            $this->addErrorMessage($_SESSION['msgContent']);
        }
        
        $parms = array($photoId);
        return $this->redirect("photos", "getPhotoById", $parms);
    }
}
