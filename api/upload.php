<?php

include('config.php');
include('../php/functions.php');


$return 	= null;
$pl  		= parse_ini_file("../config.ini", true);			// read parameters from config file
$htdocs 	= $pl['Projects']['htdocs'];						// projects htdocs
	
if( !isset($_REQUEST['matricola']) 	||
	!isset($_REQUEST['matricola'][0]))
		$return = array('status' => 'error', 'details' => 'Parametri mancanti');
else
{
	$matricola = $_REQUEST['matricola'][0];
	
	$rfo 		= $pl['StudentProject']['required_folders'];		// required folders
	$rfi 		= $pl['StudentProject']['required_files'];			// required files
	$phtdocs	= $htdocs."progettini/";
	// append to $rfi files related to the specific student
	$rfi []		= 'dump/'.$matricola.'.sql';
	
	$pbd     	= $pl['Projects']['base_dir'];						// projects base directory
	
	// information related to the specific project
	$pdir 		= $pbd.$matricola."/"; 								// directory where the project will be installed 
    $pconfig	= $pdir.$pl['StudentProject']['config_file'];		// path to the project config file
    $pdump	 	= $pdir.$pl['StudentProject']['dump_dir'].$matricola.".sql";					// path to the dump file
    
    $cconfig 	= build_config($matricola);							// get the content of config file
	
	// project installation
    $tmp_path_file = $_FILES['progetto']['tmp_name'];
    // unzip project
    $return = unzip_project($tmp_path_file, $pbd, $matricola);
    if($return['status'] == 'ok')
    {
    		// check project structure
    		$return = check_structure($pdir, $rfo, $rfi);
    		if($return['status'] == 'ok')
    		{
    			// install MySQL
    			$return = install_mysql($pconfig,$cconfig,$conn,$matricola,$phtdocs);
    		}
    		else 
    		{
    			// rimuovo il progetto
    			system("rm -rf ".escapeshellarg($pdir));
    		}
	} 
}

$redirect_page = build_redirect($htdocs,$return,"2.php");	
header($redirect_page);
?>