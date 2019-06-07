<?php
use Luracast\Restler\RestException;
require_once("localData.php");
class typeEmplacement {
private $bd;
static $CHAMPS = array('libelle','prix');
function __construct(){
  $this->bd = new PDO(DNS, USER, MDP);
}

function get($id=NULL) {
  if($id != NULL){
    $req="select * from type_Emplacement where id_type_emplacement=?";
    $prep=$this->bd->prepare($req);
    $prep->bindParam(1,$id);
    $prep->execute();
    $typeEmplacement = $prep->fetchObject();
    $retour=$typeEmplacement;    
  } else {
    $req="select * from type_emplacement";
    $resultat = $this->bd->query($req);
    while($typeEmplacement=$resultat->fetchObject()) {
      $retour[]=$typeEmplacement;
    }
  }
  return $retour;
}

function post($request_data = NULL) {
  $typeEmplacement=$this->_validation($request_data);
  $req="INSERT INTO type_emplacement (libelle, prix) VALUES (?,?)";
  $prep=$this->bd->prepare($req);
  $libelle=$typeEmplacement["libelle"];//
  $prix=$typeEmplacement["prix"];
  $prep->bindParam(1,$libelle);
  $prep->bindParam(2,$prix);
  $prep->execute();
  return $this->get($this->bd->lastInsertId());
}

function put($id, $request_data = NULL) {
	$typeEmplacement=$this->_validation($request_data);
	$req="update type_emplacement set libelle=?, prix=? where id_type_emplacement=?";
	$libelle=$typeEmplacement["libelle"];//
	$prix=$typeEmplacement["prix"];
	$prep=$this->bd->prepare($req);
	$prep->bindParam(1,$libelle);
	$prep->bindParam(2,$prix);
	$prep->bindParam(4,$id);
	$prep->execute();
  return $this->get($id);//$request_data;//$this->dp->update($id, $this->_validate($request_data));
}

function delete($id) {
	//nous verifions avant si l'typeEmplacement existe
	$retour = $this->get($id);
  if (!$retour)	{
    return FALSE;
  }	else {
    try {
      $req="delete from type_emplacement where id_type_emplacement=?;";
      $prep =$this->bd->prepare($req);
      $prep->bindParam(1,$id);
      //on exécute la requête sql
      $prep->execute();
    }
    catch (PDOException $e) {
      return FALSE;
      die();
    }
  }
  return $retour;
}

private function _validation($data) {
//  $typeEmplacement = array();
  foreach (typeEmplacement::$CHAMPS as $champ) {
  //on commence par valider les données reçues
    if (!isset($data[$champ]))
    {
    throw new RestException(400, "$champ field missing");
    }
  }
  // on construit un $tabtypeEmplacement par rapport aux données reçues
  foreach (typeEmplacement::$CHAMPS as $champ) {
    $tabtypeEmplacement[$champ]=htmlentities($data[$champ]);
  }
  return $tabtypeEmplacement;
}

?>
