<?php

function build_config($matricola)
{
	return "<?php
include('../libraries/dbLibrary.php');

\$database = '$matricola';
\$password='';
\$username='root';
\$servername='localhost';

\$db = openDB(\$database, \$password, \$username, \$servername);
?>";
}


/*
 * Scompatta il progetto, che si trova nel percorso $tmp_path_file e lo colloca
 * nella directory $pbd/$matricola
 * @tmp_path_file - percorso del file da scompattare
 * @pbd - base dir in cui scompattare il progetto
 * @matricola - numero di matricola
 */
function unzip_project($tmp_path_file, $pbd, $matricola)
{
	// sposto il file nella cartella progettini
	$path_file = $pbd.$matricola.".zip";
	//echo $path_file;
	rename($tmp_path_file, $path_file);
	// unzippo il file
	$zip = new ZipArchive;
	if ($zip->open($path_file) === TRUE) {
		$zip->extractTo($pbd);
		$zip->close();
		if(unlink($path_file))
			return array('status' => 'ok');
		$return = array('status' => 'error', 'details' => 'Impossibile rimuovere cartella originale del progetto');
	}
	$return = array('status' => 'error', 'details' => 'Impossibile scompattare il progetto');
}

function check_element($pdir,$rel,$error_string)
{
	for($i = 0; $i < count($rel); $i++)
		if(!file_exists($pdir.$rel[$i]))
			$details_array[] = $error_string." ".$rel[$i];
	if(!empty($details_array))
		return array('status' => 'error', 'details' => $details_array);
	return array('status' => 'ok');
}

/*
 * Verifica la struttura delle cartelle
 * @pdir - directory del progetto
 * @rfo - required folders
 * @rfi - required files
 */
function check_structure($pdir, $rfo, $rfi)
{
	$details_array = array();
	// check directories
	$return = check_element($pdir,$rfo,"Cartella mancante");
	if($return['status'] == 'ok')
	{
		// check files
		return check_element($pdir,$rfi,"File mancante");
	}
	else 
		return $return;
}

function install_mysql($pconfig,$cconfig,$conn,$matricola,$phtdocs,$pdump)
{
	 // sostituisco il file config.php con il mio file config.php
	file_put_contents($pconfig,$cconfig);
	// installo il database
	$query = "CREATE DATABASE IF NOT EXISTS `$matricola`;";
	$result = mysqli_query($conn, $query);
	if(!$result)
		return array('status' => 'error', 'details' => "Errore nella creazione del database $matricola ".mysqli_error($conn));
	else
	{
		// database creato!
		// importo il dump nel database
			
		// Temporary variable, used to store current query
		mysqli_select_db($conn,$matricola) or die('Error selecting MySQL database: ' . mysql_error());
	
		$templine = '';
		// Read in entire file
		$lines = file($pdump);
		// Loop through each line
		foreach ($lines as $line)
		{
			// Skip it if it's a comment
			if (substr($line, 0, 2) == '--' || $line == '')continue;

			// Add this line to the current segment
			$templine .= $line;
			// If it has a semicolon at the end, it's the end of the query
			if (substr(trim($line), -1, 1) == ';')
			{
				// Perform the query
				mysqli_query($conn,$templine);
				// Reset temp variable to empty
				$templine = '';
			}
		}
		// restituisci url progetto!
		return array('status' => 'ok', 'url' => $phtdocs.$matricola, 'project_id' => $matricola);		
	}		
}

function build_redirect($htdocs,$return, $page)
{
	$redirect_page = "Location: ".$htdocs.$page;
	if(!is_null($return))
		$redirect_page .= "?";
	foreach($return as $k => $v)
		if(is_array($v))
		{
			for($i = 0; $i < count($v); $i++)
				$redirect_page .= $k."[]=".$v[$i]."&";
			$redirect_page = substr($redirect_page, 0, count($redirect_page) -2);
		}
	else
		$redirect_page .= $k."=".$v."&";
	$redirect_page = substr($redirect_page, 0, count($redirect_page) -2);
	return $redirect_page;
}

?>