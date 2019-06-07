<?php
//envoie de la requète
$ch = curl_init();
// configuration de l'URL GET
$httpheader[] = "Content-Type:application/json";
$ressource='{"prenom":"David","nom":"Tennant"}';
$ch = curl_init();//initialisation de la requête
curl_setopt($ch, CURLOPT_URL,"http://localhost/service-api/cerisaie/index.php/client/1"); // configuration de l'URL
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
curl_setopt($ch, CURLOPT_POSTFIELDS, $ressource);
curl_setopt($ch, CURLOPT_HTTPHEADER, $httpheader);//indication que la ressource est en json
$reponse= curl_exec($ch); //récupération  de la réponse
curl_close($ch);//fermeture du tampon

?>
