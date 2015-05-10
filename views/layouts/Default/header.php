<!DOCTYPE html>
<html>
<head>
    <link href="/content/styles/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
    <link href="/content/styles/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="/content/styles/styles.css" rel="stylesheet" type="text/css"/>
    <script src="/content/scripts/jquery/jquery-2.1.3.min.js" type="text/javascript"></script>
    <script src="/content/scripts/bootstrap/bootstrap.min.js" type="text/javascript"></script>
    <script src="/content/plugin/noty/packaged/jquery.noty.packaged.min.js" type="text/javascript"></script>
    <script src="/content/plugin/noty/themes/bootstrapNotyTheme.js" type="text/javascript"></script>
    <script src="/content/plugin/noty/layouts/top.js" type="text/javascript"></script>
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
    <div class="row" style="margin-right: 0;" >
      <div class="col-md-1 col-xs-0 col-lg-1"></div>
        <div style="padding-right: 0" class="col-md-10 col-xs-12 col-lg-10">
            <div id="mine">
                <header>
                    <nav class="navbar navbar-default navbar-static-top">
                        <div class="container-fluid">

                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                         <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <li><a href="/">Начало</a></li>
                                <li><a href="/gallery">Галерия</a></li>
                                <?php 
                                if (UserDetails::isLogged()){
                                    echo '<li><a href="/catalog">Управление на албуми</a></li>';
                                }
                                ?>
                            </ul> 
                            <?php 
                                if (!UserDetails::isLogged()){
                                    echo '<ul class="nav navbar-nav navbar-right">';
                                    echo '<li><a href="#" style="margin-right: 10px;" type="button" data-toggle="modal" data-target="#loginModal">Вход</a></li>';
                                    echo '<li><a href="#" style="margin-right: 10px;" type="button" data-toggle="modal" data-target="#registrationModal">Регистрация</a></li>';
                                    echo '</ul>';  
                                } else{
                                    echo '<ul class="nav navbar-nav navbar-right">';
                                    echo '<li><a href="#" style="margin-right: 10px;"  data-toggle="modal" data-target="#userDetailsModal"  type="button">Здравей: ' . UserDetails::getUserName() . '</a></li>'; 
                                    if (UserDetails::isAdmin()){
                                        echo '<li style="margin-right:5px;" class="dropdown">';
                                            echo  '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Администрация <span class="caret"></span></a>';
                                            echo '<ul class="dropdown-menu" role="menu">';
                                                echo '<li><a href="/catalog/adminGetAll" class="more more2">Албуми</a></li>';
                                                echo '<li><a href="/user/getAll" class="more more2">Потребители</a></li>';
                                            echo '</ul>';
                                        echo '</li>';
                                    }
                                    echo '<li><a href="/user/logOut" style="margin-right: 10px;" type="button">Излез</a></li>'; 
                                    echo '</ul>'; 
                                }
                            ?>
                        </div>
                        </div>
                    </nav>
                    <a href="/"><img class="logo" src="/content/img/logo.png" /></a>
                </header>
                <?php 
                include('messages.php'); 
                include('login.php'); 
                include('registration.php');
                include('userDeteils.php');
                ?>
