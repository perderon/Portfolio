<?php
require_once 'config/connect.php';

if (isset($_GET['idsolded'])) {
  $idsolded = $_GET['idsolded'];

  $sql = "DELETE FROM solded WHERE idsolded = $idsolded";
  mysqli_query($conn, $sql);

  header("Location: solded.php");
  exit();
}
?>
