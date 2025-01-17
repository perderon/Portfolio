<?php
require_once 'config/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $FN = $_POST["FN"];
  $SN = $_POST["SN"];
  $DN = $_POST["DN"];
  $BD = $_POST["BD"];
  $passport = $_POST["passport"];

  $sql = "INSERT INTO stewardess (FN, SN, DN, BD, passport) VALUES ('$FN', '$SN', '$DN', '$BD', '$passport')";

  if (mysqli_query($conn, $sql)) {
    echo "Создание прошло успешно";
  } else {
    echo "Ошибка: " . $sql . "<br>" . mysqli_error($conn);
  }
}

mysqli_close($conn);
header("Location: stew.php");
exit();
?>