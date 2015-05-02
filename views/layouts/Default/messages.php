<?php
/*if (isset($_SESSION['messages'])) {
    echo '<ul>';
    foreach ($_SESSION['messages'] as $msg) {
        echo '<li class="' . $msg['type'] . '">';
        echo htmlspecialchars($msg['text']);
        echo '</li>';
    }
    echo '</ul>';
    unset($_SESSION['messages']);
}*/

if (isset( $_SESSION['messagesInfo'])) {
    echo "<span class='InfoMsg'>" . htmlspecialchars($_SESSION['messagesInfo']) . "</span>";
    unset($_SESSION['messagesInfo']);
}
if (isset( $_SESSION['messagesErr'])) {
    echo "<span class='ErrMsg'>" . htmlspecialchars($_SESSION['messagesErr']) . "</span>";
    unset($_SESSION['messagesErr']);
}