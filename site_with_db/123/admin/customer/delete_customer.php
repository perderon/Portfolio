<?php
require_once 'config/connect.php';

if (isset($_GET['idcustomer'])) {
  $idcustomer = $_GET['idcustomer'];

  $sql = "DELETE FROM customer WHERE idcustomer = $idcustomer";
  mysqli_query($conn, $sql);

  header("Location: customer.php");
  exit();
}
?>