<?php

class CatalogController extends BaseController {
    public function Index() {
        
        $model = new CatalogModel();
        
        $this->catalogs = $model->getAll();
        
        $this->renderView("index");
    }
    
    public function Delete($Id) {
        $model = new CatalogModel();
         if ($model->delete($Id)) {
            $this->addInfoMessage('каталогът беше успешно изтрит');
        } else{
            $this->addErrorMessage('възникна грешка моля опитайте отново');
        }
         $this->redirect('catalog');
    }
    
    public function AddNew() {
        
        if ($this->isPost) {
            //////////////////////////////////////////////////////////////////////////////////////
            
		$max_file_size = 1000000000; // in KB !
                $upload_path = "./content/galleryPhoto";
                $upload_slash = "/"; //can be / or \\ (Linux or Windows)

		function raise_upload_error($error_msg) {
			die("Error: ".$error_msg);
		}


                    sleep(1);
                    //CHECK FOR ERRORS
                    if (!isset($_FILES["upfile"]["error"]))
                            raise_upload_error("Upload error");
 

                    //UPLOAD FILE FROM USER FORM TO PRE-DEFINED FOLDER
                    if (is_uploaded_file($_FILES['upfile']['tmp_name'])) {
                            move_uploaded_file($_FILES['upfile']['tmp_name'], $upload_path.$upload_slash.$_FILES['upfile']['name']);

                            //DETECT FILESIZE
                            echo "&nbsp; <br/>";
                            $filesize = $_FILES['upfile']['size'];
                            if($filesize == 0 || $filesize > ($max_file_size*1024) ) {
                                    raise_upload_error( "File size must be under ".($max_file_size)." KB !!! <br/>".
                                                                            "Current filesize = ".round($filesize/1024)." KB  <br/>");
                            }

                            echo "File <b>". $_FILES['upfile']['name'] ."</b> uploaded successfully.\n<br>";
                            echo "Type: ".$_FILES['upfile']['type']."<br/>";			
                            echo "Filesize:  ".$filesize." bytes / ".round($filesize/1024)." KB / ".round(($filesize/1024)/1024)." MB \n<br>";
                    } 
                    


            //////////////////////////////////////////////////////////////////////////////////////
            
            $model = new CatalogModel();
            $upload = trim($_FILES['upfile']['name'] );
            if ($upload == '') {
                $upload = "noImg.png";
            }
            $name = trim($_POST['catalogName']);
            $description = trim($_POST['catalogDescription']);

            if ($model->AddCatalog($name, $description, $upload)) {
                $this->addInfoMessage($_SESSION['msgContent']);
            } else{
                $this->addErrorMessage($_SESSION['msgContent']);
            }
        }
         $this->redirect('catalog');
    }

}
