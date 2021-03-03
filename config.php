<?php
	define('DB_HOST','localhost');
	define('DB_USER', 'root');
	define('DB_PASSWORD','');
	define('DB_DATABASE','vuln');



	//connessione al database
	$conn=new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);

	if(mysqli_connect_errno()==true) //se la connessione fallisce
		die('Errore di connessione'); //die interrompe l'esecuzione del codice e fa uscire un messaggio di errore

	//echo "connessione ok";



?>