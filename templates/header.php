<?php
$document_root = $_SERVER['DOCUMENT_ROOT'];
require $document_root . '/config.php';
?>

<!doctype html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous">
    </script>
    <title>
        <?= $title ?>
    </title>

    <style>
        .btn-user-delete {
            border-radius: 100px;
            padding: 2px 12px 4px 12px;
        }
        .card-image {
            margin-top: 10px;
            height: 180px;
        }
        .card-price {
            text-align: center;
            font-size: 23px;
            border-bottom: 2px solid grey;
        }
        .card-image img {
            width: auto;
            height: 100%;
        }
        .btn-product-add, .btn-product-remove {
            width: 37px;
        }
        .card-basket-buttons {
            margin-top: 15px;
            display: flex;
            justify-content: space-between;
        }
        .card-basket-quantity {
            line-height: 38px;
        }
    </style>

  </head>
  <body>
    <div class='container mt-5'>

    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-2">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">Главная</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    
                    <?php if (isset($_SESSION['user'])) {
                            if ($_SESSION['user']['is_admin']) { ?>
                        <li class="nav-item">
                    <a class="nav-link" <?= $_SERVER['PHP_SELF'] == '/pages/admin/index.php' ? 'active' : '' ?> aria-current="page" href="/pages/admin/index.php">
                        Админка
                    </a>
                    </li>
                    <?php }} ?>

                    <?php if (!isset($_SESSION['user'])) { ?>
                    <li class="nav-item">
                    <a class="nav-link" <?= $_SERVER['PHP_SELF'] == '/pages/login.php' ? 'active' : '' ?> aria-current="page" href="/pages/login.php">
                        Авторизация
                    </a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" <?= $_SERVER['PHP_SELF'] == '/pages/register.php' ? 'active' : '' ?> href="/pages/register.php">
                        Регистрация
                    </a>
                    </li>
                    <?php } else { ?>

                    <li class="nav-item">
                        <a class="nav-link <?= $_SERVER['PHP_SELF'] == '/pages/basket.php' ? 'active' : '' ?>" href="/pages/basket.php">
                            Корзина (<?= array_sum($_SESSION['products'] ?? []) ?>)
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?= $_SESSION['user']['name'] ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="/pages/user.php?id=<?= $_SESSION['user']['id'] ?>">Личный кабинет</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="/actions/logout.php">Выйти</a></li>
                    </ul>
                    </li>
                    <?php } ?>
                </ul>
                </div>
            </div>
    </nav>