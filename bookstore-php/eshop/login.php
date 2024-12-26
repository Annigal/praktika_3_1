<?php
require_once 'core/init.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!empty($username) && !empty($password)) {
        if (Eshop::userCheck($username, $password)) {
            $_SESSION['admin'] = $username;
            header('Location: /bookstore-php/eshop/app/admin/orders.php');
            exit;
        } else {
            echo "<p style='color: red;'>Неправильные логин или пароль.</p>";
        }
    } else {
        echo "<p style='color: red;'>Нужно заполнить все поля.</p>";
    }
}
?>

<form method="post">
    <label>Логин: <input type="text" name="username" required></label><br>
    <label>Пароль: <input type="password" name="password" required></label><br>
    <button type="submit">Войти</button>
</form>
