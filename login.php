<?php
if(isset($_POST['username'])){
   $msg="";
   require('config.php');


   $user =($_POST['username']);
   $psw=($_POST['password']);
   $user = str_replace("'", "", $user);
   $psw = str_replace("'", "", $psw);
   //troncamento di stringhe troppo lunghe
   //$user=substr($user,0,32);
   //$psw=substr($psw,0,32);

   //backslash davanti ad apice singolo difesa da SQLINJECTION
   //$user=mysql_real_escape_string($_POST['username']);
   //$psw=mysql_real_escape_string($_POST['password']);
   //$strSelect="SELECT * FROM user WHERE username='".$user."' AND password='".$psw."';";
   $strSelect="SELECT * FROM user WHERE username='".$user."' AND password='".$psw."'LIMIT 1;";
  // "SELECT * FROM user WHERE username='".$user."' AND password='".crypt(md5($psw))."';";

   //echo $strSelect;
   $result=$conn->query($strSelect);
   //echo $result;

   if($result->num_rows==1)
   {
       $row=$result->fetch_assoc();
      // echo "username: ".$row['username']."<br>";
       session_start();
       $_SESSION['user']=$user;
       $conn->close();
       echo "codice passato";
       header("Location:home.php");
   }
   else{
       session_start();
       $_SESSION['conta']=$_SESSION['conta']+1;
      // echo $_SESSION['conta'];
       if($_SESSION['conta']==3){
         session_destroy();
         header("Location:hack.php");

       }

       $msg="Utente non abilitato";
       echo $msg;
   }
}
?>  

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title></title>
   </head>
   <body>

     <form class="" action="login.php" method="post">
       username: <input type="text" name="username" placeholder="username"> <br>
       password: <input type="password" name="password" placeholder="password"> <br>
       <button type="submit" name="button">invio</button>
     </form>

   </body>
 </html>
