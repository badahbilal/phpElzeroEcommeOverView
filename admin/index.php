<?php
session_start();
//print_r($_SESSION);

$noNavbar='';
$pageTitle = 'Login';

if(isset($_SESSION['username'])){
    header('Location: dashboard.php');
}
include "init.php";



if($_SERVER['REQUEST_METHOD'] == 'POST'){

    // check if yser come from post requist
    $username = $_POST['user'];
    $password = $_POST['password'];
    $hashpass = sha1($password);


   // echo $username . ' '. $password . '<br>'.$hashpass;
/*

`id`, `username`, `password`, `email`, `fullname`, `groupID`, `trustStatus`, `RegStatus`

*/

    //check if the user exist in database

    $req = $cnx->prepare("select id, username,  password from users where username = ? and password = ? and groupID = 1 LIMIT 1");

    $req->execute([$username,$hashpass]);

    $row = $req->fetch();
    //var_dump($row);

    $count = $req->rowCount();

  //  echo $count;

    if($count == 1){
        $_SESSION["username"] = $username;
        $_SESSION["id"] = $row['id'];

        //print_r($_SESSION);

        header('Location: dashboard.php');
        exit();
    }
    else {
       // echo 'sorry connect failed';
    }

}
?>
<div class="container login">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-4">
            <form autocomplete="off" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                <h4 class="text-center">Admin login</h4>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="user" name="user" aria-describedby="username" placeholder="username" autocomplete="false">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="new-password">
                </div>
                <!-- <div class="form-group form-check">
                     <input type="checkbox" class="form-check-input" id="exampleCheck1">
                     <label class="form-check-label" for="exampleCheck1">Check me out</label>
                 </div>-->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary ">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php include $dirTbl ."footer.php";?>