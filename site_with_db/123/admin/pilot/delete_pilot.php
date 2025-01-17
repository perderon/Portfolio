<?php
require_once 'config/connect.php';

if (isset($_GET['idpilots'])) {
  $idpilots = $_GET['idpilots'];

  $sql = "DELETE FROM pilots WHERE idpilots = $idpilots";
  mysqli_query($conn, $sql);

  header("Location: pilot.php");
  exit();
}
?>