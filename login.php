<?php

session_start();

if (isset($_SESSION['user'])) {
    header("Location:home.php");

}else{

    if(isset($_POST['username'])){

        require('config.php');
        $msg="";

        $user =($_POST['username']);
        $psw=($_POST['password']);
        $user = str_replace("'", "", $user);
        $psw = str_replace("'", "", $psw);
     
        $strSelect="SELECT * FROM user WHERE username='".$user."' AND password='".$psw."'LIMIT 1;";
     
        $result=$conn->query($strSelect);
     
        if($result->num_rows==1)
        {
            $row=$result->fetch_assoc();
           // echo "username: ".$row['username']."<br>";
            session_start();
            $_SESSION['user']=$row['iduser'];
     
            $conn->close();
            echo "codice passato";
            header("Location:home.php");
        }
        else{
            session_start();
            $_SESSION['conta']=$_SESSION['conta']+1;
     
            if($_SESSION['conta']==3){
              session_destroy();
              header("Location:hack.php");
     
            }
     
            $msg="Utente non abilitato";
            echo $msg;
        }
     }
}

?>  

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Login</title>
     <link rel="stylesheet" href="login.css">
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
     <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </head>
   
   
   <body>
    <div class="box">
        <form class="form" action="login.php" method="post">
        <div class="row">
                <div class="col">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-dark text-light" id="basic-addon1">Username</span>
                        </div>
                        <input type="text" class="form-control" placeholder="insert username" name="username" autocomplete="off">

                    </div>
                </div>
                <div class="col">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-dark text-light" id="basic-addon1">Password</span>
                        </div>
                        <input type="text" class="form-control" placeholder="insert password" name="password" autocomplete="off">

                    </div>
                </div>
            </div>

            <div class="input-group mb-3">
                <button type="submit" class="form-control btn btn-dark">inserisci</button>
            </div>      
        </form>   

    </div>    
    </body>
 </html>
