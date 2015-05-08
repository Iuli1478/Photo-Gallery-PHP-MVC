function deleteCatalog(){
    var url = "/catalog/delete/" + $('#catalogIdConfirm').val() + "/" + $('#catalogUserId').val();
   $.post(url, function() {
        window.location.href = 'catalog';
  }); 
}
function confirmDelete(name, id, catalogUserId){
    $('.categoyName').val(name);
    $('#catalogIdConfirm').val(id);
    $('#catalogUserId').val(catalogUserId);
    $('#confirmDeleteModal').modal('show');
}
function editCatalog(name, description, id, categoryId, UserId){
    $('.editCatalogName').val(name);
    $('.editCatalogDescription').val(description);
    $('#UserId').val(UserId);
    $('#catalogId').val(id);
    $('#categoryId').val(categoryId);
    $('#editCatalogModal').modal('show');
}
function addPhoto(catalogId){
    $('#photoWithCatalogIdId').val(catalogId);
    $('#addPhotoModal').modal('show');
}
function likeCatalog(catalogId){
    var url = "/catalog/likeCatalog/" + catalogId;
    $.post(url, function() {
       $('#likeCatalog' + catalogId).hide();
       $('#unLikeCatalog' + catalogId).show();
        var likes = $('#likesContent').html();
        var newLike  = parseInt(likes) + 1;
        $('#likesContent').html(newLike);
    });
}

function unLikeCatalog(catalogId){
    var url = "/catalog/unLikeCatalog/" + catalogId;
    $.post(url, function() {
        $('#likeCatalog' + catalogId).show();
        $('#unLikeCatalog' + catalogId).hide();
        var likes = $('#likesContent').html();
        var newLike  = parseInt(likes) - 1;
        $('#likesContent').html(newLike);
    });
}
function deleteComment(commentId, commentUserId){
    debugger;
    $('#commentIdDelete').val(commentId);
    $('#commentUserIdDelete').val(commentUserId);
    $('#confirmDeleteModal').modal('show');
}

function editComment(commentId, commentUserId, description){
    $('#commentId').val(commentId);
    $('#commentUserId').val(commentUserId);
    $('#description').val(description);
    $('#editCommentModal').modal('show');
}