<?php
session_start();
session_destroy(); 
header('Location: /123/index.php'); 
exit;
?>