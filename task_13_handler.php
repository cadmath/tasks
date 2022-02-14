<?php

session_start();

$submit = $_POST['submit'];

if($submit){
    ++$_SESSION['counter'];
    header('Location: task_13.php');
    //echo $_SESSION['counter'];
}else{
    header('Location: task_13.php');
}

?>