<?php

ob_start();
session_start();
if (isset($_SESSION["username"])) {

    $pageTitle = 'Categories';

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

        $req = $cnx->prepare("select * from categories");

        $req->execute();

        $cats = $req->fetchAll();


        ?>

        <h1 class="text-center py-3">Welcome in manage categories page</h1>

        <a href="categories.php?do=Add" class="p-2 btn btn-primary mb-3"><i class="pr-2 fas fa-plus" ></i>Add Category</a>



    <?php } elseif ($do == 'Add') { ?>

        <h1 class="text-center py-3"> Add Category</h1>
        <form action="?do=Insert" method="POST">
            <div class="form-group row">
                <label for="name" class="col-sm-2 offset-lg-2 col-form-label">Name</label>
                <div class="col-sm-10 col-lg-6">
                    <input type="text" class="form-control" id="name"
                           name="name" placeholder="Name of category" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="description" class="col-sm-2 offset-lg-2 col-form-label">Decsription</label>
                <div class="col-sm-10 col-lg-6">
                    <input type="text" class="form-control" id="description" name="description"
                           placeholder="Decsription" >
                </div>
            </div>

            <div class="form-group row">
                <label for="ordering" class="col-sm-2 offset-lg-2 col-form-label">Ordering</label>
                <div class="col-sm-10 col-lg-6">
                    <input type="number" value="0"  class="form-control" id="ordering" name="ordering" placeholder="Ordering"
                           >
                </div>
            </div>

            <div class="form-group row">
                <label for="fullname" class="col-sm-2 offset-lg-2 col-form-label">Visible</label>
                <div class="col-sm-10 col-lg-6">
                    <div class="form-check ">
                        <input class="form-check-input" type="radio" name="visibility" id="vis-yes" value="1" checked>
                        <label class="form-check-label" for="vis-yes">Yes</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="visibility" id="vis-no" value="0" >
                        <label class="form-check-label" for="vis-no">No</label>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="fullname" class="col-sm-2 offset-lg-2 col-form-label">Allow Comment</label>
                <div class="col-sm-10 col-lg-6">
                    <div class="form-check ">
                        <input class="form-check-input" type="radio" name="comment" id="com-yes" value="1" checked>
                        <label class="form-check-label" for="com-yes">Yes</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="comment" id="com-no" value="0">
                        <label class="form-check-label" for="com-no">No</label>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="fullname" class="col-sm-2 offset-lg-2 col-form-label">Allow Ads</label>
                <div class="col-sm-10 col-lg-6">
                    <div class="form-check ">
                        <input class="form-check-input" type="radio" name="ads" id="ads-yes" value="1" checked>
                        <label class="form-check-label" for="ads-yes">Yes</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="ads" id="ads-no" value="0">
                        <label class="form-check-label" for="ads-no">No</label>
                    </div>
                </div>
            </div>

            <button type="submit" class=" offset-lg-2 btn btn-primary">Add Category</button>
        </form>


   <?php } elseif ($do == 'Insert') {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $name =  $_POST['name'];
        $description = $_POST['description'];
        $order = $_POST['ordering'];
        $visible = $_POST['visibility'];
        $comment = $_POST['comment'];
        $ads = $_POST['ads'];



        if (!empty($name)) {

            $check = checkItem("name","categories",$name);

            if($check == 1){
                $errorMsg ="<div class='alert alert-danger' role='alert'>The category name is already exist</div>";

                redirectToHome($errorMsg,"categories.php?do=Add","Add Page",3);
            }else{

                $req = $cnx->prepare("insert into categories (name, description, orodering, visibility, allow_comment,allow_ads)
                                    values (?,?,?,?,?,?)");

                $req->execute([ $name,$description ,$order , $visible , $comment , $ads]);


                $errorMsg ="<div class='alert alert-success' role='alert'>" . $req->rowCount()." Record inserted</div>";

                redirectToHome($errorMsg,"categories.php","Categories Page",3);

            }

        }else{
            $errorMsg = "<div class='alert alert-danger' role='alert'>Should not the name empty</div>";

            redirectToHome($errorMsg,"categories.php?do=Add","Add Page",3);
        }


    }
    else{
        $errorMsg =  "<div class='alert alert-danger' role='alert'>Sorry you can't browse this page directly</div>";
        redirectToHome($errorMsg,null,null,3);

    }



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
