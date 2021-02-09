<?php



    // gave a custom title for any page with this function
    function getTitle(){

        global $pageTitle;


        if(isset($pageTitle)){
            echo $pageTitle;
        }else{
            echo 'Default';
        }
    }



    // redirect to index page if you get an error

    function redirectToHome($errorMsg,$url= null,$link = null ,$time = 3){


        echo $errorMsg;
        if($url ===  null){
            $url = "index.php";
            $link = "home Page";
        }



        if($url === "back"){
            $url = isset($_SERVER["HTTP_REFERER"]) && $_SERVER['HTTP_REFERER'] !== ""  ? $_SERVER["HTTP_REFERER"] : $url;


        }

        echo "<div class='alert alert-info' role='alert'>You will be redirect to $link after ".$time ." seconds</div>";

        header("refresh:$time;url=$url");
    }


    // function check if an item alredy exist in data base

    function checkItem($select,$from,$value){
        global $cnx;

        $reqCheck = $cnx->prepare("select $select from $from where $select = ?");

        $reqCheck->execute([$value]);

        return $reqCheck->rowCount();

    }



    // function to get number of users inside any tabel in data base


    function countItem($column,$table,$where=""){

        global $cnx;

        $reqCountTtem = $cnx->prepare("select count($column) from $table $where");

        $reqCountTtem->execute();

        return $reqCountTtem->fetchColumn();

    }


    /// Gets Latest Record Function

    function getLatest($column,$table,$where=""){

        global  $cnx;


        $req = $cnx->prepare("select $column from $table $where");

        $req->execute();

        $rows = $req->fetchAll();

        return $rows;
    }









?>