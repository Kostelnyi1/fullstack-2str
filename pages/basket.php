<?php
$title = 'Корзина';
require_once '../templates/header.php';

$basketProducts = $_SESSION['products'];
$productIds = array_keys($basketProducts);

$query = "SELECT * FROM products WHERE id IN (:ids)";
$res = $pdo->prepare($query);
$res->execute([
    ':ids' => implode(',', $productIds),
]);
$products = $res->fetchAll();

?>

<table class="table table-bordered mt-2">
    <tbody>
        <?php
        foreach ($products as $product) {
            $sum = (float) $basketProducts[$product['id']] * $product['price'];
            echo
            "
            <tr>
                <td>{$product['name']}</td>
                <td>{$product['price']}</td>
                <td>{$basketProducts[$product['id']]}</td>
                <td>{$sum}</td>
            </tr>
            ";
        }
        ?>
    </tbody>
</table>