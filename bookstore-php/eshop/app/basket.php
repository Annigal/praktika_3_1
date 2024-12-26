<?php
require_once 'core/init.php';
Basket::init();

$items = Basket::read();

?>

<p>Вернуться в <a href='/bookstore-php/eshop/catalog'>каталог</a></p>
<h1>Ваша корзина</h1>

<?php if (!empty($items)): ?>
    <table>
        <tr>
            <th>N п/п</th>
            <th>ID товара</th>
            <th>Количество</th>
            <th>Удалить</th>
        </tr>

        <?php $i = 1; ?>
        <?php foreach ($items as $id => $quantity): ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= htmlspecialchars($id) ?></td>
                <td><?= htmlspecialchars($quantity) ?></td>
                <td>
                    <form action="/bookstore-php/eshop/remove_item_from_basket" method="post">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
                        <input type="submit" value="Удалить">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <div style="text-align:center; margin-top: 20px;">
        <h2>Оформить заказ</h2>
        <form action="/bookstore-php/eshop/save_order" method="post">
            <label>Имя: <input type="text" name="customer" required></label><br>
            <label>Email: <input type="email" name="email" required></label><br>
            <label>Адрес: <input type="text" name="address" required></label><br>
            <label>Телефон: <input type="text" name="phone" required></label><br>
            <input type="submit" value="Оформить">
        </form>
    </div>

<?php else: ?>
    <p>Корзина пуста.</p>
<?php endif; ?>
