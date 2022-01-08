
<?php
session_start();
$title = 'Авторизация';
require_once '../templates/header.php';

if (isset($_SESSION['loginError'])) {
    echo"
    <div class='alert alert-warning text-center' role='alert'>
        Неверные данные!
    </div>
    ";
    unset($_SESSION['loginError']);
}

?>


        <form method="POST" action="../actions/login.php">
            <input class="form-control mb-2" placeholder="Логин" name='login'>
            <input class="form-control mb-2" type="password" placeholder="Пароль" name='password'>
            <button type="submit" class="btn btn-success w-100">Войти</button>
        </form>
<?php
require_once '../templates/footer.php';
