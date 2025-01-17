<?php
require_once 'config/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $aircrafttype = $_POST["aircrafttype"];
  $numofseats = $_POST["numofseats"];

  $sql = "INSERT INTO aircraft (aircrafttype, numofseats) VALUES ('$aircrafttype', '$numofseats')";

  if (mysqli_query($conn, $sql)) {
    echo "Создание прошло успешно";
  } else {
    echo "Ошибка: " . $sql . "<br>" . mysqli_error($conn);
  }
}

mysqli_close($conn);
header("Location: aircraft.php");
exit();
?>
