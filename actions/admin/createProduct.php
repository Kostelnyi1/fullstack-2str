<?php
require $_SERVER['DOCUMENT_ROOT'] . '/config.php';

$errors = [];

$file = $_FILES['file'];
if (!$file['name']) {
    $errors[] = 'Не загружено изображение';
} else {
    $types = $file['type'];
    $type = explode('/', $types);
    if ($type[0] != 'image') {
        $errors[] = 'Файл должен быть изображением';
    }
}

$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];
$category_id = $_POST['category_id'];

if (!$name) {
    $errors[] = 'Поле "Наименование" не может быть пустым';
}
if (!$description) {
    $errors[] = 'Отсутствует описание продукта';
}
if (!$price) {
    $errors[] = 'Не заполнено поле "Цена"';
}
if (!$category_id) {
    $errors[] = 'Не выбрана категория';
}

if (count($errors)) {
    $_SESSION['createProductErrors'] = $errors;
    header('Location: /pages/admin/products.php');
    exit();
}

$temp = explode('.', $file['name']);
$ext = $temp[count($temp) - 1];
$fileName = time() . rand(10000, 99999) . '.' . $ext;

move_uploaded_file($file['tmp_name'], "$document_root/images/products/$fileName");
$query = "INSERT INTO products (name, description, price, category_id, picture)
          VALUES(:name, :description, :price, :category_id, :picture)";

$res = $pdo->prepare($query);
$res->execute([
    ':name' => $name,
    ':description' => $description,
    ':price' => $price,
    ':category_id' => $category_id,
    ':picture' => $fileName
]);

unset($_SESSION['lastProductCreate']);

header('Location: /pages/admin/products.php');