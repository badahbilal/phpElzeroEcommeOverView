<?php

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

<div class="container mt-4">

    <?php


    $do = '';

    $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';


    if ($do == 'Manage') { ?>


        <?php

            $where = "";
            if(isset($_GET['page']) && $_GET['page'] == "Pending"){
                $where = "where RegStatus = 0";
            }
            $req = $cnx->prepare("select * from users $where");

            $req->execute();

            $rows = $req->fetchAll();

        ?>


        <h1 class="text-center py-3">Welcome in manage page</h1>

        <a href="members.php?do=Add" class="p-2 btn btn-primary mb-3"><i class="pr-2 fas fa-plus" ></i>Add Membres</a>

        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#ID</th>
                    <th scope="col">User Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Full Name</th>
                    <th scope="col">Registred Date</th>
                    <th scope="col">Control</th>
                </tr>
                </thead>
                <tbody>
                <?php

                foreach ($rows as $row) {
                    if( $row['RegStatus'] == 0) {
                        echo "<tr class='bg-warning'>";
                    }else {
                        echo "<tr>";
                    }

                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["username"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["fullname"] . "</td>";
                    echo "<td>" . $row["date"] . "</td>";
                    echo "<td class='text-center'>
                                <a href='members.php?do=Edit&userid=". $row['id']. "' class='btn btn-success btn-tabel-sm'><i class=\" pr-2 fas fa-user-edit\"></i>Edit</a>
                                <a href='members.php?do=Delete&userid=". $row['id']. "' class='btn btn-danger btn-tabel-sm confirm'><i class=\"pr-2 fas fa-user-times\"></i>Delete</a>";

                    if( $row['RegStatus'] == 0) {
                           echo  "<a href='members.php?do=Delete&userid=". $row['id']. "' class='btn btn-info btn-tabel-sm confirm ml-2'><i class=\"pr-2 fas fa-user-times\"></i>Activate</a>";

                         }
                     echo     "</td>";

                    echo "</tr>";


                }
                ?>

                </tbody>
            </table>
        </div>



   <?php } elseif ($do == 'Add') { ?>


        <h1 class="text-center py-3"> Add Membres</h1>
        <form action="?do=Insert" method="POST">
            <div class="form-group row">
                <label for="username" class="col-sm-2 offset-lg-2 col-form-label">Username</label>
                <div class="col-sm-10 col-lg-6">
                    <input type="text" class="form-control" id="username"
                           name="username" placeholder="Username" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-sm-2 offset-lg-2 col-form-label">Password</label>
                <div class="col-sm-10 col-lg-6">
                    <input type="password" class="form-control password" id="password" name="password"
                           placeholder="Password" autocomplete="new-password" required>
                    <i class="fas fa-eye showPass"></i>
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-sm-2 offset-lg-2 col-form-label">Email</label>
                <div class="col-sm-10 col-lg-6">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                           required>
                </div>
            </div>

            <div class="form-group row">
                <label for="fullname" class="col-sm-2 offset-lg-2 col-form-label">Full Name</label>
                <div class="col-sm-10 col-lg-6">
                    <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Full Name"
                          required >
                </div>
            </div>
            <button type="submit" class=" offset-lg-2 btn btn-primary">Add Membre</button>
        </form>

    <?php } elseif ($do == 'Insert') {


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $errorMsg= "";

                // get varibles from the form


                $username = $_POST['username'];
                $pass = $_POST['password'];
                $email = $_POST['email'];
                $fullname = $_POST['fullname'];
                $hashPass = sha1($pass);

                //Valsation form


                $formError = [];


                if (empty($username)) {
                    $formError[] = 'Should not the user name empty';
                }

                if (empty($pass)) {
                    $formError[] = 'Should not the password empty';
                }

                if (empty($email)) {
                    $formError[] = 'Should not the email empty';
                }

                if (empty($fullname)) {
                    $formError[] = 'Should not the full name empty';
                }

                foreach ($formError as $error) {
                   $errorMsg .=  "<div class='alert alert-danger' role='alert'>" . $error . "</div>";
                }

                if (empty($formError)) {

                    //check existing item in data base or not

                    $check = checkItem("username","users",$username);

                    if($check == 1){
                        $errorMsg ="<div class='alert alert-danger' role='alert'>The user already exist</div>";

                        redirectToHome($errorMsg,"members.php?do=Add","Add Page",3);
                    }
                    else{


                    //first way
    //                $req = $cnx->prepare("insert into users (username,password,email,fullname) values (?,?,?,?)");
    //                $req->execute([$username,$hashPass,$email,$fullname]);

    //                //or second way
                    $req = $cnx->prepare("insert into users (username,password,email,fullname,RegStatus,date) values (:zusername,:zpassword,:zemail,:zfullname, 1 ,now())");
                    $req->execute(["zusername"=>$username,"zpassword"=>$hashPass,"zemail"=>$email,"zfullname"=>$fullname]);


                        $errorMsg ="<div class='alert alert-success' role='alert'>" . $req->rowCount()." Record inserted</div>";

                        redirectToHome($errorMsg,"members.php","Members Page",3);
                    }
                }else{
                    redirectToHome($errorMsg,"members.php?do=Add","Add Page",3);
                }


        } else {
            $errorMsg =  "<div class='alert alert-danger' role='alert'>Sorry you can't browse this page directly</div>";
            redirectToHome($errorMsg,null,null,3);

            }
        ?>


    <?php } elseif ($do == 'Edit') {
    $isRightWay = isset($_SERVER["HTTP_REFERER"]);

    if($isRightWay) {


        $userId = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval(($_GET['userid'])) : -1;

        //check if the user exist in database

        $req = $cnx->prepare("select * from users where id = ? LIMIT 1");

        $req->execute([$userId]);

        $row = $req->fetch();
        //var_dump($row);

        $count = $req->rowCount();

        //  echo $count;

        if ($count == 1) { ?>


            <h1 class="text-center py-3"> Edit membres</h1>
            <form action="?do=Update" method="POST">
                <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                <div class="form-group row">
                    <label for="username" class="col-sm-2 offset-lg-2 col-form-label">Username</label>
                    <div class="col-sm-10 col-lg-6">
                        <input type="text" class="form-control" id="username" value="<?php echo $row['username'] ?>"
                               name="username" placeholder="Username" required="true">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-sm-2 offset-lg-2 col-form-label">Password</label>
                    <div class="col-sm-10 col-lg-6">
                        <input type="hidden" name="oldpassword" value="<?php echo $row['password'] ?>">
                        <input type="password" class="form-control password" id="password" name="newpassword"
                               placeholder="Password" autocomplete="new-password">
                        <i class="fas fa-eye showPass"></i>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-sm-2 offset-lg-2 col-form-label">Email</label>
                    <div class="col-sm-10 col-lg-6">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                               value="<?php echo $row['email'] ?>" required="true">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="fullname" class="col-sm-2 offset-lg-2 col-form-label">Full Name</label>
                    <div class="col-sm-10 col-lg-6">
                        <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Full Name"
                               value="<?php echo $row['fullname'] ?>" required="true">
                    </div>
                </div>
                <button type="submit" class=" offset-lg-4 btn btn-primary">Change</button>
            </form>


            <?php
        } else {

            $errorMsg = "<div class='alert alert-danger' role='alert'>no membre with this id" . $_GET['userid']."</div>";

            redirectToHome($errorMsg,"members.php","Members Page",3);

        }
    }else{

        $errorMsg ="<div class='alert alert-danger' role='alert'>You are not accessible from this way to this page</div>";

        redirectToHome($errorMsg,"index.php","Home Page",3);
    }

    } elseif ($do == 'Update') {




        // deny acces directly from url to this page

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            echo '<h1 class="text-center py-3"> Update membres</h1>';
            $errorMsg= "";
            // get varibles from the form

            $id = $_POST['id'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $fullname = $_POST['fullname'];


            // Password trick

            $pass = empty($_POST['newpassword']) ? $_POST['oldpassword'] : sha1($_POST['newpassword']);

            //Valsation form


            $formError = [];


            if (empty($username)) {
                $formError[] = 'Should not the user name empty';
            }

            if (empty($email)) {
                $formError[] = 'Should not the email empty';
            }

            if (empty($fullname)) {
                $formError[] = 'Should not the full name empty';
            }

            foreach ($formError as $error) {
                $errorMsg .= "<div class='alert alert-danger' role='alert'>" . $error . "</div>";
            }

            if (empty($formError)) {

                $req = $cnx->prepare("UPDATE users set username = ? , email = ? ,fullname = ?, password = ? where id = ? ");
                $req->execute([$username, $email, $fullname, $pass, $id]);

                if($req->rowCount() == 0){
                    $errorMsg =  "<div class='alert alert-info' role='alert'>You are not change any thing </div>";
                    redirectToHome($errorMsg,"back","Preview Page",3);
                    exit();
                }

                $errorMsg =  "<div class='alert alert-success' role='alert'>" . $req->rowCount() . " Record updated</div>";

                redirectToHome($errorMsg,"members.php","Members Page",3);
            }


        } else {
            $errorMsg  =  "<div class='alert alert-danger' role='alert'>Sorry you cant browse this page directly</div>";

            redirectToHome($errorMsg,"index.php", "Home Page");
        }


    }  elseif ($do == 'Delete') {

        $isRightWay = isset($_SERVER["HTTP_REFERER"]);

        if($isRightWay){

            $errorMsg = "";

            echo '<h1 class="text-center py-3"> Delete membres</h1>';

            $userId = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval(($_GET['userid'])) : -1;

            //check if the user exist in database

            $req = $cnx->prepare("select * from users where id = ? LIMIT 1");

            $req->execute([$userId]);

            $count = $req->rowCount();

            //  echo $count;

            if ($count == 1) {
                $req = $cnx->prepare("delete from users where id = :zuser");

                $req->bindParam(":zuser", $userId);

                $req->execute();

                $errorMsg = "<div class='alert alert-success' role='alert'>" . $req->rowCount() . " Record Deleted</div>";

                redirectToHome($errorMsg,"members.php", "Members Page");

            } else {

                $errorMsg = "<div class='alert alert-danger' role='alert'>There is no member with this id =  " . $userId."</div>";
                redirectToHome($errorMsg,"members.php", "Members Page");
            }

        }else{

            $error ="<div class='alert alert-danger' role='alert'>You are not accessible from this way to this page</div>";

            redirectToHome($error,"index.php","Home Page");
        }


    }

    ?>


</div>

<?php include $dirTbl . "footer.php"; ?>
