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
<h2 class="main-content">Самолеты</h2>
<table>
  <thead>
    <tr>
      <th>Номер</th>
      <th>Название</th>
      <th>Количество кресел</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php
      require_once 'config/connect.php';

      // Получаем данные из таблицы aircraft
      $sql = "SELECT * FROM aircraft";
      $result = $conn->query($sql);

      // Выводим данные в таблицу
      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . $row["idaircraft"] . "</td>";
          echo "<td>" . $row["aircrafttype"] . "</td>";
          echo "<td>" . $row["numofseats"] . "</td>";
          echo "<td>
                  <a href='edit_aircraft.php?idaircraft=" . $row["idaircraft"] . "' class='btn btn-info btn-sm'><i class='fa fa-pencil'></i> Изменить</a>
                  <a href='delete_aircraft.php?idaircraft=" . $row["idaircraft"] . "' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i> Удалить</a>
                </td>";
          echo "</tr>";
        }

            	} else {
                	echo "<tr><td colspan='4'>0 results</td></tr>";
            	}

            	mysqli_close($conn);
			?>
		</tbody>
	</table>
	<form action="insert_aircraft.php" method="POST">

  		<label for="aircrafttype">Название:</label>
  		<input type="text" id="aircrafttype" name="aircrafttype"><br>

  		<label for="numofseats">Количество кресел:</label>
  		<input type="text" id="numofseats" name="numofseats"><br>

  		<input type="submit" value="Отправить">
	</form>
</body>
</html>
