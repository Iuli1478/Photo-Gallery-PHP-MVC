function deleteCatalog(){
    var url = "/catalog/delete/" + $('#catalogIdConfirm').val();
    debugger;
   $.post(url, function() {
        window.location.href = 'catalog'
  }); 
}
function editCatalog(name, description, id){
    $('.editCatalogName').val(name);
    $('.editCatalogDescription').val(description);
    $('#catalogId').val(id);
    $('#editCatalogModal').modal('show');
}
function confirmDelete(name, id){
    $('.categoyName').val(name);
    $('#catalogIdConfirm').val(id);
    $('#confirmDeleteModal').modal('show');
}
function addPhoto(catalogId){
    debugger;
    $('#photoWithCatalogIdId').val(catalogId);
    $('#addPhotoModal').modal('show');
}