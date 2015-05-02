<?php

class AuthoursController extends BaseController {
    public function onInit() {
        $this->onInitTest = "this is onInit function";
    }
    
    public function Index() {
        
        $model = new AuthorsModel();
        
        $this->authors = $model->getAll();
    }

    public function Create(){
        if ($this->isPost) {
            //TODO: save user in DB
        } else{
            //GET user From DB
        }
        
        if ($this->isPost) {
            $model = new AuthorsModel();
            $name = $_POST['user_name'];
            
            if ($model->createUser($name)) {
                $this->redirect('authours');
                $this->addInfoMessage("Author created.");
            }   else {
                $this->addErrorMessage("Error creating author.");
            }
            
            
            /*if ($this->db->createUser($name)) {
                $this->addInfoMessage("user created.");
                $this->redirect('authors');
            } else {
                $this->addErrorMessage("Error creating user.");
            }*/
        }
        
    }
}
