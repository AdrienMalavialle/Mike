<!DOCTYPE html>
<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<title>Tableau posts</title>
</head>
<body>
	<h1>Tableau posts</h1>

	<div>
		<table id="posts" border="1px;"> 
		<!-- Tableau avec tous les utilisateurs -->
		</table>
	</div><br><br>

	<div>
		<table id="comments" border="1px;"> 
		<!-- Tableau de l'utilisateur courant -->
		</table>
	</div>

	<script>
		$(function(){ // Start Document.ready en JQuery
			// Request en Ajax pour récupérer les posts - Retour en Array JSON !
			var request = $.ajax({
				url: "http://jsonplaceholder.typicode.com/posts",
				method: "GET",
			});

			// En cas de SUCCESS, on stocke les retours dans la variable "mike"
			request.done(function(mike){
				var table = "<tr>";
				// Boucle (foreach) pour récupération les en-tetes du tableau en bouclant uniquement sur le 1er élément
				$.each(mike[0], function(index, value){
						table += "<th>";
						table += index; // Affiche la key (index) de notre objet
						table += "</th>";
				});
				table += "</tr>";

				// Boucles pour affichage de tous les posts
				for(var i = 0; i < mike.length; i++) {
					table += "<tr id='posts-" + mike[i].id + "'>";
					$.each(mike[i], function(index, value){
								table += "<td>";
								table += value;
								table += "</td>";
					});
					table += "</tr>";
				}
				$("#posts").html(table); // Affichage du tableau avec tous les posts

				// Evenement JQuery qui se déclenche au click d'une balise <tr> - Variable e stocke l'evenement
				$("tr").click(function(e){
					// Annulation de l'actualisation de la page
					e.preventDefault();    

					var idPost = $(this).attr('id');
					idPost = idPost.split("-");

					var request = $.ajax({
						url: "http://jsonplaceholder.typicode.com/comments",
						method: "GET",
						data: {
							postId: idPost[1]
						}
					});

					request.done(function(mike){
						
						var table = "<tr>";
						// Boucle (foreach) pour récupération les en-tetes du tableau en bouclant uniquement sur le 1er élément
						$.each(mike[0], function(index, value){
							table += "<th>";
							table += index; // Affiche la key (index) de notre objet
							table += "</th>";
						});
						table += "</tr>";

						// Boucles pour affichage de tous les comments
						for(var i = 0; i < mike.length; i++) {
							table += "<tr>";
							$.each(mike[i], function(index, value){
										table += "<td>";
										table += value;
										table += "</td>";
							});
							table += "</tr>";
						}
						$("#comments").html(table);
					});
				});
			}); // Fin de la request SUCCESS !

			request.fail(function(XPTDR, data){
			});
		}); // End Document.ready
	</script>
</body>
</html>