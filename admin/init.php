<?php


    // Error Reporting

    ini_set('display_errors','On');
    error_reporting(E_ALL);


    //include globale file
    include 'connect.php';  // include connexion file

    //Route Directory
    $dirFunc = 'includes/functions/'; // function directory
    $dirTbl = 'includes/templates/'; // templates directory
    $dirLang = 'includes/languages/';    //languages directory
    $dirCss = 'layout/css/'; // Css directory
    $dirJs = 'layout/js/' ;// JavaScript directory



    //Include the important file
    include $dirFunc .'functions.php';
    include $dirLang .'english.php';
    include $dirTbl ."header.php";

    // insert the navabar insid all pages expect pages have a variable $noNavBar
    if(!isset($noNavbar)){
        include $dirTbl."navbar.php";
    }

?>