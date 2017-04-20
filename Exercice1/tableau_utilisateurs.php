<!DOCTYPE html>
<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<title>Tableau utilisateurs</title>
</head>
<body>
	<h1>Tableau utilisateurs</h1>

	<div>
		<table id="table" border="1px;"> 
		<!-- Tableau avec tous les utilisateurs -->
		</table>
	</div><br><br>

	<div>
		<table id="user" border="1px;"> 
		<!-- Tableau de l'utilisateur courant -->
		</table>
	</div>

	<script>
		$(function(){ // Start Document.ready en JQuery
			// Request en Ajax pour récupérer les utlisateurs - Retour en Array JSON !
			var request = $.ajax({
				url: "http://jsonplaceholder.typicode.com/users",
				method: "GET",
			});

			// En cas de SUCCESS, on stocke les retours dans la variable "mike"
			request.done(function(mike){
				var table = "<tr>";
				// Boucle (foreach) pour récupération les en-tetes du tableau en bouclant uniquement sur le 1er élément
				$.each(mike[0], function(index, value){
					if(index == "name" || index == "username" || index == "email" || index == "phone" || index == "company") {
						table += "<th>";
						table += index; // Affiche la key (index) de notre objet
						table += "</th>";
					}
				});
				table += "</tr>";

				// Boucles pour affichage de tous les utilisateurs
				for(var i = 0; i < mike.length; i++) {
					table += "<tr>";
					$.each(mike[i], function(index, value){
						// Ici on ne souhaite récupérer que certaines valeurs (cf. énoncé exercice)
						if(index == "name" || index == "username" || index == "email" || index == "phone" || index == "company") {
						
							// Si l'index est le nom, on rajoute une balise <a> afin d'avoir un lien cliquable (cf. boucles suivantes)
							if(index == "name") {
								table += "<td><a href='#'>";
								table += value;
								table += "</a></td>";
								
							} else {
								table += "<td>";

									// Traitement spécifique pour "company" car il s'agit d'un objet
									if(index == "company") {
									table += value.name;
									} else {
										table += value;
									}
							table +="</td>";
						}
					}
					});
					table += "</tr>";
				}
				$("#table").html(table); // Affichage du tableau avec tous les utilisateurs

				// Evenement JQuery qui se déclenche au click d'une balise <a> - Variable e stocke l'evenement
				$("a").click(function(e){
					// Annulation de l'actualisation de la page
					e.preventDefault();

					var nameUser = $(this).text();

					var request = $.ajax({
						url: "http://jsonplaceholder.typicode.com/users",
						method: "GET",
					})
					request.done(function(mike){
						newTable = ""
						for(var i = 0; i < mike.length; i++) {
							if(mike[i].name == nameUser) {
								newTable += "<tr>";
								$.each(mike[i], function(index, value){
									newTable += "<td>";
										if(index == "company") {
										table += value.name;
										}
										else if(index == "address") {
											newTable += value.street + " " + value.suite + " " + value.city + " " + value.zipcode;
										}
										else {
											newTable += value;
										}
										newTable += "</td>";
								});
								newTable += "</tr>";
							}
						}
						$("#user").html(newTable);
					});
				});

			}); // Fin de la request SUCCESS !

			request.fail(function(XPTDR, data){
			});
		}); // End Document.ready
	</script>
</body>
</html>