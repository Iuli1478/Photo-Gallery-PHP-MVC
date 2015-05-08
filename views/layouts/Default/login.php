<!-- Modal login-->
<div style="text-align: left" class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div style="text-align: center" class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Моля влезте в профила си</h4>
      </div>
        <form role="form" method="post" action="/user/LogIn">
            <div class="modal-body">
                  
               <div class="form-group">
                     <label for="username_name"><i class="fa fa-user"></i> Потребителско Име</label>
                     <input name="user" type="text" class="form-control" id="username_name" placeholder="Потребителско име">
               </div>
               <div class="form-group">
                     <label for="user_pass"><i class="fa fa-key"></i> Парола</label>
                     <input name="pass" type="password" class="form-control" id="user_pass" placeholder="Парола">
               </div>

                <!--<a class="btn" href="#">Забравена парола ?</a> TODO-->

             </div>
             <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Откажи</button>
                    <input type="submit" class="btn btn-success pull-right" name="login" value="Вход">
             </div>
        </form>
    </div>
  </div>
</div>
