
<?php
if (isset($this->catalogs)) {
     foreach ($this->catalogs as $catalog){
        echo '<a href="/photos/PhotosByCatalog/'.$catalog['Id'].'/'.$catalog['UserId'].' ">';
            echo '<div class="galeryAlbum">';
            echo '<h3 class="center">' . htmlspecialchars($catalog['Name']) . '</h3>';
            echo '<div class="row">';
                echo '<div class="col-md-6 col-xs-12 col-lg-6 galeryCatalogImage"><img src="/content/galleryPhoto/' . htmlspecialchars($catalog['image']) . '" alt="картинак на албум"/></div>';
                echo '<div class="col-md-4 col-xs-5 col-lg-4 galeryCatalogDescription">' . htmlspecialchars($catalog['Description']) . '</div>';
                if (UserDetails::isLogged()){
                    echo '<div class="col-md-2 col-xs-4 col-lg-2"><a style="cursor:pointer;" onclick="addComent('.$catalog['Id'].')">Добави коментар</a></div>';
                }
                echo '<div class="col-md-2 col-xs-4 col-lg-2">'
                . '<a style="cursor:pointer;" id="showComment' . $catalog['Id'] . '" onclick="showComment(' . $catalog['Id'] . ')">Покажи коментарите</a>'
                . '<a style="display:none; cursor:pointer;" id="hideComment' . $catalog['Id'] . '" onclick="hideComment(' . $catalog['Id'] . ')" >Скрий коментарите</a>'
                        . '</div>';
            echo '</div>';
            echo '<div style="display:none;" class="catalogComents' . $catalog['Id'] . '">';
              foreach ($this->comments as $comment){
                  if ($comment['CatalogId'] == $catalog['Id']) {
                      echo '<div>';
                           echo $comment['UserName'] . ':' .  htmlspecialchars($comment['Description']);
                      echo '</div>';
                  }
              }
            echo '</div>';
            echo '<div class="clear"></div>';
            echo '</div>';
        echo '</a>';    
     }
 }
 ?>
