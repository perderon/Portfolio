<?php
require_once 'config/connect.php';

if (isset($_GET['idaircraft'])) {
  $idaircraft = $_GET['idaircraft'];

  $sql = "DELETE FROM aircraft WHERE idaircraft = $idaircraft";
  mysqli_query($conn, $sql);

  header("Location: aircraft.php");
  exit();
}
?>