<?php

session_start();
$dns = 'mysql:host=localhost;dbname=home';
$db = new PDO($dns, 'root', '');
$image = $_FILES['image'];


$i = 0;
foreach ($image['name'] as $img){
    if($image['type'][$i] == 'image/jpeg' || $image['type'][$i] == 'image/png' || $image['type'][$i] == 'image/gif'){
        $file = "img/demo/gallery/".$img;
        //перемещаяе фаил в нужный нам каталог
        move_uploaded_file($image['tmp_name'][$i], $file);
        //Уникальное имя для записи в базу данных
        $name = time().$img;
        //переименовываем наш фаил
        rename($file, 'img/demo/gallery/'.$name);

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
        switch ($image['type'][$i]) {
            case 'image/jpeg':
                        //Открытие оригинального изображения
                        $original = imagecreatefromjpeg($sourse);

                        //создаем пустое изображение длиной и шириной 
                        $resize = imagecreatetruecolor($rwidth, $rheight);

                        //копируем на холст наше изображение
                        imagecopyresampled($resize, $original,0,0,0,0,$rwidth,$rheight,$width,$height);

                        //сохраняем получившиеся значение
                        imagejpeg($resize, $small_copy);
                        header('Location: task_15_1.php');

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
                    header('Location: task_15_1.php');
            
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
                    header('Location: task_15_1.php');
            
                    imagedestroy($original);
                    imagedestroy($resize);
                    break;
            default:
                echo 'ОШИБКА ПРИ СОЗДАНИИ КОПИИ!';
            }

        $add = $db->prepare("INSERT INTO images (`image`) VALUES (:image)");
        $add->execute(['image'=>$name]);

        $i++;

    }else{
    //выводим ошибку если была передана не картинка
    $_SESSION['alert'] = true;
    header('Location: task_15_1.php');
    exit();
    }
}// end foreach
?>
