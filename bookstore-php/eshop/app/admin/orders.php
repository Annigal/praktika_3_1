<?php
require_once __DIR__ . '/../../core/init.php';

echo "<h1>Список заказов</h1>";
echo "<table border='1'>";
echo "<tr>
        <th>ID</th>
        <th>Имя клиента</th>
        <th>Email</th>
        <th>Телефон</th>
        <th>Адрес</th>
        <th>Дата создания</th>
      </tr>";

try {
    $orders = Eshop::getOrders();
    foreach ($orders as $order) {
        echo "<tr>
                <td>{$order['id']}</td>
                <td>{$order['customer']}</td>
                <td>{$order['email']}</td>
                <td>{$order['phone']}</td>
                <td>{$order['address']}</td>
                <td>{$order['datetime']}</td>
              </tr>";
    }
} catch (Exception $e) {
    echo "Ошибка: " . $e->getMessage();
}

echo "</table>";
