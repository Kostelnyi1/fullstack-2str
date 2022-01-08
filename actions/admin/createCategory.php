<?php
require $_SERVER['DOCUMENT_ROOT'] . '/config.php';

$name = $_POST['name'];
$description = $_POST['description'];

$query = "INSERT INTO categories (name, description) VALUES (:name, :description)";
$res = $pdo->prepare($query);
$res->execute([
    ':name' => $name,
    ':description' => $description
]);

header("Location: /pages/admin/categories.php");