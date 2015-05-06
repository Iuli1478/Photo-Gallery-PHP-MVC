<?php

class CommentController extends BaseController {
    public function GetAll() {
        
    }
    public function AddComment() {
        if ($this->isPost) {
            $model = new CommentModel();

            $description = trim($_POST['comment']);
            $catalogId = $_POST['catalogId'];

            if ($model->AddNew($description, $catalogId)) {
                $this->addInfoMessage($_SESSION['msgContent']);
            } else {
                $this->addErrorMessage($_SESSION['msgContent']);
            }
            
            $this->redirect('gallery');
        }  
    }
}
