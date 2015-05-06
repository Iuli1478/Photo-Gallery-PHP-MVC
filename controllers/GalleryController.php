<?php

class GalleryController extends BaseController {
    
    public function Index($categoryId = '') {
        $catalogModel = new CatalogModel();
        $categoryModel = new CategoryModel();
        $commentModel = new CommentModel();
        $userModel = new UserModel();
        
        $this->categories = $categoryModel->getAll();
        $this->comments = $commentModel->getAll();
        $this->users = $userModel->getAll();
        
        if ($categoryId == '') {
             $this->catalogs = $catalogModel->getAll();
        } else{
             $this->catalogs = $catalogModel->getByCategoryId($categoryId);
             return $this->renderView("_catalogsByCategoryId", FALSE);
        }   
    }
}
