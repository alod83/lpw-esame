<?php

include('../php/functions.php');
$pl  		= parse_ini_file("../config.ini", true);			// read parameters from config file
$pbd     	= $pl['Projects']['base_dir'];						// projects base directory
$return		= null;
if(!isset($_REQUEST['project_id']))
	$return = array('status' => 'error', 'details' => 'Parametri mancanti');
else
{
	$project_id = $_REQUEST['project_id'];
	// information related to the specific project
	$pdir 		= $pbd.$project_id."/"; 								// directory where the project will be installed
	if(system("rm -rf ".escapeshellarg($pdir)) !== false)
		$return = array('status' => 'ok', 'details' => 'Rimozione progetto avvenuta con successo');
	else
		$return = array('status' => 'error', 'details' => 'Impossibile rimuovere la directory');
}
$htdocs 	= $pl['Projects']['htdocs'];						// projects htdocs

$redirect_page = build_redirect($htdocs,$return,"4.php");
header($redirect_page);

?>