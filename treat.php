<?php
session_start();
$url='api.openweathermap.org/data/2.5/weather?q='.$_POST['city'].'&appid={my-api-key}';
var_dump($url);
$curl=curl_init($url);
curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
$data=curl_exec($curl);
if($data===false){
    $_SESSION['data']='City not  ibbbfound';
}else{
    $_SESSION['data']=json_decode($data,true);
    $_SESSION['q']=$_POST['city'];
}
var_dump($_SESSION['data']);
header('Location: /');
?>
