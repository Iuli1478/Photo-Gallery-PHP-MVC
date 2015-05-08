<?php
foreach ($this->photo as $photo) {
    echo '<div calss="row">';
        echo '<div class="col-md-10 col-xs-10 col-lg-10 productTitle">';
            echo '<h2> ' . htmlspecialchars($photo['Name']) . ' </h2>';
        echo '</div>';
    echo '</div>';
    
    echo '<div class="row">';
        echo '<img class="col-md-4 col-xs-11 col-lg-4 productImg space" src="/content/photos/' .  $photo['Image'] . '" alt="Снимката"/>';
            echo '<div class="col-md-3 col-xs-10 col-lg-3 quantityContent">';
                 echo '<h4>' . htmlspecialchars($photo['Description']) . '</h4>';
            echo '</div>';
        echo '<div class="row">';
            echo '<div class="col-md-5 col-xs-10 col-lg-5 quantityContent">';
                echo '<span class="likes">Харесвания: </span><span id="likesContent">' . htmlspecialchars($photo['Likes']) . '</span>';
            echo '</div>';
        echo '</div>';
    echo '</div>';
  
    echo '<div class="row">';
        echo '<div class="col-md-10 col-xs-10 col-lg-10 like">';
            if (UserDetails::isLogged()) {           
                    if (!Security::IsUserLikePhoto($photo['Id'])) {
                        echo '<a onclick="likePhoto(' . $photo['Id'] . ')" id="likePhoto" class="btn btn-default imgBtn" cursor:pointer;">Харесва ми</a>';
                        echo '<a onclick="unLikePhoto(' . $photo['Id'] . ')" id="unLikePhoto" style="display:none; imgBtn" class="btn btn-default" style="cursor:pointer;">Вече нехаресвам</a>';
                    } else {
                        echo '<a onclick="likePhoto(' . $photo['Id'] . ')" id="likePhoto" style="display:none;" class="btn btn-default imgBtn" cursor:pointer;">Харесва ми</a>';
                        echo '<a onclick="unLikePhoto(' . $photo['Id'] . ')" id="unLikePhoto" class="btn btn-default" style="cursor:pointer;">Вече нехаресвам</a>';
                    }
                echo '<a onclick="addComment(' . $photo['Id'] . ')" class="btn btn-success" style="width: 250px; margin: 2px; cursor:pointer;">Добави Коментар</a>';
            }
            echo '<a onclick="showComments()" id="showComments" class="btn btn-info imgBtn" style="cursor:pointer;">Покажи коментарите</a>';
            echo '<a onclick="hideComments()" id="hideComments" class="btn btn-danger imgBtn" style="display:none; cursor:pointer;">Скрии коментарите</a>';
        echo '</div>';
    echo '</div>';

    
    echo '<div id="comments" style="display:none;">';
    if (count($this->comments) <= 0) {
        echo '<h3> Тази снимка все още няма коментари </h3>';
    } else {
        foreach ($this->comments as $comment) {
            echo '<div> <span>' . $comment['UserName'] . ': ' . $comment['Description'] . '</span>'; 
            echo '<a href="/comment/delete/' . $comment['Id'] . '/' . $comment['UserId'] . '/' . $photo['Id'] . ' " style="cursor:pointer; width:10px;" class="iconsCatalog rightSpase"> <i class="fa fa-trash-o"></i></a>';
            echo '</div>'; 
        }
    }
    echo '</div>';   
}
?>
<div class="clear"></div>
<script src="/content/js/photo.js" type="text/javascript"></script>

<?php
require '/includes/addComment.php';
?>
