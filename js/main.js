function remove_candidate(count)
{
	$( "#div_candidato_" + count ).remove();
	var prev = count-1;
	if($( "#matricola" + prev ).find('.btn-add').length == 0)
		$( "#matricola" + prev ).append('<button type="button" class="btn-add"><img class="img-btn-add" title="aggiungi candidato" src="images/btn-add.png" onclick="add_candidate();"></button>');
								
}

function add_candidate()
{
	var num_candidati = $('.candidato').length;
	$( ".btn-add" ).remove();
	if(num_candidati < 3)
	{
		count = num_candidati+1;
		var candidate_code = '<div id="div_candidato_' + count + '"><p class="candidato" id="candidato">Candidato ' + count + '</p><br>\
						<li><label for="name">Nome:</label><input type="text" name="name[]" id="name" placeholder="Mario" required> \
							</li>\
							<li>\
								<label for="surname">Cognome:</label>\
								<input type="text" name="surname[]" id="surname" placeholder="Rossi" required>\
							</li>\
							<li id="matricola' + count +'">\
								<label for="matricola">Matricola:</label>\
								<input type="text" name="matricola[]" id="matricola" placeholder="2453455" required\
								title="Matricola" pattern="^\\d{6}$">\
								<button type="button" class="btn-add"><img class="img-btn-add" title="aggiungi candidato" src="images/btn-add.png" onclick="add_candidate();"></button>\
								<button type="button" class="btn-rm"><img class="img-btn-rm" title="rimuovi candidato" src="images/btn-rm.png" onclick="remove_candidate(' + count +');"></button>\
							</li>';
		$("#div_candidato_"+num_candidati).after(candidate_code);
	}else
		alert("Raggiunto il numero massimo di candidati per progetto");
	
}