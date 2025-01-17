<?php
require_once 'config/connect.php'; 
error_reporting(E_ALL);
ini_set('display_errors', 1);

$sql_customers = "SELECT idcustomer, FN, SN FROM customer";
$result_customers = mysqli_query($conn, $sql_customers);

if (!$result_customers) {
    die("Error retrieving customers data: " . mysqli_error($conn));
}

// добавляем данные в таблицу solded
if (isset($_POST['submit'])) {
    $idcustomer = $_POST['idcustomer'];
    $day = $_POST['day'];
    $seat = $_POST['seat'];
    $price = $_POST['price'];

    $sql_solded = "INSERT INTO solded (idcustomer, day, seat, price) VALUES ('$idcustomer', '$day', '$seat', '$price')";
    $result_solded = mysqli_query($conn, $sql_solded);

    if (!$result_solded) {
        die("Error adding data to solded table: " . mysqli_error($conn));
    }
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Добавить проданные места</title>
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
<h2 class="main-content">Добавить проданные места</h2>
</head>
<body>
    <form method="post">
        <label for="idcustomer">Номер покупателя:</label>
        <select id="idcustomer" name="idcustomer">
    <?php while ($row_customers = mysqli_fetch_assoc($result_customers)) { ?>
        <option value="<?php echo $row_customers['idcustomer']; ?>"><?php echo $row_customers['idcustomer'] . ' - ' . $row_customers['FN'] . ' ' . $row_customers['SN']; ?></option>
    <?php } ?>
</select>

</select>

        </select><br><br>
        <label for="date">Дата:</label>
        <input type="date" id="day" name="day"><br><br>
        <label for="seat">Место:</label>
        <input type="text" id="seat" name="seat"><br><br>
        <label for="price">Цена:</label>
        <input type="text" id="price" name="price"><br><br>
        <input type="submit" name="submit" value="Добавить">
    </form>
</body>
</html>
