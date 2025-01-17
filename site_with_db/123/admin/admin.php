<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: /123/index.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Авиакомпания</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Авиакомпания</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="admin.php">Главная</a></li>
      <li><a href="customer/customer.php">Покупатели</a></li>
      <li><a href="pilot/pilot.php">Пилоты</a></li>
      <li><a href="stew/stew.php">Стюардессы</a></li>
      <li><a href="solded/solded.php">Проданные места</a></li>
      <li><a href="aircraft/aircraft.php">Самолеты</a></li>
      <li><a href="service/service.php">Сервис</a></li>
      <li><a href="logout.php">Выйти</a></li>
    </ul>
  </div>
</nav>
<div class="container-fluid main-content">
  <h3>Добро пожаловать на сайт авиакомпании</h3>
  <p>Выберите нужную вкладку в навигационном меню, чтобы перейти к соответствующей странице.</p>
</div>

</body>
</html>