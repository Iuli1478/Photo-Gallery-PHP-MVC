<?php
    if (UserDetails::isAdmin() == FALSE) {
        echo 'Достъпът отказан';
        exit($this->renderView("index")); 
    }
?>

<script src="/content/scripts/bootstrap/bootstrap-table.js" type="text/javascript"></script>
<link href="/content/styles/bootstrap-table.css" rel="stylesheet" type="text/css"/>

<div class="row">
    <div class="col-md-2 col-xs-2 col-lg-2"></div>
    <div class="col-md-8 col-xs-8 col-lg-8">
        <h2>Управление на подребители</h2>
        <table data-toggle="table" data-height="400" style="width: 1020px;">
            <thead>
                <tr>
                    <th data-field="user">Потребителско име</th>
                    <th data-field="mail">Електронен адрес</th>
                    <th data-field="admin">Администратор</th>
                </tr>
            </thead>
            <tbody>
            <?php
            if (isset($this->users)) {
                foreach ($this->users as $user) {
                    echo '<tr>'.
                             '<td style="width: 300px;">' . $user['UserName'] . '</td>'.
                              '<td>' . $user['Email'] . '</td>'; 
                                if ($user['Role'] == 3) {
                                    echo '<td><input onclick="changeRole('.$user['Id'].')" id="adminRole'.$user['Id'].'" type="checkbox" checked/></td>';
                                } else{
                                    echo '<td><input onclick="changeRole('.$user['Id'].')" id="adminRole'.$user['Id'].'" type="checkbox"/></td>';
                                }
                    echo '</tr>';
                }
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    function changeRole(userId){
        debugger;
        var role = 0;
        if ($('#adminRole' + userId).is(":checked")) {
            role = 3;
        }  
        var url = "/user/changeRole/" + userId + "/" + role;
        
        $.ajax({
          type: "POST",
          url: url,
          success: function(){
              showSuccessMessage("Успешно променихте ролята на потребителя");
          },
          error: function () {
            showErrorMessage("Възникна грешка");
          }
        });
    }

</script>