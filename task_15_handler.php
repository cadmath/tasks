<?php

session_start();
$dns = 'mysql:host=localhost;dbname=home';
$db = new PDO($dns, 'root', '');
$image = $_FILES['image'];
$file = "img/demo/gallery/".$image['name'];

//Если размер больше установленного выводим ошибку
if($image['size'] > 10 * 1024 * 1024){
    $_SESSION['alert'] = true;
    header('Location: task_15.php');
    exit();
}

if($image['type'] == 'image/jpeg' || $image['type'] == 'image/png' || $image['type'] == 'image/gif'){
    //перемещаяе фаил в нужный нам каталог
    move_uploaded_file($image['tmp_name'], $file);
    //Уникальное имя для записи в базу данных
    $name = time().$image['name'];
    //переименовываем наш фаил
    rename($file, 'img/demo/gallery/'.$name);
}else{
    //выводим ошибку если была передана не картинка
    $_SESSION['alert'] = true;
    header('Location: task_15.php');
    exit();
}


//берем данное изображение
$sourse = 'img/demo/gallery/'.$name;
//его будующая копия
$small_copy = "img/demo/gallery/thumb/".$name;

//получаем длину и высоту оригинала
$size = getimagesize($sourse);
$width = $size[0];
$height = $size[1];

//уменьшение размера
$rwidth = 250;
$rheight = 160;

//работаем в GD в заыисимость от MIME типа
switch ($image['type']) {
    case 'image/jpeg':
                //Открытие оригинального изображения
                $original = imagecreatefromjpeg($sourse);

                //создаем пустое изображение длиной и шириной 
                $resize = imagecreatetruecolor($rwidth, $rheight);

                //копируем на холст наше изображение
                imagecopyresampled($resize, $original,0,0,0,0,$rwidth,$rheight,$width,$height);

                //сохраняем получившиеся значение
                imagejpeg($resize, $small_copy);
                header('Location: task_15.php');

                imagedestroy($original);
                imagedestroy($resize);
                break;
    case 'image/png':
               //Открытие оригинального изображения
               $original = imagecreatefrompng($sourse);

               //создаем пустое изображение длиной и шириной 
               $resize = imagecreatetruecolor($rwidth, $rheight);
       
               //копируем на холст наше изображение
               imagecopyresampled($resize, $original,0,0,0,0,$rwidth,$rheight,$width,$height);
       
               //сохраняем получившиеся значение
               imagepng($resize, $small_copy);
               header('Location: task_15.php');
       
               imagedestroy($original);
               imagedestroy($resize);
               break;
    case 'image/gif':
               //Открытие оригинального изображения
               $original = imagecreatefromgif($sourse);

               //создаем пустое изображение длиной и шириной 
               $resize = imagecreatetruecolor($rwidth, $rheight);
       
               //копируем на холст наше изображение
               imagecopyresampled($resize, $original,0,0,0,0,$rwidth,$rheight,$width,$height);
       
               //сохраняем получившиеся значение
               imagegif($resize, $small_copy);
               header('Location: task_15.php');
       
               imagedestroy($original);
               imagedestroy($resize);
               break;
    default:
        echo 'ОШИБКА ПРИ СОЗДАНИИ КОПИИ!';
    }

$add = $db->prepare("INSERT INTO images (`image`) VALUES (:image)");
$add->execute(['image'=>$name]);
?>
