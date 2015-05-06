<script>  
    function showSuccessMessage(msg) {
        noty({
            text: msg,
            theme: 'bootstrapTheme',
            type: 'success',
            timeout: 1000,
            layout: 'top',
            
        });
    }
    function showErrorMessage(msg) {

        noty({
            text: msg,
            theme: 'bootstrapTheme',
            type: 'error',
            timeout: 1000,
            layout: 'top'
            
        });
    }
<?php
if (isset($_SESSION['messages'])) {
           
    foreach ($_SESSION['messages'] as $msg) {
        if ($msg['type'] == 'info') {
            echo 'showSuccessMessage("' . htmlspecialchars($msg['text']) . '");';
        } else{
            echo 'showErrorMessage("' . htmlspecialchars($msg['text']) . '");';
        }
    }
    unset($_SESSION['messages']);
}
?>
</script>


