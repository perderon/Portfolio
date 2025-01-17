<?php
require_once 'config/connect.php';

if (isset($_GET['idservice'])) {
  $idservice = $_GET['idservice'];


  $sql = "DELETE FROM service WHERE idservice = $idservice";
  mysqli_query($conn, $sql);


  header("Location: service.php");
  exit();
}
?>