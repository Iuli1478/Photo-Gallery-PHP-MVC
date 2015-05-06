<div id="catalogs" class="col-md-9 col-xs-10 col-lg-9 galeryMine">
    <?php
    require '_catalogsByCategoryId.php'; 
    ?>
</div>
<div class="col-md-3 col-xs-2 col-lg-3 galeryCatalog">
    <div class="center">
        <a href="/gallery">Всички</a>
    </div>
    <?php
    if (isset($this->categories)) {
        foreach ($this->categories as $category){
            echo '<div class="center">';
            echo '<a href="#" onclick="filterByCategory('.$category['Id'].')">' . htmlspecialchars($category['Name']) . '</a>';
            echo '</div>';
        }
    }
    ?>
</div>
<div class="clear"></div>

<?php
require 'addComment.php';
?>

<script>

function addComent(catalogId){
    $('#catalogId').val(catalogId);
    $('#addCommentModal').modal('show');
}

function filterByCategory(id){
    var url = "/gallery/index/" + id;
    $.post( url, function(data) {
        $("#catalogs").html( data );
    });
}
function showComment(catalogId){
    $('.catalogComents' + catalogId).show();
    $('#showComment' + catalogId).hide();
    $('#hideComment' + catalogId).show();
}
function hideComment(catalogId){
    $('.catalogComents' + catalogId).hide();
    $('#showComment' + catalogId).show();
    $('#hideComment' + catalogId).hide();
}
</script>