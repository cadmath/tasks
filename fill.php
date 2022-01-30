<?php

$dns = 'mysql:host=localhost;dbname=home';
$db = new PDO($dns, 'root','');

$arr_user = [
    [
        'foto' => 'img/demo/authors/sunny.png',
        'alt_foto' => 'Sunny A.',
        'portfolio' =>  'Sunny A. (UI/UX Expert)',
        'occupation' => 'Lead Author',
        'twitter_link' => 'https://twitter.com/@myplaneticket',
        'twitter'=> '@myplaneticket',
        'bootstrap' => 'https://wrapbootstrap.com/user/myorange',
        'title' => 'Contact Sunny',
        'status' => 'active'
    ],
    [
        'foto' => 'img/demo/authors/josh.png',
        'alt_foto' => 'Jos K.',
        'portfolio' =>  'Jos K. (ASP.NET Developer)',
        'occupation' => 'Partner &amp; Contributor',
        'twitter_link' => 'https://twitter.com/@atlantez',
        'twitter'=> '@atlantez',
        'bootstrap' => 'https://wrapbootstrap.com/user/Walapa',
        'title' => 'Contact Jos',
        'status' => 'active'
    ],
    [
        'foto' => 'img/demo/authors/jovanni.png',
        'alt_foto' => 'Jovanni Lo',
        'portfolio' =>  'Jovanni L. (PHP Developer)',
        'occupation' => 'Partner &amp; Contributor',
        'twitter_link' => 'https://twitter.com/@lodev09',
        'twitter'=> '@lodev09',
        'bootstrap' => 'https://wrapbootstrap.com/user/lodev09',
        'title' => 'Contact Jovanni',
        'status' => 'banned'
    ],
    [
        'foto' => 'img/demo/authors/roberto.png',
        'alt_foto' => 'Jovanni Lo',
        'portfolio' =>  'Roberto R. (Rails Developer)',
        'occupation' => 'Partner &amp; Contributor',
        'twitter_link' => 'https://twitter.com/@sildur',
        'twitter'=> '@sildur',
        'bootstrap' => 'https://wrapbootstrap.com/user/sildur',
        'title' => 'Contact Roberto',
        'status' => 'banned'
    ]
        
];

$sql = 'INSERT INTO users (foto, alt_foto, portfolio, occupation, twitter_link, twitter, bootstrap, title, status) VALUES ( :foto, :alt_foto, :portfolio, :occupation, :twitter_link, :twitter, :bootstrap, :title, :status)';
$prepire = $db->prepare($sql);
foreach ($arr_user as $user){
$insert = $prepire->execute([
        'foto'=>$user['foto'], 
        'alt_foto'=>$user['alt_foto'],
        'portfolio'=>$user['portfolio'],
        'occupation'=>$user['occupation'],
        'twitter_link'=>$user['twitter_link'],
        'twitter'=>$user['twitter'],
        'bootstrap'=>$user['bootstrap'],
        'title'=>$user['title'],
        'status'=>$user['status']]
    ); 
}
echo '˄its Work!˄';

?>