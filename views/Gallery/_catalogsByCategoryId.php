<?php
if (isset($this->catalogs)) {
    $isAdmin = UserDetails::isAdmin();
     foreach ($this->catalogs as $catalog){
        echo '<a href="/photos/PhotosByCatalog/'.$catalog['Id'].'/'.$catalog['UserId'].' ">';
            echo '<div class="galeryAlbum">';
            echo '<h3 class="center">' . htmlspecialchars($catalog['Name']) . '</h3>';
            echo '<div class="row">';
                echo '<div class="col-md-6 col-xs-12 col-lg-6 galeryCatalogImage"><img src="/content/galleryPhoto/' . htmlspecialchars($catalog['image']) . '" '
                        . 'alt="картинак на албум"/></div>';
                echo '<div class="col-md-4 col-xs-12 col-lg-4 galeryCatalogDescription">' . htmlspecialchars($catalog['Description']) . '</div>';
                if (UserDetails::isLogged()){
                    echo '<div class="col-md-4 col-xs-12 col-lg-4"><a class="btn btn-success btnCatalogComments" style="cursor:pointer;" '
                         . 'onclick="addComent('.$catalog['Id'].')">Добави коментар</a></div>';
                }
                echo '<div class="col-md-4 col-xs-12 col-lg-4">'
                    . '<a style="cursor:pointer;" class="btn btn-info btnCatalogComments" id="showComment' . $catalog['Id'] . '"'
                        . ' onclick="showComment(' . $catalog['Id'] . ')">Покажи коментарите</a>'
                    . '<a style="display:none;" class="btn btn-danger btnCatalogComments" id="hideComment' . $catalog['Id'] . '" '
                        . 'onclick="hideComment(' . $catalog['Id'] . ')" >Скрий коментарите</a>'
                . '</div>';
                $idUserLike = FALSE;
                if (isset($this->likes)) {
                    foreach ($this->likes as $like) {
                        if ($catalog['Id'] == $like['CatalogId'] ) {
                            $idUserLike = TRUE;
                             break;
                        }
                    }
                    if ($idUserLike == TRUE) {
                        echo '<div class="col-md-2 col-xs-12 col-lg-2">'
                        . '<a style="cursor:pointer; display:none;" class="btn btn-default btnCatalogComments" id="likeCatalog'.$catalog['Id'].'" '
                                . 'onclick="likeCatalog(' . $catalog['Id'] . ')">Харесва ми</a>'
                        . '<a style="cursor:pointer;" class="btn btn-default btnCatalogComments" id="unLikeCatalog'.$catalog['Id'].'" '
                                . 'onclick="unLikeCatalog(' . $catalog['Id'] . ')">Вече не харесвам</a>';
                        echo '</div>';
                    } else{
                        echo '<div class="col-md-2 col-xs-12 col-lg-2">'
                        . '<a style="cursor:pointer;" class="btn btn-default btnCatalogComments" id="likeCatalog'.$catalog['Id'].'" '
                                . 'onclick="likeCatalog(' . $catalog['Id'] . ')">Харесва ми</a>'
                        . '<a style="cursor:pointer;  display:none;" class="btn btn-default btnCatalogComments" id="unLikeCatalog'.$catalog['Id'].'"'
                                . ' onclick="unLikeCatalog(' . $catalog['Id'] . ')">Вече не харесвам</a>';
                        echo '</div>';
                    }
                }
            echo '</div>';
            echo '<span class="catalogLikes">Харесвания: <span id="likesContent'.$catalog['Id'].'">' . $catalog['Likes'] . '</span></span><div class="clear"></div>';
            echo '<div style="display:none;" class="catalogComents catalogComents'.$catalog['Id'].'">';
              $isComment = FALSE;
              foreach ($this->comments as $comment){
                  if ($comment['CatalogId'] == $catalog['Id']) {
                       $isComment = TRUE;
                      echo '<div class="col-md-10 col-xs-10 col-lg-10">';
                           echo '<span class="commentName">' . $comment['UserName'] . ':</span> ' .  htmlspecialchars($comment['Description']);
                      echo '</div>';
                      if (UserDetails::isLogged() && ($comment['UserId'] == UserDetails::getUserId() || $isAdmin)) {
                        echo '<div class="col-md-2 col-xs-2 col-lg-2">';
                             echo '<span style="cursor:pointer;" class="iconsCatalog"><i onclick="editComment(' . $comment['Id'] . ', ' 
                                     . $comment['UserId'] . ', \'' . str_replace("'", "", htmlspecialchars($comment['Description']))  . '\')" '
                                     . 'title="редакция" class="fa fa-pencil rightSpase"></i>';
                             echo '<i onclick="deleteComment(' . $comment['Id'] . ', ' . $comment['UserId'] . ')" '
                                     . 'title="изтриване" class="fa fa-trash-o rightSpase"></i></span>' ;
                        echo '</div>'; 
                      }
                  }
              }
              if (!$isComment) {
                    echo '<div class="col-md-10 col-xs-10 col-lg-10">';
                       echo 'Този албум все още няма коментари';
                    echo '</div>';
              }
            echo '</div>';
            echo '<div class="clear"></div>';
            echo '</div>';
        echo '</a>';    
     }
 }
require 'editComment.php';
 ?>
<script src="/content/js/catalog.js" type="text/javascript"></script>
<!-- Modal confirmDelete-->
<div style="text-align: left" class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div style="text-align: center" class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                 <h4 class="modal-title" id="myModalLabel">Наистина ли искате да изтриете този коментар ?</h4>
            </div>
            <form enctype="multipart/form-data" role="form" action="/catalog/DeleteComment" method="post">
                <input id="commentIdDelete" type="hidden" name="commentId" />
                <input id="commentUserIdDelete" type="hidden" name="commentUserId" /> 
                <div class="modal-footer">
                       <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Не</button>
                       <input type="submit" name="save" class="btn btn-success pull-right" value="Да" />
                </div>
            </form>
        </div>  
    </div>
</div>