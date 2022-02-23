<?php

session_start();
$dns = 'mysql:host=localhost;dbname=home';
$db = new PDO($dns, 'root', '');
$image = $_FILES['image'];

$i = 0;
foreach ($image['name'] as $img){
    $file = "img/demo/gallery/".$img;
    //перемещаяе фаил в нужный нам каталог
    move_uploaded_file($image['tmp_name'][$i++], $file);
    //Уникальное имя для записи в базу данных
    $name = time().$img;
   
    //переименовываем наш фаил
    rename($file, 'img/demo/gallery/'.$name);
    $add = $db->prepare("INSERT INTO images (`image`) VALUES (:image)");
    $add->execute(['image'=>$name]);

}
header('Location: task_15_2.php');
?>