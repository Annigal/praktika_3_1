<?php
require_once __DIR__ . '/../../core/init.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = Cleaner::str($_POST['title']);
    $author = Cleaner::str($_POST['author']);
    $price = Cleaner::uint($_POST['price']);
    $pubyear = Cleaner::uint($_POST['pubyear']);

    $book = new Book($title, $author, $price, $pubyear);

    try {
        if (Eshop::addItemToCatalog($book)) {
            header('Location: /bookstore-php/eshop/admin/add_item_to_catalog');
            exit;
        } else {
            echo "Ошибка добавления товара в каталог.";
        }
    } catch (Exception $e) {
        echo "Ошибка: " . $e->getMessage();
    }
}
?>
