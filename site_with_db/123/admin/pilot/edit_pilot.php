<!DOCTYPE html>
<html>
<head>
  <title>Пилоты</title>
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
<h2 class="main-content">Изменить пилотов</h2>
<body>
    <?php
        require_once 'config/connect.php';

        if (isset($_GET['idpilots'])) {
            $idpilots = $_GET['idpilots'];
            $sql = "SELECT * FROM pilots WHERE idpilots='$idpilots'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                $FN = $row['FN'];
                $SN = $row['SN'];
                $DN = $row['DN'];
                $BD = $row['BD'];
                $passport = $row['passport'];
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $FN = $_POST["FN"];
            $SN = $_POST["SN"];
            $DN = $_POST["DN"];
            $BD = $_POST["BD"];
            $passport = $_POST["passport"];

            $sql = "UPDATE pilots SET FN='$FN', SN='$SN', DN='$DN', BD='$BD', passport='$passport' WHERE idpilots='$idpilots'";

            if (mysqli_query($conn, $sql)) {
                echo "Обновление прошло успешно";
            } else {
                echo "Ошибка удаления: " . mysqli_error($conn);
            }
        }

        mysqli_close($conn);
    ?>

    <form method="post">

        <label for="FN">Имя:</label>
        <input type="text" id="FN" name="FN" value="<?php echo $FN; ?>"><br>

        <label for="SN">Фамилия:</label>
        <input type="text" id="SN" name="SN" value="<?php echo $SN; ?>"><br>

        <label for="DN">Отчество:</label>
        <input type="text" id="DN" name="DN" value="<?php echo $DN; ?>"><br>

        <label for="BD">Дата рождения:</label>
        <input type="date" id="BD" name="BD" value="<?php echo $BD; ?>"><br>

        <label for="passport">Паспорт:</label>
        <input type="text" id="passport" name="passport" value="<?php echo $passport; ?>"><br>

        <input type="submit" value="Обновить">
    </form>
</body>
</html>