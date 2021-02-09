<?php
//rootShop
//L0sA.A22i$3C
$dsn = 'mysql:host=localhost;dbname=shop';
$user = 'root';
$psd = '';
$option = array(
    // to enable arabic charcarter in pdo
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
);

try{
    $cnx = new PDO($dsn,$user,$psd,$option);
    $cnx->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
 //  echo 'you are connceted welcome to database';
}catch (PDOException $e){
//   echo 'failed to connect'. $e->getMessage();
}

?>