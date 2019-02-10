<?php

// Environment variable read
$env_file = fopen(".env", "r");
if($env_file){
    while ($env_line = fgets($env_file)) {
        putenv($env_line);
    }
}
fclose($env_file);


$userAuth=getenv("USER").':'.getenv("AUTH_TOKEN");

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://my.nocix.net/api/list-services/');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_USERPWD, $userAuth);
$data = curl_exec($ch);
curl_close($ch);
$result = json_decode($data);


foreach($result as $val){
    echo '<h1>契約ID:'.$val->id.'</h1>';
    echo '<table border="1">';
    foreach($val as $key => $val2){
        echo '<tr>';
        echo '<td>'.$key.'</td>';
        echo '<td>'.$val2.'</td>';
        echo '</tr>';
    }
    echo '</table>';
}