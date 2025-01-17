<?php
require_once 'config/connect.php'; 
error_reporting(E_ALL);
ini_set('display_errors', 1);

$sql_stew = "SELECT idstew, FN, SN FROM stewardess";
$result_stew = mysqli_query($conn, $sql_stew);

$sql_pilots = "SELECT idpilots, FN, SN FROM pilots";
$result_pilots = mysqli_query($conn, $sql_pilots);

$sql_aircraft = "SELECT idaircraft, aircrafttype FROM aircraft";
$result_aircraft = mysqli_query($conn, $sql_aircraft);

if (isset($_POST['submit'])) {
    $idstew = $_POST['idstew'];
    $idpilots = $_POST['idpilots'];
    $idaircraft = $_POST['idaircraft'];

    $sql_service = "INSERT INTO service (idstew, idpilots, idaircraft) VALUES ('$idstew', '$idpilots', '$idaircraft')";
    $result_service = mysqli_query($conn, $sql_service);

    if (!$result_service) {
        die("Ошибка добавления: " . mysqli_error($conn));
    }
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Добавить</title>
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
<h2 class="main-content">Добавить</h2>
<body>
    <form method="post">
        <label for="idstew">Номер стюардессы:</label>
        <select id="idstew" name="idstew">
    <?php while ($row_stew = mysqli_fetch_assoc($result_stew)) { ?>
        <option value="<?php echo $row_stew['idstew']; ?>"><?php echo $row_stew['idstew'] . ' - ' . $row_stew['FN'] . ' ' . $row_stew['SN']; ?></option>
    <?php } ?>
</select>
<label for="idpilots">Номер пилота:</label>
        <select id="idpilots" name="idpilots">
    <?php while ($row_pilots = mysqli_fetch_assoc($result_pilots)) { ?>
        <option value="<?php echo $row_pilots['idpilots']; ?>"><?php echo $row_pilots['idpilots'] . ' - ' . $row_pilots['FN'] . ' ' . $row_pilots['SN']; ?></option>
    <?php } ?>
</select>
<label for="idaircraft">Номер самолета:</label>
        <select id="idaircraft" name="idaircraft">
    <?php while ($row_aircraft = mysqli_fetch_assoc($result_aircraft)) { ?>
        <option value="<?php echo $row_aircraft['idaircraft']; ?>"><?php echo $row_aircraft['idaircraft'] . ' - ' . $row_aircraft['aircrafttype']; ?></option>
    <?php } ?>
</select>
        <input type="submit" name="submit" value="Добавить">
    </form>
</body>
</html>