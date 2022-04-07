<?php
use core\App;
use app\services\UserAuthService;
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/public/css/main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Task</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="javascript:void(0)">Task Manager</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <?php if(UserAuthService::isGuest()):?>
                    <a class="nav-link" href="/user/login">Войти</a>
                <?php else:?>
                    <a class="nav-link" href="/user/logout">Выйти</a>
                <?php endif;?>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>
<div class="main">
    <?php if(App::$app->session->hasFlash()):?>
        <?php
            $message = $message = App::$app->session->getFlash('success');
            $alertClass = 'success';

            if(!$message) {
                $message = $message = App::$app->session->getFlash('error');
                $alertClass = 'danger';
            }
        ?>
        <div class="alert alert-<?=$alertClass?>" role="alert">
            <?=$message?>
        </div>
    <?php endif;?>

    <div class="container">
        <?=$content;?>
    </div>
</div>
</body>
</html>