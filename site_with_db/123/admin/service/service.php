<?php
    require_once 'config/connect.php';

    $sql = "SELECT service.idservice, aircraft.idaircraft, aircraft.aircrafttype, pilots.idpilots, pilots.FN as PFN, pilots.SN as PSN, stewardess.idstew, stewardess.FN as SFN, stewardess.SN as SSN
          FROM service
          LEFT JOIN aircraft ON service.idaircraft = aircraft.idaircraft
          LEFT JOIN pilots ON service.idpilots = pilots.idpilots
          LEFT JOIN stewardess ON service.idstew = stewardess.idstew";


    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Ошибка соединения с таблицей: " . mysqli_error($conn));
    }

    mysqli_close($conn);
?>
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
<h2 class="main-content">Сервис</h2>
<body>
    <table>
        <tr>
        <th>Номер</th>
        <th>Воздушное судно</th>
        <th>Пилот</th>
        <th>Стюардесса</th>
        <th></th>
        </tr>
        <tbody>
<?php
    while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["idservice"] . "</td>";
            echo "<td>" . $row["idaircraft"] . " - " . $row["aircrafttype"] . "</td>";
            echo "<td>" . $row["PFN"] . " " . $row["PSN"] . "</td>";
            echo "<td>" . $row["SFN"] . " " . $row["SSN"] . "</td>";
            echo "<td><a href='delete_service.php?idservice=" . $row["idservice"] . "' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i> Удалить</a></td>";
            echo "</tr>";
        }

?>
</tbody>
    </table>
    <a href="../service/insert_service.php" class='btn btn-info btn-sm'><i class='fa fa-pencil'></i> Добавить</a>
</body>
</html>