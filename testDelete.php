<?php

$ch = curl_init();//initialisation de la requête

/*		CLIENT
curl_setopt($ch, CURLOPT_URL,"http://localhost/service-api/cerisaie/index.php/client/8"); // configuration de l'URL
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
*/

/*		ACTIVITE
curl_setopt($ch, CURLOPT_URL,"http://localhost/service-api/cerisaie/index.php/client/8"); // configuration de l'URL
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
*/

/*		RESERVATION
curl_setopt($ch, CURLOPT_URL,"http://localhost/service-api/cerisaie/index.php/client/8"); // configuration de l'URL
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
*/

/*		SEJOUR
curl_setopt($ch, CURLOPT_URL,"http://localhost/service-api/cerisaie/index.php/client/8"); // configuration de l'URL
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
*/

/*		EMPLACEMENT
curl_setopt($ch, CURLOPT_URL,"http://localhost/service-api/cerisaie/index.php/client/8"); // configuration de l'URL
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
*/

/*		TYPE_EMPLACEMENT
curl_setopt($ch, CURLOPT_URL,"http://localhost/service-api/cerisaie/index.php/typeEmplacement/8"); // configuration de l'URL
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
*/


$reponse= curl_exec($ch); //récupération  de la réponse
curl_close($ch);//fermeture du tampon

?>