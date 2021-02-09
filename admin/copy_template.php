<?php

ob_start();
session_start();
if (isset($_SESSION["username"])) {


    $pageTitle = 'Members';

    include 'init.php';

} else {

    header('Location: index.php');

}


?>

<div class="container mt-4">

    <?php


    $do = '';

    $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';


    if ($do == 'Manage') {


    } elseif ($do == 'Add') {

    } elseif ($do == 'Insert') {

    } elseif ($do == 'Edit') {

    } elseif ($do == 'Update') {

    } elseif ($do == 'Delete') {

    } elseif ($do == 'Activate') {

    }

    ?>


</div>

<?php include $dirTbl . "footer.php";

ob_end_flush();
?>
