<?php



$username = 'c31samara';
$password = 'sherlock221B';
$dbname = 'c31odev';

try{

//$db = new PDO("mysql:host=localhost; dbname=$dbname; charset=utf8", $username, $password);

$db = new PDO("mysql:host=localhost; dbname=odev; charset=utf8", "root", "");

} catch (PDOException $e){
    echo "Veri Tabanı Bağlantı Hatası : ".$e;
}