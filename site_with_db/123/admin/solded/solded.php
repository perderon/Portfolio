<?php
require_once 'config/connect.php';

$sql_solded = "SELECT solded.idsolded, solded.day, solded.seat, solded.price, customer.idcustomer, customer.FN, customer.SN 
               FROM solded  
               INNER JOIN customer  ON solded.idcustomer = customer.idcustomer";
$result_solded = mysqli_query($conn, $sql_solded);

if (!$result_solded) {
    die("Ошибка соединения с таблицей: " . mysqli_error($conn));
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Проданные места</title>
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
<h2 class="main-content">Проданные места</h2>
<body>
    <table>
        <tr>
            <th>Номер</th>
            <th>Дата</th>
            <th>Проданное место</th>
            <th>Цена</th>
            <th>Имя</th>
            <th></th>
        </tr>
        <tbody>
<?php
    while ($row_solded = mysqli_fetch_assoc($result_solded)) {
        echo "<tr>";
        echo "<td>".$row_solded['idsolded']."</td>";
        echo "<td>".$row_solded['day']."</td>";
        echo "<td>".$row_solded['seat']."</td>";
        echo "<td>".$row_solded['price']."</td>";
        echo "<td>".$row_solded['FN']." ".$row_solded['SN']." (".$row_solded['idcustomer'].")</td>";
        echo "<td>
                  <a href='edit_solded.php?idsolded=" . $row_solded["idsolded"] . "' class='btn btn-info btn-sm'><i class='fa fa-pencil'></i> Изменить</a>
                  <a href='delete_solded.php?idsolded=" . $row_solded["idsolded"] . "' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i> Удалить</a>
                </td>";
          echo "</tr>";
    }
?>
</tbody>
    </table>
    <a href="../solded/insert_solded.php" class='btn btn-info btn-sm'><i class='fa fa-pencil'></i> Добавить</a>
</body>
</html>