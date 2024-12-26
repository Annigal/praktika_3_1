<h1>Добавить пользователя</h1>
<p><a href='/bookstore-php/eshop/app/admin/admin.php'>В админку</a></p>
<form action="/bookstore-php/eshop/app/admin/save_user.php" method="post">
    <div>
        <label>Логин:</label>
        <input type="text" name="username" required>
    </div>
    <div>
        <label>Пароль:</label>
        <input type="password" name="password" required>
    </div>
    <div>
        <label>Email:</label>
        <input type="email" name="email">
    </div>
    <div>
        <input type="submit" value="Создать">
    </div>
</form>
