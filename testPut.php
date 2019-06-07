<?php
//envoie de la requète
$ch = curl_init();
// configuration de l'URL GET
$httpheader[] = "Content-Type:application/json";
$ch = curl_init();//initialisation de la requête

/*		CLIENT
$ressource='{"prenom":"David","nom":"Tennant"}';
curl_setopt($ch, CURLOPT_URL,"http://localhost/service-api/cerisaie/index.php/client/1"); // configuration de l'URL
*/

/*		ACTIVITE (param de ressource à faire)
$ressource='{"prenom":"David","nom":"Tennant"}';
curl_setopt($ch, CURLOPT_URL,"http://localhost/service-api/cerisaie/index.php/activite/1"); // configuration de l'URL
*/

/*		RESERVATION (param de ressource à faire)
$ressource='{"prenom":"David","nom":"Tennant"}';
curl_setopt($ch, CURLOPT_URL,"http://localhost/service-api/cerisaie/index.php/reservation/1"); // configuration de l'URL
*/

/*		SEJOUR (param de ressource à faire)
$ressource='{"prenom":"David","nom":"Tennant"}';
curl_setopt($ch, CURLOPT_URL,"http://localhost/service-api/cerisaie/index.php/sejour/1"); // configuration de l'URL
*/

/*		EMPLACEMENT (param de ressource à faire)
$ressource='{"prenom":"David","nom":"Tennant"}';
curl_setopt($ch, CURLOPT_URL,"http://localhost/service-api/cerisaie/index.php/emplacement/1"); // configuration de l'URL
*/

/*		TYPE_EMPLACEMENT
$ressource='{"libelle":"caravane xxl","prix":29.99}';
curl_setopt($ch, CURLOPT_URL,"http://localhost/service-api/cerisaie/index.php/typeEmplacement/1"); // configuration de l'URL
*/

curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
curl_setopt($ch, CURLOPT_POSTFIELDS, $ressource);
curl_setopt($ch, CURLOPT_HTTPHEADER, $httpheader);//indication que la ressource est en json
$reponse= curl_exec($ch); //récupération  de la réponse
curl_close($ch);//fermeture du tampon

?>