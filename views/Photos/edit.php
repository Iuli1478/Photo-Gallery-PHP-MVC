<!-- Modal editPhoto-->
<div style="text-align: left" class="modal fade" id="editPhotoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div style="text-align: center" class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Редакция на снимка</h4>
      </div>
        <form enctype="multipart/form-data" role="form" method="post" action="/photos/EditPhoto">
            <input type="hidden" name="Id" id="Id">
            <input type="hidden" name="catalogUserId" id="catalogUserIdEdit">
            <input type="hidden" name="catalogId" id="catalogIdEdit">
            <div class="modal-body">
               <div class="form-group">
                     <label for="name">Име на снимката</label>
                     <input name="photoName" type="text" class="form-control" id="photoNameEdit" placeholder="Име">
               </div>
                <div class="form-group">
                     <label for="description"> Описание  </label>
                     <textarea name="photoDescription" class="form-control" rows="5" id="photoDescriptionEdit" placeholder="Описание"></textarea>
               </div>
                <div class="form-group">
                     <label for="background">Изберете снимка ако искате да смените текущата</label>
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