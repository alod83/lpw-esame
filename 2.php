<!DOCTYPE html>
	<html lang="it">
		<head>
			<meta charset="utf-8">
			<title>Iscrizione all'esame</title>
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
			<link href="css/style.css" rel="stylesheet"/>
			<link href="css/bar.css" rel="stylesheet"/>
			<link href="css/button.css" rel="stylesheet"/>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
			<script src="js/main.js"></script>
			
		</head>
		<body>
			<nav class="navbar navbar-inverse">
			  <div class="container-fluid">
			    <div class="navbar-header">
			      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>                        
			      </button>
			      <a class="navbar-brand" href="http://didawiki.cli.di.unipi.it/doku.php/bdd-infuma/parte_laboratorio_progettazione_web">LPW</a>
			    </div>
			    <div class="collapse navbar-collapse" id="myNavbar">
			      <ul class="nav navbar-nav">
			        <li class="active"><a href="main.html">Home</a></li>
					<li><a href="map.html">Mappa</a></li>
			        <li><a href="about.html">Contatti</a></li>
			      </ul>
			    </div>
			  </div>
			</nav>

			<div class="barcontainer">
		        <ul class="progressbar">
		            <li class="active">Carica</li>
		            <li class="active">Verifica</li>
		            <li>Inserisci dati</li>
		        </ul>
	 		</div>
			<div class="container-fluid text-center">  
    					<div class="col-sm-8 text-left">	
    						<h2>Verifica progetto</h2>	
    						<p>		
		    					<?php
		    						if(isset($_GET['status']))
									if($_GET['status'] == 'ok')
										echo "Progetto caricato correttamente.";
									else
										echo "Errore nella procedura di caricamento nel progetto";
								else
									echo "Impossibile caricare il progetto"; 
							?>
						</p>
						<p>
							<?php
								if(	isset($_GET['status']) 		&& 
									$_GET['status'] == 'error' 	&&
								   	isset($_GET['details']))
								{
									$details = $_GET['details'];
									if(is_array($details))
										for($i = 0; $i < count($details); $i++)
											echo $details[$i]."<br>";
									else
									{
										echo $details;
									}
									echo '<a href="1.html" class="btn-red btn-basic">Torna indietro</a>';
									
								}
								else if(isset($_GET['status']) 	&& 
										$_GET['status'] == 'ok' &&
										isset($_GET['url']))
								{
									$url = $_GET['url'];
									echo "Di seguito si riporta il link a cui e' stato installato il progetto. Una volta cliccato sul link, verra' aperto un nuovo tab nel proprio browser.
									Verificare che il progetto sia installato correttamente. Successivamente ritornare in questa pagina e proseguire il caricamento o l'annullamento dell'iscrizione.
									Il progetto e' stato installato correttamente al seguente indirizzo: ";
									echo "<a href='$url' target='_blank'>$url</a><br>";
									echo '<a href="3.php?project_id='.$_GET['project_id'].'" class="btn-green btn-basic">Completa</a>
									<a href="api/delete.php?project_id='.$_GET['project_id'].'" class="btn-red btn-basic">Annulla</a>';
								}
							?>
						</p>
						</div>
				</div>
		</body>
	</html>