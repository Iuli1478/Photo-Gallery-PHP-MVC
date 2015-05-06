
<?php
if (isset($this->catalogs)) {
     foreach ($this->catalogs as $catalog){
        echo '<div class="galeryAlbum">';
        echo '<h3 class="center">' . htmlspecialchars($catalog['Name']) . '</h3>';
        echo '<div class="row">';
            echo '<div class="col-md-6 col-xs-12 col-lg-6 galeryCatalogImage"><img src="/content/galleryPhoto/' . $catalog['image'] . '" alt="картинак на албум"/></div>';
            echo '<div class="col-md-4 col-xs-5 col-lg-4 galeryCatalogDescription">' . $catalog['Description'] . '</div>';
            if (UserDetails::isLogged()){
                echo '<div class="col-md-2 col-xs-4 col-lg-2"><a onclick="addComent('.$catalog['Id'].')" href="#">Добави коментар</a></div>';
            }
            echo '<div class="col-md-2 col-xs-4 col-lg-2">'
            . '<a id="showComment' . $catalog['Id'] . '" onclick="showComment(' . $catalog['Id'] . ')" href="#">Покажи коментарите</a>'
            . '<a style="display:none;" id="hideComment' . $catalog['Id'] . '" onclick="hideComment(' . $catalog['Id'] . ')" href="#">Скрий коментарите</a>'
                    . '</div>';
        echo '</div>';
        echo '<div style="display:none;" class="catalogComents' . $catalog['Id'] . '">';
          foreach ($this->comments as $comment){
              if ($comment['CatalogId'] == $catalog['Id']) {
                  echo '<div>';
                       echo $comment['UserName'] . ':' .  $comment['Description'];
                  echo '</div>';
              }
          }
        echo '</div>';
        echo '<div class="clear"></div>';
        echo '</div>';
     }
 }
 ?>
