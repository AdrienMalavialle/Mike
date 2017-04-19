<?php  

header("Access-Control-Allow-Origin: *");

$pdo = new PDO('mysql:host=localhost;dbname=mike', 'root', '', array(
	PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
	PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
	));
$resultat = $pdo -> prepare("SELECT * FROM utilisateurs");
$resultat -> execute();

$utilisateurs =  $resultat -> fetchAll(PDO::FETCH_ASSOC);

$tableau = "<table><tr>";
foreach($utilisateurs[0]  as $key => $value) {
	$tableau .= '<th>' . $key . '</th>';
}
$tableau .= "</tr>";

foreach ($utilisateurs as $key => $value) {
	$tableau .= "<tr>";
	foreach ($utilisateurs[$key] as $key => $value) {
		$tableau .= "<td>" . $value . "</td>";
	}
	$tableau .= "</tr>";
}
$tableau .= "</table>";

echo $tableau;

?>