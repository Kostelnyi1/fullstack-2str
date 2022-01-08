<?php
session_start();
$title = 'Список категорий';
require_once '../../templates/header.php';

$query = "SELECT * FROM categories";
$res = $pdo->query($query);
$categories = $res->fetchAll();
?>

<form method="POST" action="../../actions/admin/createCategory.php">
    <input class="form-control mb-2" name='name' placeholder="Наименование категории">
    <textarea class="form-control mb-2" name="description" placeholder="Описание"></textarea>
    <button class="btn btn-primary w-100" type="submit">СОХРАНИТЬ</button>
</form>

<table class="table table-bordered mt-5">
    <thead>
        <tr>
            <th>#</th>
            <th>Наименование</th>
            <th>Описание</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!$categories) {
            echo 
            "
            <tr>
                <td class='text-center' colspan='3'>
                <em>Категории отсутствуют</em>
                </td>
            </tr>
            ";
        }
        foreach ($categories as $category) {
            echo 
            "
            <tr>
                <td>{$category['id']}</td>
                <td>{$category['name']}</td>
                <td>{$category['description']}</td>
            </tr>
            ";
        }
        ?>
    </tbody>
</table>

<?php
require_once '../../templates/footer.php';