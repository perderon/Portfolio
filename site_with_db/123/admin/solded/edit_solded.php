<?php
require_once 'config/connect.php';

if(isset($_POST['submit'])) {
    $idsolded = $_POST['idsolded'];
    $day = $_POST['day'];
    $seat = $_POST['seat'];
    $price = $_POST['price'];
    $idcustomer = $_POST['idcustomer'];

    $sql = "UPDATE solded SET day='$day', seat='$seat', price='$price', idcustomer='$idcustomer' WHERE idsolded=$idsolded";

    if(mysqli_query($conn, $sql)) {
        echo "Обновления прошло успешно";
        header("Location: solded.php");
    } else {
        echo "Ошибка обновления: " . mysqli_error($conn);
    }
}

if(isset($_GET['idsolded'])) {
    $idsolded = $_GET['idsolded'];
    $sql_solded = "SELECT solded.idsolded, solded.day, solded.seat, solded.price, customer.idcustomer, customer.FN, customer.SN 
               FROM solded  
               INNER JOIN customer  ON solded.idcustomer = customer.idcustomer WHERE idsolded=$idsolded";
    $result_solded = mysqli_query($conn, $sql_solded);

    if (!$result_solded) {
        die("Ошибка соединения с таблицей: " . mysqli_error($conn));
    }

    $row_solded = mysqli_fetch_assoc($result_solded);

    mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Изменить</title>
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
<h2 class="main-content">Изменить проданные места</h2>
<body>
    <form method="post">
        <label for="day">Дата:</label>
        <input type="date" id="day" name="day" value="<?php echo $row_solded['day']; ?>"><br><br>
        <label for="seat">Проданное место:</label>
        <input type="text" id="seat" name="seat" value="<?php echo $row_solded['seat']; ?>"><br><br>
        <label for="price">Цена:</label>
        <input type="text" id="price" name="price" value="<?php echo $row_solded['price']; ?>"><br><br>
        <input type="hidden" name="idcustomer" value="<?php echo $row_solded['idcustomer']; ?>"><br><br>
        <input type="hidden" name="idsolded" value="<?php echo $row_solded['idsolded']; ?>">
        <input type="submit" name="submit" value="Обновление">
    </form>
</body>
</html>

<?php
} else {
    echo "Error: Все поломано";
}
?>
