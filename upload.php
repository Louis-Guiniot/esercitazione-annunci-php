

<?php
require_once('config.php');
session_start();
if (!isset($_SESSION['user'])) {
    header("Location:login.php");
}else{
 if(isset($_POST['prezzo'])){
     //INSERT INTO `vuln`.`annuncio` (`idannuncio`, `prezzo`, `immagine`, `descrizione`, `user_iduser`) VALUES ('2', '123', 'footoo', 'desc', '1');
     
     // Where are we going to be writing to?
    $target_path  = "uploads/";
    $target_path .= basename( $_FILES[ 'fileUrl' ][ 'name' ] );

    // File information
    $uploaded_name = $_FILES[ 'fileUrl' ][ 'name' ];
    $uploaded_ext  = substr( $uploaded_name, strrpos( $uploaded_name, '.' ) + 1);
    $uploaded_size = $_FILES[ 'fileUrl' ][ 'size' ];
    $uploaded_tmp  = $_FILES[ 'fileUrl' ][ 'tmp_name' ];

    // Is it an image?
    if( ( strtolower( $uploaded_ext ) == "jpg" || strtolower( $uploaded_ext ) == "jpeg" || strtolower( $uploaded_ext ) == "png" ) &&
        ( $uploaded_size < 1000000 ) &&
        getimagesize( $uploaded_tmp ) ) {

        // Can we move the file to the upload folder?
        if( !move_uploaded_file( $uploaded_tmp, $target_path ) ) {
            // No
            echo '<pre>Your image was not uploaded.</pre>';
            echo "<a href=home.php>turna ndret</a>";
        }
        else {
            // Yes!
            // echo "<pre>{$target_path} succesfully uploaded!</pre>";
            // echo "<a href=home.php>turna ndret</a>";

            header("Location:home.php");
        }
    }
    else {
        // Invalid file
        echo '<pre>Your image was not uploaded. We can only accept JPEG or PNG images.</pre>';
    }

    // Get input
    $prezzo = trim( $_POST[ 'prezzo' ] );
    $descrizione = trim( $_POST[ 'descrizione' ] );

    // Sanitize message input
    $message = strip_tags( addslashes( $prezzo ) );
    $prezzo = ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"],  $prezzo ) : ((trigger_error("[MySQLConverterToo] HACKERINO!!!!", E_USER_ERROR)) ? "" : ""));
    //$prezzo = ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"],  $prezzo ) : ((trigger_error("[MySQLConverterToo] HACKERINO!!!!", E_USER_ERROR)) ? "" : ""));
    $prezzo = htmlspecialchars( $prezzo );

    // Sanitize descrizione input
    $descrizione = preg_replace( '/<(.*)s(.*)c(.*)r(.*)i(.*)p(.*)t/i', '', $descrizione );
    $descrizione = ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"],  $descrizione ) : ((trigger_error("[MySQLConverterToo] LMAO HACKER", E_USER_ERROR)) ? "" : ""));

    // Update database
    
    //mysql_close();    


     $strInsert = "INSERT INTO `vuln`.`annuncio` (`idannuncio`, `prezzo`, `immagine`, `descrizione`, `user_iduser`) VALUES
     ( DEFAULT,
       '" . $prezzo . "',
       '" . $uploaded_name . "',
       '" . $descrizione . "',
       '" . $_SESSION['user'] . "'
     )";


     $result = $conn->query($strInsert);
     $conn->close();

 }   
}

?>