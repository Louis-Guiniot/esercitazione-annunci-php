<?php

            require_once('config.php');
           
            session_start();
            if (!isset($_SESSION['user'])) {
                header("Location:login.php");
            }
           
?>

<html>

<head>
    <title>Home</title>

    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</head>

<body>

    <div class="box">

    <div class="row">    
                <div class="col">
                    <div class="input-group mb-3">
                        <a href="logout.php"><button class="btn btn-dark">logout</button></a>
                    </div>                
                </div>
                <div class="col-10">
               
                </div>
            </div>

        <form action="upload.php" method="post" enctype="multipart/form-data">

        
        
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="fileUrl" aria-describedby="inputGroupFileAddon01" name="fileUrl">
                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupFileAddon01">Prezzo</span>
                            </div>
                            <input type="text" class="form-control" placeholder="prezzo" aria-label="Recipient's username" aria-describedby="button-addon2" name="prezzo" autocomplete="off">

                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupFileAddon01">Descrizione</span>
                            </div>
                            <textarea type="text" class="form-control" placeholder="prezzo" aria-label="Recipient's username" aria-describedby="button-addon2" name="descrizione" autocomplete="off"></textarea>

                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <button type="submit" class="form-control">inserisci</button>
                </div>

        </form>

        <form action="home.php" method="post">

        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupFileAddon01">Search</span>
                            </div>
                            <input type="text" class="form-control" placeholder="insert word to search" name="termine" autocomplete="off">

                        </div>
            <div class="input-group mb-3">
            <button class="form-control" type="submit">cerca</button>
            </div>
        </form>

    </div>


        <?php


            if(!isset($_POST['termine'])){

                require_once('config.php');
               
                $strSelect = "SELECT * FROM annuncio;";
                $resultSelect=$conn->query($strSelect);
    
                while($row=$resultSelect->fetch_assoc()){
    
                     echo "
                    <div class=card style='background-color:#FF9AA2; color:white; width:60%; margin:auto; margin-top:20px;'>
                        <div class=card-body>
                            <h5 class=card-title>".$row['idannuncio']."</h5>
                            <p class=card-text>Prezzo: ".$row['prezzo']."</p>
                            <p class=card-text>Immagine: ".$row['immagine']."</p>
                            <p class=card-text>Descrizione: ".$row['descrizione']."</p>
    
                        </div>
                    </div>
                    ";
      
            
                }
    
                $conn->close();
            }else{
                
                    require_once('config.php');
                    
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

            }
        ?>

</body>

</html>