<h1> <?= $this->onInitTest ?> </h1>

<h3>index authors view</h3>

<?php

if (isset($this->authors)) {
    foreach ($this->authors as $author){
        echo htmlspecialchars($author['Name']) . "<br />";
    }
}
?>
