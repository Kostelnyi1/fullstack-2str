<?php
session_start();
$title = 'Админка';
require_once '../../templates/header.php';

$links = [
    'Список пользователей' => 'users.php',
    'Категории' => 'categories.php',
    'Продукты' => 'products.php'
];

echo '<div class="row">';
foreach ($links as $key => $link) {
    echo "
    <div class='col-4'>
        <div class='card w-100'>
            <div class='card-body'>
                <h5 class='card-title'>{$key}</h5>
                <a href='{$link}' class='btn btn-primary'>Перейти</a>
            </div>
        </div>
    </div>
    ";
}
echo '</div>';
require_once '../../templates/footer.php';
?>



