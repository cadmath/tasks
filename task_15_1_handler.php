<?php
$dns = 'mysql:host=localhost;dbname=home';
$db = new PDO($dns, 'root', '');

$image = $_GET['img'];

//удалении bp БД
$del = $db->prepare('DELETE FROM images WHERE image=:img');
$del->execute(['img' => $image]);
//удалении копии
unlink('img/demo/gallery/thumb/'.$image);
//удаление оригинала
unlink('img/demo/gallery/'.$image);

header('Location: task_15_1.php');

?>