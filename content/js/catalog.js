function deleteCatalog(){
    var url = "/catalog/delete/" + $('#catalogIdConfirm').val();
   $.post(url, function() {
        window.location.href = 'catalog'
  }); 
}
function editCatalog(name, description, id, categoryId){
    $('.editCatalogName').val(name);
    $('.editCatalogDescription').val(description);
    $('#catalogId').val(id);
    $('#categoryId').val(categoryId);
    $('#editCatalogModal').modal('show');
}
function confirmDelete(name, id){
    $('.categoyName').val(name);
    $('#catalogIdConfirm').val(id);
    $('#confirmDeleteModal').modal('show');
}
function addPhoto(catalogId){
    $('#photoWithCatalogIdId').val(catalogId);
    $('#addPhotoModal').modal('show');
}