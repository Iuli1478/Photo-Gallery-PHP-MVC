function editPhoto(Id, catalogUserId, photoName, photoDescription, catalogIdEdit){
    $('#Id').val(Id);
    $('#catalogUserIdEdit').val(catalogUserId);
    $('#photoNameEdit').val(photoName);
    $('#photoDescriptionEdit').val(photoDescription);
    $('#catalogIdEdit').val(catalogIdEdit);
    $('#editPhotoModal').modal('show');
}

function deletePhoto(photoId, catalogId, catalogUserId)
{
    $('#photoId').val(photoId);
    $('#catalogId').val(catalogId);
    $('#catalogUserId').val(catalogUserId);
    $('#confirmDeleteModal').modal('show');
}
function addComment(photoId){
    $('#photoId').val(photoId);
    $('#addCommentModal').modal('show');
}

function showComments(){
    $('#showComments').hide();
    $('#hideComments').show();
    $('#comments').show();
}

function hideComments(){
    $('#showComments').show();
    $('#hideComments').hide();
    $('#comments').hide();
}

function likePhoto(photoId){
    var url = "/photos/likePhoto/" + photoId;
    $.post(url, function() {
       $('#likePhoto').hide();
       $('#unLikePhoto').show();
        var likes = $('#likesContent').html();
        var newLike  = parseInt(likes) + 1;
        $('#likesContent').html(newLike);
    });
}

function unLikePhoto(photoId){
    debugger;
    var url = "/photos/unLikePhoto/" + photoId;
    $.post(url, function() {
        $('#likePhoto').show();
        $('#unLikePhoto').hide();
        var likes = $('#likesContent').html();
        var newLike  = parseInt(likes) - 1;
        $('#likesContent').html(newLike);
    });
}