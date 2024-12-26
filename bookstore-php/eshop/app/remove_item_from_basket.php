<?php
require_once __DIR__ . '/../core/init.php';
Basket::init();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    if ($id) {
        Basket::remove($id);
    }
}

header('Location: /bookstore-php/eshop/basket');
exit;
?>
