<?php
if (UserDetails::isLogged()) {
?>
    <!-- Modal userDeteils-->
    <div style="text-align: left" class="modal fade" id="userDetailsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div style="text-align: center" class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Потребителски профил</h4>
          </div>
            <form role="form" method="post">
                <div class="modal-body">
                   <div class="form-group">
                         <label for="username_name"><i class="fa fa-user"></i> Потребителско Име</label>
                         <input name="user" disabled="disabled" type="text" value="<?= UserDetails::getUserName() ?>" class="form-control" id="username_name" placeholder="Потребителско име">
                   </div>
                    <div class="form-group">
                         <label for="username_name"><i class="fa fa-envelope-o"></i> Имейл адрес</label>
                         <input name="mail" disabled="disabled" type="text" value="<?= UserDetails::getMailAddres() ?>" class="form-control" id="username_name" placeholder="Имейл адрес">
                   </div>
                    <div class="modal-footer">
                           <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Затвори</button>
                    </div>
                </div>
            </form>
        </div>
      </div>
    </div>
    <div class="clear"></div>
  <?php  
}
?>

