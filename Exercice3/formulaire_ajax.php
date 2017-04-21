<!DOCTYPE html>
<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<title>Formulaire Ajax</title>
</head>
<body>
	<h1>Formulaire Ajax</h1>

	<form action="" method="post">
		<fieldset>
			<label>Marque</label><br/>
			<input type="text" name="marque"><br/><br/>

			<label>Modele</label><br/>
			<input type="text" name="modele"><br/><br/>

			<label>Année</label><br/>
			<input type="number" name="annee"><br/><br/>
			
			<label>Couleur</label><br/>
			<input type="color" name="couleur"><br/><br/>
			
			<input type="submit" id="submit" value="Envoyer">
		</fieldset>
	</form>

	<div id="reponse">
	</div>

	<script>
		// Document ready en JQuery 
		$(function(){ 
		
			// $("input[type=submit]")
			$("#submit").click(function(e){ 
				// Obligatoire dès lors que l'on fait de l'Ajax !
				e.preventDefault();

				// Requête Ajax - Envoi des informations du formulaire vers une autre page de traitement
				$.post("traitement_formulaire.php", $("form").serialize())
					.done(function(data){
						$("#reponse").html(data);
					})
			});
		})
	</script>
</body>
</html>