<?php
require_once 'config/connect.php';

if (isset($_POST['pilot_sn'])) {
    $pilot_sn = mysqli_real_escape_string($conn, $_POST['pilot_sn']);
    $sql = "SELECT aircraft.aircrafttype
            FROM service
            LEFT JOIN aircraft ON service.idaircraft = aircraft.idaircraft
            LEFT JOIN pilots ON service.idpilots = pilots.idpilots
            WHERE pilots.SN = '$pilot_sn'";

    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Ошибка соединения с таблицей: " . mysqli_error($conn));
    }

    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Самолеты</title>
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
    <h2 class="main-content">Самолеты</h2>
    <?php
        if (isset($_POST['pilot_sn'])) {
            echo "<table>";
            echo "<tr><th>Воздушное судно</th></tr>";
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr><td>" . $row["aircrafttype"] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "<p>Введите фамилию пилота в форме выше, чтобы начать поиск</p>";
        }
    ?>
</body>
</html>
