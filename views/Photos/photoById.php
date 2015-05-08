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
//        foreach ($this->comments as $comment) {
//            echo '<div> <span>' . $comment['UserName'] . ': ' . $comment['Description'] . '</span>'; 
//            echo '<a href="/comment/delete/' . $comment['Id'] . '/' . $comment['UserId'] . '/' . $photo['Id'] . ' " style="cursor:pointer; width:10px;" class="iconsCatalog rightSpase"> <i class="fa fa-trash-o"></i></a>';
//            echo '</div>'; 
//        }
        
        foreach ($this->comments as $comment){
              if ($comment['PhotoId'] == $photo['Id']) {
                echo '<div class="row">';
                    echo '<div class="col-md-5 col-xs-10 col-lg-5 photoComents">';
                         echo '<span class="commentName">' . $comment['UserName'] . ':</span> ' .  htmlspecialchars($comment['Description']);
                    echo '</div>';
                    if (UserDetails::isLogged() && $comment['UserId'] == UserDetails::getUserId()) {
                      echo '<div class="col-md-2 col-xs-2 col-lg-2 photoComentsBtn">';
                           echo '<span style="cursor:pointer;" class="iconsCatalog">'
                             . '<i onclick="editCommentModal(' . $comment['Id'] . ', ' . $comment['UserId'] . ', \'' . str_replace("'", "", htmlspecialchars($comment['Description']))  . '\', '. $photo['Id'] .')" '
                             . 'title="редакция" class="fa fa-pencil rightSpase"></i>';
                           echo '<i onclick="deleteComment(' . $comment['Id'] . ', ' . $comment['UserId'] . ', ' . $photo['Id'] . ')" title="изтриване" class="fa fa-trash-o rightSpase"></i></span>' ;
                      echo '</div>'; 
                    }
                echo '</div>';
              }
          }
        
    }
    echo '</div>';   
}
?>
<div class="clear"></div>
<script src="/content/js/photo.js" type="text/javascript"></script>

<?php
require '/includes/addComment.php';
require 'editComment.php';
?>
<!-- Modal confirmDelete-->
<div style="text-align: left" class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div style="text-align: center" class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                 <h4 class="modal-title" id="myModalLabel">Наистина ли искате да изтриете този коментар ?</h4>
            </div>
            <form enctype="multipart/form-data" role="form" action="/comment/delete/'" method="post">
                <input id="commentId" type="hidden" name="commentId" />
                <input id="photoUserId" type="hidden" name="photoUserId" />
                <input id="currPhotoId" type="hidden" name="currPhotoId" />
                <div class="modal-footer">
                       <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Не</button>
                       <input type="submit" name="save" class="btn btn-success pull-right" value="Да" />
                </div>
            </form>
        </div>  
    </div>
</div>