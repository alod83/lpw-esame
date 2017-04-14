<?php

include('config.php');
include('../php/functions.php');

if( !isset($_REQUEST['project_id'])	||
	!isset($_REQUEST['titolo']) 		||
	!isset($_REQUEST['tag']) 		||
	!isset($_REQUEST['source']) 		||
	!isset($_REQUEST['name']) 		||
	!isset($_REQUEST['surname']) 	||
	!isset($_REQUEST['matricola']) 	||
	!isset($_REQUEST['name'][0]) 	||
	!isset($_REQUEST['surname'][0]) 	||
	!isset($_REQUEST['matricola'][0]))
		$return = array('status' => 'error', 'details' => 'Missing parameters');
else
{
	$id_progetto = $_REQUEST['project_id'];
	
	// inserisco studenti nel database
	for($i = 0; $i < count($_REQUEST['name']); $i++)
	{
		$name = mysqli_real_escape_string($conn,$_REQUEST['name'][$i]);
		$surname = mysqli_real_escape_string($conn,$_REQUEST['surname'][$i]);
		$matricola = mysqli_real_escape_string($conn,$_REQUEST['matricola'][$i]);
		
		$query = "INSERT INTO studenti (matricola,nome,cognome,id_progetto)
		VALUES ('$matricola','$name', '$surname', '$id_progetto')";
		$result = mysqli_query($conn, $query);
		if(!$result)
			$return = array('status' => 'error', 'details' => "Errore nell'inserimento del candidato $name $surname ".mysqli_error($conn));
		else
		{
			$titolo = mysqli_real_escape_string($conn,$_REQUEST['titolo']);
			$tag = mysqli_real_escape_string($conn,$_REQUEST['tag']);
			$source = mysqli_real_escape_string($conn,$_REQUEST['source']);
			$query = "INSERT INTO progetti (id_progetto,titolo,tag,source)
			VALUES ('$id_progetto','$titolo', '$tag', '$source')";
			$result = mysqli_query($conn, $query);
			if(!$result)
				$return = array('status' => 'error', 'details' => "Errore nell'inserimento del progetto ".mysqli_error($conn));
			else 
				$return = array('status' => 'ok', 'details' => 'Procedura di caricamento del progetto completata con successo');
				
		}
	}
}

$pl  		= parse_ini_file("../config.ini", true);			// read parameters from config file
$htdocs 	= $pl['Projects']['htdocs'];						// projects htdocs


$redirect_page = build_redirect($htdocs,$return,"4.php");
header($redirect_page);
?>