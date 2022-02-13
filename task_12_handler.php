<?php

session_start();

$text = trim(htmlspecialchars($_POST['text']));

if($text){
    $_SESSION['text'] = $text;
    header('Location: task_12.php');
}else{
    header('Location: task_12.php');
}
?>