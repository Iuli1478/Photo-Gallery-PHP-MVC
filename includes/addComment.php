<!-- Modal addComent-->
<div style="text-align: left" class="modal fade" id="addCommentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div style="text-align: center" class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Добавяне на коментар</h4>
      </div>
        <form enctype="multipart/form-data" role="form" method="post" action="/comment/AddComment">
            <input type="hidden" name="catalogId"  id="catalogId"/>
            <input type="hidden" name="photoId"  id="photoId"/>
            <div class="modal-body">
                <div class="form-group">
                     <label for="comment"> Коментар:  </label>
                     <textarea name="comment" class="form-control" rows="5" id="comment" placeholder="Коментар"></textarea>
               </div>
                <div class="modal-footer">
                       <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Откажи</button>
                       <input type="submit" name="save" class="btn btn-success pull-right" value="Добави" />
                </div>
            </div>
        </form>
    </div>
  </div>
</div>
