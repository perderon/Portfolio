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
<h2 class="main-content">Пилоты</h2>
<body>
    <table>
        <tr>
            <th>Номер</th>
            <th>Имя</th>
            <th>Фамилия</th>
            <th>Отчество</th>
            <th>Дата рождения</th>
            <th>Паспорт</th>
            <th></th>
        </tr>
        <?php
            require_once 'config/connect.php';
            $sql = "SELECT * FROM pilots";
            $result = mysqli_query($conn, $sql);

            // Код для вывода данных в HTML-таблицу
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row["idpilots"] . "</td>";
                    echo "<td>" . $row["FN"] . "</td>";
                    echo "<td>" . $row["SN"] . "</td>";
                    echo "<td>" . $row["DN"] . "</td>";
                    echo "<td>" . $row["BD"] . "</td>";
                    echo "<td>" . $row["passport"] . "</td>";
                    echo "<td>
                  <a href='edit_pilot.php?idpilots=" . $row["idpilots"] . "' class='btn btn-info btn-sm'><i class='fa fa-pencil'></i> Изменить</a>
                  <a href='delete_pilot.php?idpilots=" . $row["idpilots"] . "' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i> Удалить</a>
                </td>";
          echo "</tr>";
                }
            } else {
                echo "0 результатов";
            }

            mysqli_close($conn);
        ?>
    </table>
    <form action="insert_pilot.php" method="POST">

  <label for="FN">Имя:</label>
  <input type="text" id="FN" name="FN"><br>

  <label for="SN">Фамилия:</label>
  <input type="text" id="SN" name="SN"><br>

  <label for="DN">Отчество:</label>
  <input type="text" id="DN" name="DN"><br>

  <label for="BD">Дата рождения:</label>
  <input type="date" id="BD" name="BD"><br>

  <label for="passport">Паспорт:</label>
  <input type="text" id="passport" name="passport"><br>

  <input type="submit" value="Отправить">
</form>
</body>
</html>     
        