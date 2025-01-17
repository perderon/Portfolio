<?php
session_start();

$users = array(
    'admin' => array(
        'password' => 'adminpass',
        'role' => 'admin'
    ),
    'user' => array(
        'password' => 'userpass',
        'role' => 'user'
    )
);

if (isset($_SESSION['username'])) {

    if ($_SESSION['role'] == 'admin') {
        header('Location: /123/admin/admin.php');
    } else {
        header('Location: /123/user/user.php');
    }
    exit;
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (array_key_exists($username, $users)) {

        if ($password == $users[$username]['password']) {

            $_SESSION['username'] = $username;
            $_SESSION['role'] = $users[$username]['role'];

            if ($_SESSION['role'] == 'admin') {
                header('Location: /123/admin/admin.php');
            } else {
                header('Location: /123/user/user.php');
            }
            exit;
        }
    }


    echo "Неверный логин или пароль";
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Авторизация</title>
  <link rel="stylesheet" href="/123/user/style.css">
</head>
<body>
    <div class="main-content">
  <h3>Добро пожаловать на сайт авиакомпании</h3>
  <p>Войдите в аккаунт для просмотра страницы авиакомпании</p>
</div>
<form class="main-content" method="post" action="/123/index.php">
    <label for="username">Логин:</label>
    <input type="text" id="username" name="username">
    <br>
    <label for="password">Пароль:</label>
    <input type="password" id="password" name="password">
    <br>
    <input type="submit" value="Войти">
</form>