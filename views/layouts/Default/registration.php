<!-- Modal registration-->
<div style="text-align: left" class="modal fade" id="registrationModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div style="text-align: center" class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Регистрация</h4>
      </div>
        <form role="form" method="post">
            <div class="modal-body">
                
               <div class="form-group">
                     <label for="username_name"><i class="fa fa-user"></i> Потребителско Име</label>
                     <input name="user" type="text" class="form-control" id="username_name" placeholder="Потребителско име">
               </div>
                <div class="form-group">
                     <label for="username_name"><i class="fa fa-envelope-o"></i> Имейл адрес</label>
                     <input name="mail" type="text" class="form-control" id="username_name" placeholder="Имейл адрес">
               </div>
               <div class="form-group">
                     <label for="user_pass"><i class="fa fa-key"></i> Парола</label>
                     <input name="pass" type="password" class="form-control" id="user_pass" placeholder="Парола">
               </div>
                <div class="form-group">
                     <label for="user_pass"><i class="fa fa-key"></i> Паролата отново</label>
                     <input name="repass" type="password" class="form-control" id="user_pass" placeholder="Парола">
                </div>
             <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Откажи</button>
                    <input type="submit" name="register" class="btn btn-success pull-right" value="Регистрация" />
             </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="clear"></div>
    