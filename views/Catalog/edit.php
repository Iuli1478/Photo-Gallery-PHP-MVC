<!-- Modal editCatalog-->
<div style="text-align: left" class="modal fade" id="editCatalogModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div style="text-align: center" class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Редакция на албум</h4>
      </div>
        <form enctype="multipart/form-data" role="form" method="post" action="/catalog/editCatalog">
            <input id="catalogId" type="hidden" name="id" />
            <div class="modal-body">
               <div class="form-group">
                     <label for="name">Име на албума</label>
                     <input name="catalogName" type="text" class="form-control editCatalogName" id="name" placeholder="Име">
               </div>
                <div class="form-group">
                     <label for="description"> Описание  </label>
                     <textarea name="catalogDescription" class="form-control editCatalogDescription" rows="5" id="description" placeholder="Описание"></textarea>
               </div>
                <div class="form-group">
                    <label for="description"> Категория  </label>
                    <select id="categoryId" name="category" class="btn btn-default">
                        <?php
                        if (isset($this->categories)) {
                            foreach ($this->categories as $category){
                                echo '<option value="'. $category['Id'] . '">' . $category['Name'] . '</option>';
                            }
                        }
                        ?>
                    </select>
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