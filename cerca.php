<?php
require_once('config.php');
session_start();
if (!isset($_SESSION['user'])) {
    header("Location:login.php");
}else{
 if(isset($_POST['termine'])){


    $query="SELECT * FROM `vuln`.`annuncio` WHERE (idannuncio LIKE '%".$_POST['termine']."%' OR prezzo LIKE '%".$_POST['termine']."%' OR immagine LIKE '%".$_POST['termine']."%' OR descrizione LIKE '%".$_POST['termine']."%')";
  
     $resultSelect=$conn->query($query);

            while($row=$resultSelect->fetch_assoc()){

                 echo "
                <div class=card style='background-color:#FF9AA2; color:white; width:60%; margin:auto; margin-top:20px;'>
                    <div class=card-body>
                        <h5 class=card-title>".$row['idannuncio']."</h5>
                        <p class=card-text>Prezzo: ".$row['prezzo'].".</p>
                        <p class=card-text>Immagine: ".$row['immagine'].".</p>
                        <p class=card-text>Descrizione: ".$row['descrizione'].".</p>

                    </div>
                </div>
                ";
  
        
            }
    }
 }
?>