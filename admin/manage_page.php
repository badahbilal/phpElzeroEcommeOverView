<?php

ob_start();
session_start();
if (isset($_SESSION["username"])) {


    //echo "welcome ". $_SESSION['username'];

    $pageTitle = 'Members';

    include 'init.php';

} else {

    header('Location: index.php');

}
/*
 *  members => [ Manage |edit | Update | Add | Insert | Delete | Stats]
 *
 * */

?>

<?php




    /*
     *  categories => [ Mange |edit | Update | Add | Insert | Delete | Stats]
     *
     * */


    $do='';

    $do = isset($_GET['do'])? $_GET['do'] : 'Manage';

    /*if(isset($_GET['do'])){
        $do =  $_GET['do'];
    }else{
        $do ='Manage';
    }*/

    if($do == 'Manage'){
         echo "welcome in manage<br> <a href='?do=Add'>add page</a>";
    }elseif($do == 'Add'){
    echo 'add';
    }elseif ($do == 'Edit'){
    echo 'edit';
    }else{
        echo 'There is not page with this name '.$do;
    }
?>
