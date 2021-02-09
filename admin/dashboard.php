<?php

ob_start();

session_start();
//$_SESSION["username"] = null;
if(isset($_SESSION["username"])){


    //echo "welcome ". $_SESSION['username'];

    $pageTitle = 'Dashboard';

    include 'init.php';

}else
{
    header('Location: index.php');

}

?>

<div class="container">
  <div class="row justify-content-center">
      <h1 class="text-center py-3"> Add Membres</h1>
  </div>
    <div class="row mb-3">
        <div class="col-xl-3 col-sm-6 py-2 boite-carte">
            <div class="card bg-success text-white h-100">
                <div class="card-body text-center carte">
                    <div class="rotate">
                        <i class="fas fa-users fa-4x"></i>
                    </div>
                    <h6 class="text-uppercase">Users</h6>
                    <h1 class="display-4"><a href="members.php" ><?php echo countItem("id","users")?></a></h1>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 py-2 boite-carte">
            <div class="card text-white bg-danger h-100">
                <div class="card-body text-center carte">
                    <div class="rotate">
                        <i class="fas fa-user-lock fa-4x"></i>
                    </div>
                    <h6 class="text-uppercase">Unlock Users</h6>
                    <h1 class="display-4"><a href="members.php?page=Pending"><?php echo countItem("id","users","where RegStatus = 0")?></a></h1>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 py-2 boite-carte">
            <div class="card text-white bg-info h-100">
                <div class="card-body text-center carte">
                    <div class="rotate">
                        <i class="fab fa-twitter fa-4x"></i>
                    </div>
                    <h6 class="text-uppercase">Tweets</h6>
                    <h1 class="display-4">125</h1>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 py-2 boite-carte">
            <div class="card text-white bg-warning h-100">
                <div class="card-body text-center carte">
                    <div class="rotate">
                        <i class="fas fa-share fa-4x"></i>
                    </div>
                    <h6 class="text-uppercase">Shares</h6>
                    <h1 class="display-4">36</h1>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="container">
        <div class="row mb-3">
            <div class="col-sm-6 py-2">
                <div class="card text-white bg-info" >

                    <div class="card-header">Latest 5 User register</div>
                    <div class="card-body bg-light text-dark">

                        <p class="card-text">
                            <ul  class="list-group">
                                <?php

                                foreach (getLatest("id,fullname","users","order by date desc limit 5") as $row ){
                                   echo "<li class='list-group-item d-flex justify-content-sm-between'>".$row["fullname"]."
  <a href='members.php?do=Edit&userid=". $row['id']. "' class='btn btn-success btn-tabel-sm'><i class=\" pr-2 fas fa-user-edit\"></i>Edit</a>
</li>";

                                }

                                ?>
                            </ul>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 py-2">
                <div class="card text-white bg-info">
                    <div class="card-header">Lorem ipsum dolor.</div>
                    <div class="card-body card-body bg-light text-dark">

                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur, labore.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>



<?php


include $dirTbl . "footer.php";


ob_end_flush();
?>




