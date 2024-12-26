<?php
require_once __DIR__ . '/../core/init.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;

    if ($id) {
        Basket::add($id);
        header('Location: /bookstore-php/eshop/basket');
        exit;
    } else {
        echo "Ошибка: ID товара не указан!";
    }
}
?>
