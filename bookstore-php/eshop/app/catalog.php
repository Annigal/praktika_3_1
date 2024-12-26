<?php
require_once __DIR__ . '/../core/init.php';


echo "<h1>Каталог товаров</h1>";
echo "<p class='admin'><a href='/bookstore-php/eshop/app/admin/admin.php'>админка</a></p>";
echo "<p>Товаров в <a href='/bookstore-php/eshop/basket'>корзине</a>: </p>";


echo "<table>";
echo "<tr>
        <th>Название</th>
        <th>Автор</th>
        <th>Год издания</th>
        <th>Цена, руб.</th>
        <th>В корзину</th>
      </tr>";

      
try {
    $items = Eshop::getItemsFromCatalog();
    foreach ($items as $item) {
        echo "<tr>
                <td>{$item->title}</td>
                <td>{$item->author}</td>
                <td>{$item->pubyear}</td>
                <td>{$item->price}</td>
                <td>
					<form action='/bookstore-php/eshop/add_item_to_basket' method='post'>
						<input type='hidden' name='id' value='{$item->id}'>
						<input type='submit' value='Добавить в корзину'>
					</form>
                </td>
              </tr>";
    }
} catch (Exception $e) {
    echo "Ошибка: " . $e->getMessage();
}

echo "</table>";
?>
