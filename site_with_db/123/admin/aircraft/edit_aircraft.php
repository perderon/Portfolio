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
      <li><a href="../admin.php">Главная</a></li>
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
<h2 class="main-content">Изменить самолет</h2>
<body>
    <?php
        require_once 'config/connect.php';

        if (isset($_GET['idaircraft'])) {
            $idaircraft = $_GET['idaircraft'];
            $sql = "SELECT * FROM aircraft WHERE idaircraft='$idaircraft'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                $aircrafttype = $row['aircrafttype'];
                $numofseats = $row['numofseats'];
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $aircrafttype = $_POST["aircrafttype"];
            $numofseats = $_POST["numofseats"];

            $sql = "UPDATE aircraft SET aircrafttype='$aircrafttype', numofseats='$numofseats' WHERE idaircraft='$idaircraft'";

            if (mysqli_query($conn, $sql)) {
                echo "Обновление прошло успешно";
            } else {
                echo "Ошибка обновления: " . mysqli_error($conn);
            }
        }

        mysqli_close($conn);
    ?>

    <form method="post">

        <label for="aircrafttype">Название:</label>
        <input type="text" id="aircrafttype" name="aircrafttype" value="<?php echo $aircrafttype; ?>"><br>

        <label for="numofseats">Количество мест:</label>
        <input type="text" id="numofseats" name="numofseats" value="<?php echo $numofseats; ?>"><br>

        <input type="submit" value="Обновить">
    </form>
</body>
</html>