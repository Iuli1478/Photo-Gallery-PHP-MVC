 <div class="row" style="margin-right: 0">
    
    <div class="col-md-1 col-xs-1 col-lg-1"></div>
    <div class="col-md-10 col-xs-10 col-lg-10 products">
        
        <div class="row" style="margin-right: 0">
        <?php
        if (count($this->photosByCatalog) <= 0) {
            echo '<h1>Няма налични снимки в този албум</h1>';
        } else{
            foreach ($this->photosByCatalog as $photo){
                //echo '<div>' . $photo['Name'] . '</div>';
                echo "<span class=\"col-md-4 col-xs-10 col-lg-4 product\">";            
                    echo '<div>';
                        if ($this->catalogUserId == UserDetails::getUserId()) {
                            echo '<span class="iconsCatalog">';
                            echo '<i style="cursor:pointer;" onclick="editPhoto( ' . $photo['Id'] . ', ' . $this->catalogUserId . ' , \'' . str_replace("'", "\'", htmlspecialchars($photo['Name']))
                                    . " ', '" . str_replace("'", "\'", htmlspecialchars($photo['Description'])) . "', {$this->catalogId})\" title='редакция' class='fa fa-pencil rightSpase'></i>";
                                    
                            echo "<i style='cursor:pointer;' onclick='deletePhoto({$photo['Id']},{$this->catalogId},{$this->catalogUserId})' title='изтриване' class='fa fa-trash-o rightSpase'></i></span>" ;
                        }
                    echo "<a href='/photos/getPhotoById/{$photo['Id']}''>";
                        echo "<div class='row'>";
                            echo "<div class='col-md-12 col-xs-12 col-lg-12 productsTitle'>" . htmlspecialchars($photo['Name']) . "</div>";    
                        echo "</div>";
                        echo "<div class='row'>";
                            echo "<div class='col-md-12 col-xs-12 col-lg-12 productsImgContent'>";
                                echo "<img class='productsImg' src='/content/photos/{$photo['Image']}' alt='Снимката'/>";
                            echo "</div>"; 
                        echo "</div>";
                        echo '<div class="clear"></div>';
                        echo "<div class='row'>";
                            echo "<div class='col-md-11 col-xs-11 col-lg-11 summaryContent'\">" . htmlspecialchars($photo['Description']) . "</div>";
                        echo "</div>";
                    echo "</a>";   
                     echo "<a style='float:right;' href='/content/photos/{$photo['Image']}' download='image.png'>Свали снимката</a><div class='clear'></div>";
                    echo "</div>";
                echo '</span>';
            }
        }
        ?>
        </div>
    </div>
    <div class="col-md-1 col-xs-1 col-lg-1"></div>
</div>

<script src="/content/js/photo.js" type="text/javascript"></script>

<!-- Modal confirmDelete-->
<div style="text-align: left" class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div style="text-align: center" class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                 <h4 class="modal-title" id="myModalLabel">Наистина ли искате да изтриете тази снимка ?</h4>
            </div>
            <form enctype="multipart/form-data" role="form" action="/photos/deletePhoto" method="post">
                <input id="photoId" type="hidden" name="photoId" />
                <input id="catalogId" type="hidden" name="catalogId" />
                <input id="catalogUserId" type="hidden" name="catalogUserId" />
                <div class="modal-footer">
                       <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Не</button>
                       <input type="submit" name="save" class="btn btn-success pull-right" value="Да" />
                </div>
            </form>
        </div>  
    </div>
</div>
<script src="/content/js/catalog.js" type="text/javascript"></script>

<?php
    require 'edit.php';
?>

<div class="clear"></div>
