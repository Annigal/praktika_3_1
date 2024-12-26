<?php
require_once 'core/init.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    echo "Данные для входа:<br>";
    echo "Логин: $username<br>";
    echo "Пароль: $password<br>";

    if (!empty($username) && !empty($password)) {
        $userExists = Eshop::userCheck($username, $password);
        echo "Проверка пользователя: " . ($userExists ? "успешно" : "не удалось") . "<br>";

        if ($userExists) {
            $_SESSION['admin'] = $username;
            header('Location: /bookstore-php/eshop/app/admin/admin.php');
            exit;
        } else {
            echo "<p style='color: red;'>Неправильный логин или пароль.</p>";
        }
    } else {
        echo "<p style='color: red;'>Пожалуйста, заполните все поля.</p>";
    }
}

?>


<form action="/bookstore-php/eshop/login.php" method="post">
    <div>
        <label>Логин:</label>
        <input type="text" name="username" autocomplete="username" required>
    </div>
    <div>
        <label>Пароль:</label>
        <input type="password" name="password" autocomplete="current-password" required>
    </div>
    <div>
        <button type="submit">Войти</button>
    </div>
</form>

