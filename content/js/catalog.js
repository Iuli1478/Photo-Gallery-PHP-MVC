function deleteCatalog(){
    
    var url = "/catalog/delete/" + $('#catalogIdConfirm').val() + "/" + $('#catalogUserId').val();
   $.post(url, function() {
       
        if ($('#adminTrue').html() == "admin") {
            window.location.href = '/catalog/adminGetAll';
        } else{
            window.location.href = '/catalog';
        }
  }); 
}
function getPhoto(catalogId, catalogUserId){
    window.location.href = '/photos/PhotosByCatalog/' + catalogId + "/" + catalogUserId;
}
function confirmDelete(name, id, catalogUserId){
    $('.categoyName').val(name);
    $('#catalogIdConfirm').val(id);
    $('#catalogUserId').val(catalogUserId);
    $('#confirmDeleteModal').modal('show');
}
function addCatalog(){
    if ($('#adminTrue').html() == "admin") {
        $('#isAdmin').val('true');
    }
    $('#addCatalogModal').modal('show');
}
function editCatalog(name, description, id, categoryId, UserId){
    if ($('#adminTrue').html() == "admin") {
        $('#isAdminEdit').val('true');
    }
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
        var likes = $('#likesContent' + catalogId).html();
        var newLike  = parseInt(likes) + 1;
        $('#likesContent' + catalogId).html(newLike);
    });
}

function unLikeCatalog(catalogId){
    var url = "/catalog/unLikeCatalog/" + catalogId;
    $.post(url, function() {
        $('#likeCatalog' + catalogId).show();
        $('#unLikeCatalog' + catalogId).hide();
        var likes = $('#likesContent' + catalogId).html();
        var newLike  = parseInt(likes) - 1;
        $('#likesContent' + catalogId).html(newLike);
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