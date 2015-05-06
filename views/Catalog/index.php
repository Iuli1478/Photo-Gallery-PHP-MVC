<?php
if (!Security::IsPermissionsUser()) {
    echo 'Нямате достъп до тази страница';
   exit($this->renderView("index")); 
}


?>
<span class="btn btn-success addCAtalog" data-toggle="modal" data-target="#addCatalogModal"><i class="fa fa-plus"></i></span>

<div class="row">
    
    <div class="col-md-1 col-xs-1 col-lg-1"></div>
    <div class="col-md-10 col-xs-10 col-lg-10 categories">
        <?php
        if (isset($this->catalogs)) {
            foreach ($this->catalogs as $catalog){
                echo "<span style='cursor:pointer;' class='categoryContent' title='" . htmlspecialchars($catalog['Description']) . "' href='#'>  ";
                    echo '<div  class="col-md-3 col-xs-10 col-lg-2 category">';
                        echo "<div class='row'>";
                            echo '<div class="col-md-12 col-xs-12 col-lg-12 categoryTitle">  <span onclick="editCatalog(\''.htmlspecialchars($catalog['Name']).'\',\''.htmlspecialchars($catalog['Description']).'\')" title="Редакция"><img src="/content/img/edit.png" alt=""/></span><span>' . htmlspecialchars($catalog['Name']) . '</span>';  
                                 echo '<a title="Изтриване" href="catalog/delete/' . $catalog['Id'] . '"> <img src="/content/img/delete.png" alt="изтриване"/></a>';
                            echo  '</div>';
                        echo "</div>";
                        echo "<div class='row'>";
                             echo '<img class="categoryImg" src="../content/galleryPhoto/' . htmlspecialchars($catalog['image']) . '" alt=""/>';
                         echo "</div>";
                    echo "</div>";
                echo '</span>';
            }
        }
        ?>
    </div>
    <div class="col-md-1 col-xs-1 col-lg-1"></div>
</div>
<script>


    function editCatalog(name, description){
        debugger;
        $('.editCatalogName').val(name);
        $('.editCatalogDescription').val(description);
        $('#editCatalogModal').modal('show');
    }

       
    

</script>
<!-- Modal addCatalog-->
<div style="text-align: left" class="modal fade" id="addCatalogModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div style="text-align: center" class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Добавяне на нов каталог</h4>
      </div>
        <form enctype="multipart/form-data" role="form" method="post" action="/catalog/AddNew">
            <div class="modal-body">
               <div class="form-group">
                     <label for="name">Име на каталога</label>
                     <input name="catalogName" type="text" class="form-control" id="name" placeholder="Име">
               </div>
                <div class="form-group">
                     <label for="description"> Описание  </label>
                     <textarea name="catalogDescription" class="form-control" rows="5" id="description" placeholder="Описание"></textarea>
               </div>
                <div class="form-group">
                     <label for="background">Изберете картинка за фон</label>
                     <input type="file" name="upfile"> 
               </div>
                <div class="modal-footer">
                       <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Откажи</button>
                       <input type="submit" name="save" class="btn btn-success pull-right" value="Запази" />
                </div>
            </div>
        </form>
    </div>
  </div>
</div>

<!-- Modal editCatalog-->
<div style="text-align: left" class="modal fade" id="editCatalogModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div style="text-align: center" class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Редакция на каталог</h4>
      </div>
        <form enctype="multipart/form-data" role="form" method="post" action="/catalog/AddNew">
            <div class="modal-body">
               <div class="form-group">
                     <label for="name">Име на каталога</label>
                     <input name="catalogName" type="text" class="form-control editCatalogName" id="name" placeholder="Име">
               </div>
                <div class="form-group">
                     <label for="description"> Описание  </label>
                     <textarea name="catalogDescription" class="form-control editCatalogDescription" rows="5" id="description" placeholder="Описание"></textarea>
               </div>
                <div class="modal-footer">
                       <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Откажи</button>
                       <input type="submit" name="save" class="btn btn-success pull-right" value="Запази" />
                </div>
            </div>
        </form>
    </div>
  </div>
</div>

<div class="clear"></div>
    