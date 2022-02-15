<?php
session_start();

$dns = 'mysql:host=localhost;dbname=data';
$db = new PDO($dns, 'root', '');

$email = trim(htmlspecialchars($_POST['email']));
$password = trim(htmlspecialchars($_POST['password']));

if(empty($email) and empty($password)){
    header('Location: task_14.php');
}

$select_email = $db->prepare('SELECT * FROM users  WHERE email=:email');
$select_email->execute(['email' => $email]);
$arr_user = $select_email->fetchAll(PDO::FETCH_ASSOC);
$hash = $arr_user[0]['password'];

$bool = password_verify($password, $hash);

if($arr_user and $bool){
    $_SESSION['email'] = $email;
    echo $_SESSION['email'].' Вы успешно авторизовались!';
}else{
    $_SESSION['alert'] = true;
    header('Location: task_14.php');
}



?>