<?php
require_once 'config/connect.php';

if (isset($_GET['idstew'])) {
  $idstew = $_GET['idstew'];

  $sql = "DELETE FROM stewardess WHERE idstew = $idstew";
  mysqli_query($conn, $sql);

  header("Location: stew.php");
  exit();
}
?>