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
		            <li class="active">Inserisci dati</li>
		        </ul>
	 		</div>
			<div class="container-fluid text-center">  
    					<div class="col-sm-8 text-left">
						<form action="api/data.php" method="post" class="register_form" id="register_form" enctype="multipart/form-data">
							<ul id="register-ul">
								<li>
									<label for="titolo">Titolo:</label>
									<input type="text" name="titolo" id="titolo" placeholder="Il mio progetto" required>
								</li>
								<li>
									<label for="titolo">Sorgente dati:</label>
									<input type="text" name="source" id="source" placeholder="Istat" required>
								</li>
								<li>
									<label for="tag">Categoria:</label>
									<input type="text" name="tag" id="tag" placeholder="Ambiente" required>
								</li>
								<div id="div_candidato_1">
									<li>
										<p class="candidato">Candidato</p>
										<label for="name">Nome:</label>
										<input type="text" name="name[]" id="name" placeholder="Mario" required>
									</li>
									<li>
										<label for="surname">Cognome:</label>
										<input type="text" name="surname[]" id="surname" placeholder="Rossi" required>
									</li>
									<li id="matricola1">
										<label for="matricola">Matricola:</label>
										<input type="text" name="matricola[]" id="matricola" placeholder="2453455" required
										title="Matricola" pattern="^\d{6}$">
										<button type="button" class="btn-add"><img class="img-btn-add" title="aggiungi candidato" src="images/btn-add.png" onclick="add_candidate();"></button>
									</li>
								</div>
								<?php 
									if(isset($_GET['project_id']))
										echo '<input type="hidden" name="project_id" value="'.$_GET['project_id'].'">';	
								
								?>
								<li>
									<button type="submit" class="btn-basic btn-green">Conferma Iscrizione</button>
									<?php 
										if(isset($_GET['project_id']))
											echo '<a href="api/delete.php?project_id='.$_GET['project_id'].'" class="btn-red btn-basic">Annulla</a>';	
									?>
									</li>
							</ul>
						</form>
					</div>
				</div>
			
		</body>
	</html>