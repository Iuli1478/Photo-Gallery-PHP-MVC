<!DOCTYPE html>
<html>
<head>
    <link href="/content/styles.css" rel="stylesheet" type="text/css"/>
    <title>
        <?php
            if (isset($this->title)) {
                echo htmlspecialchars($this->title);
            }
        ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta charset="UTF-8">
</head>
<body>
    <header>
        <a href="/"><img src="/content/img/logo.jpg" /></a>
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/authours/create">Create</a></li>
            <li><a href="/authours">Authors</a></li>
            <li><a href="/books/books">Books</a></li>
        </ul>
    </header>

    <?php include('messages.php'); ?>
