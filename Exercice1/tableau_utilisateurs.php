<!DOCTYPE html>
<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<title>Tableau utilisateurs</title>
</head>
<body>
	<div>
		<table id="table" border="1px;">	
		</table>
	</div>
	<script>
		$(function(){
			var request = $.ajax({
				url: "http://jsonplaceholder.typicode.com/users",
				method: "GET",
			});

			request.done(function(mike){
				var table = "<tr>";
				$.each(mike[0], function(index, value){
					if(index == "name" || index == "username" || index == "email" || index == "phone" || index == "company") {
						table += "<th>";
						table += index;
						table += "</th>";
					}
				});
				table += "</tr>";

				for(var i = 0; i < mike.length; i++) {
					table += "<tr>";
					$.each(mike[i], function(index, value){
						if(index == "name" || index == "username" || index == "email" || index == "phone" || index == "company") {
						table += "<td>";
						if(index == "company") {
							table += value.name;
						}
						else {
							table += value;
						}
						table +="</td>";
					}
					});
					table += "</tr>";
				}
			$("#table").html(table);
			});

			request.fail(function(XPTDR, data){
			});
		});
	</script>
</body>
</html>