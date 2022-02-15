<?php
session_start();
$_SESSION = array();
session_destroy();
header('Location: task_14.php');
?>