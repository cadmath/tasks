<?php
session_start();

$dns = 'mysql:host=localhost;dbname=data';
$db = new PDO($dns, 'root','');

$email = trim(htmlspecialchars($_POST['email']));
$password = trim(htmlspecialchars($_POST['password']));

if( mb_strlen($password) < 5 ){
    $_SESSION['len_pass'] = true;
    header('Location: task_11.php');
}


if($email and $password){
    $query_select = 'SELECT * FROM users WHERE email = :email';
    $select = $db->prepare($query_select);
    $select->execute(['email'=> $email]);
    $userdb = $select->fetchAll(PDO::FETCH_ASSOC);
}else{
    header('Location: task_11.php');
}


if($userdb){
    echo 'есть';
    $_SESSION['alert'] = true;
    header('Location: task_11.php');
}else{
    $query_insert = 'INSERT INTO users (email, password) VALUES (:email, :password)';
    $insert = $db->prepare($query_insert);
    $insert->execute(['email'=> $email, 'password'=> password_hash($password, PASSWORD_DEFAULT)]);
    echo $email.' Вы успешно авторизовались!';
}



?>
