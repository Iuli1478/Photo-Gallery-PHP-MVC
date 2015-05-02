<?php

class BooksController extends BaseController {

    public function onInit() {
        $this->title = "books";
    }
    
    public function Books() {
         $this->renderView("index");
    }
}
