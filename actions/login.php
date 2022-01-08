<?php
require $_SERVER['DOCUMENT_ROOT'] . '/config.php';

$login = $_POST['login'];
$password = md5($_POST['password']);

$query = 'SELECT * FROM users WHERE login = :login AND password = :password';
$res = $pdo->prepare($query);
$res->execute([
    ':login' => $login,
    ':password' => $password
]);

$user = $res->fetch();

if ($user) {
    $_SESSION['user'] = $user;
    header('Location: ../index.php');
} else {
    $_SESSION['loginError'] = true;
    header('Location: ../pages/login.php');
}