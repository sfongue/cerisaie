<?php

$ch = curl_init();//initialisation de la requête
curl_setopt($ch, CURLOPT_URL,"http://localhost/service-api/cerisaie/index.php/client/8"); // configuration de l'URL
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
$reponse= curl_exec($ch); //récupération  de la réponse
curl_close($ch);//fermeture du tampon

?>
