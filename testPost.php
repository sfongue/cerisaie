<?php
//envoie de la requète
//require_once("cle.php");
$ch = curl_init();
//$apikey=$cle;
//$httpheader = ['DOLAPIKEY: '.$apikey];
$httpheader[] = "Content-Type:application/json";

/*		CLIENT
$ressource='{"prenom":"totio","nom":"totoiNom"}';
curl_setopt($ch, CURLOPT_URL, "http://localhost/service-api/cerisaie/index.php/client");
*/

/*		ACTIVITE (param de ressource à vérifier)
$ressource='{"libelle":"testActivite","unite":"1/2 journee","tarif":5.4}';
curl_setopt($ch, CURLOPT_URL, "http://localhost/service-api/cerisaie/index.php/activite");
*/

/*		RESERVATION (param de ressource à faire)
$ressource='{"prenom":"totio","nom":"totoiNom"}';
curl_setopt($ch, CURLOPT_URL, "http://localhost/service-api/cerisaie/index.php/reservation");
*/

/*		SEJOUR (param de ressource à faire)
$ressource='{"prenom":"totio","nom":"totoiNom"}';
curl_setopt($ch, CURLOPT_URL, "http://localhost/service-api/cerisaie/index.php/sejour");
*/

/*		EMPLACEMENT (param de ressource à faire)
$ressource='{"prenom":"totio","nom":"totoiNom"}';
curl_setopt($ch, CURLOPT_URL, "http://localhost/service-api/cerisaie/index.php/emplacement");
*/

/*		TYPE_EMPLACEMENT
$ressource='{"libelle":"super emplacement","prix":888.0}';
curl_setopt($ch, CURLOPT_URL, "http://localhost/service-api/cerisaie/index.php/typeEmplacement");
*/

curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $ressource);
curl_setopt($ch, CURLOPT_HTTPHEADER, $httpheader);//indication que la ressource est en json
$reponse= curl_exec($ch); //récupération  de la réponse
curl_close($ch);//fermeture du tampon

?>
