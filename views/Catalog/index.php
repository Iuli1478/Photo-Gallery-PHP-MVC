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
                            echo '<div class="col-md-12 col-xs-12 col-lg-12 categoryTitle"> '
                                 . ' <span onclick="editCatalog(\''.htmlspecialchars($catalog['Name']).'\',\''.htmlspecialchars($catalog['Description']).'\',' 
                                 . $catalog['Id'] . ')" title="Редакция"><img src="/content/img/edit.png" alt=""/></span><span>' . htmlspecialchars($catalog['Name']) . '</span>';  
                                 echo '<a title="Изтриване" onclick="confirmDelete(\''.htmlspecialchars($catalog['Name']).'\','. $catalog['Id'] .')" href="#"> <img src="/content/img/delete.png" alt="изтриване"/></a>';
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
<?php
    require 'add.php';
    require 'edit.php';
?>
<!-- Modal confirmDelete-->
<div style="text-align: left" class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div style="text-align: center" class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Сигурни ли сте, че изкате да изтриете категория <span class="categoyName"></span> </h4>
      </div>
        <form enctype="multipart/form-data" role="form" method="post">
            <input id="catalogIdConfirm" type="hidden" name="id" />
                <div class="modal-footer">
                       <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Не</button>
                       <input type="button" onclick="deleteCatalog()" name="save" class="btn btn-success pull-right" value="Да" />
                </div>
            </div>
        </form>
    </div>
  </div>
<script src="/content/js/catalog.js" type="text/javascript"></script>
<div class="clear"></div>
    