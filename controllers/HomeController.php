<?php

class HomeController extends BaseController {
    
    public function index() {
        $photoModel = new PhotoModel();
        $catalogModel = new CatalogModel();
       
        $this->photos = $photoModel->getTopNImage(10);
        $this->catalogs = $catalogModel->getTopN(10);
    } 
}
