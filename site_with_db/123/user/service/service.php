<!DOCTYPE html>
<html>
<head>
  <title>Сервис</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="../style1.css">
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
      <li><a href="../user.php">Главная</a></li>
      <li><a href="../customer/customer.php">Покупатели</a></li>
      <li><a href="../pilot/pilot.php">Пилоты</a></li>
      <li><a href="../stew/stew.php">Стюардессы</a></li>
      <li><a href="../solded/solded.php">Проданные места</a></li>
      <li><a href="../aircraft/aircraft.php">Самолеты</a></li>
      <li><a href="../service/service.php">Сервис</a></li>
      <li><a href="../logout.php">Выйти</a></li>
    </ul>
  </div>
</nav>
<body>
    <h1 class="main-content">Поиск судна по пилоту</h1>
    <form class="main-content" method="POST" action="search.php">
        <label class="main-content" for="pilot_sn">Введите фамилию пилота:</label>
        <input class="main-content" type="text" name="pilot_sn" id="pilot_sn">
        <input class="main-content" type="submit" value="Найти">
    </form>
</body>
</html>
