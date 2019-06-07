<?php
use Luracast\Restler\RestException;
require_once("localData.php");
class Sejour {
  private $bd;
  static $CHAMPS = array('id_client','id_emplacement','date_debut','date_fin','nb_personnes');
  
  function __construct(){
    $this->bd = new PDO(DNS, USER, MDP);
  }

  function get($id=NULL) {
    if($id != NULL){
      $req="select * from sejour where id_sejour=?";
      $prep=$this->bd->prepare($req);
      $prep->bindParam(1,$id);
      $prep->execute();
      $typeEmplacement = $prep->fetchObject();
      $retour=$typeEmplacement;    
    } else {
      $req="select * from sejour";
      $resultat = $this->bd->query($req);
      while($typeEmplacement=$resultat->fetchObject()) {
        $retour[]=$typeEmplacement;
      }
    }
    return $retour;
  }

  function post($request_data = NULL) {
    $typeEmplacement=$this->_validation($request_data);
    $req="INSERT INTO sejour (id_client, id_emplacement, date_debut, date_fin, nb_personnes) VALUES (?,?,?,?,?,?)";
    $prep=$this->bd->prepare($req);
    $idClient=$typeEmplacement["id_client"];
    $idEmplacement=$typeEmplacement["id_emplacement"];
    $dateDebut=$typeEmplacement["date_debut"];
    $dateFin=$typeEmplacement["date_fin"];
    $nbPersonnes=$typeEmplacement["nb_personnes"];
    $prep->bindParam(1,$idClient);
    $prep->bindParam(2,$idEmplacement);
    $prep->bindParam(3,$dateDebut);
    $prep->bindParam(4,$dateFin);
    $prep->bindParam(5,$nbPersonnes);
    $prep->execute();
    return $this->get($this->bd->lastInsertId());
  }

  function put($id, $request_data = NULL) {
    $typeEmplacement=$this->_validation($request_data);
    $req="update emplacement set id_client=?, id_emplacement=?, date_debut=?, date_fin=?, nb_personnes=? where id_sejour=?";
    $prep=$this->bd->prepare($req);
    $idClient=$typeEmplacement["id_client"];
    $idEmplacement=$typeEmplacement["id_emplacement"];
    $dateDebut=$typeEmplacement["date_debut"];
    $dateFin=$typeEmplacement["date_fin"];
    $nbPersonnes=$typeEmplacement["nb_personnes"];
    $prep->bindParam(1,$idClient);
    $prep->bindParam(2,$idEmplacement);
    $prep->bindParam(3,$dateDebut);
    $prep->bindParam(4,$dateFin);
    $prep->bindParam(5,$nbPersonnes);
    $prep->execute();
    return $this->get($id);
  }

  function delete($id) {
    //nous verifions avant si l'typeEmplacement existe
    $retour = $this->get($id);
    if (!$retour)	{
      return FALSE;
    }	else {
      try {
        $req="delete from sejour where id_sejour=?;";
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
      if (!isset($data[$champ])) {
        throw new RestException(400, "$champ field missing");
      }
    }
    // on construit un $tabtypeEmplacement par rapport aux données reçues
    foreach (typeEmplacement::$CHAMPS as $champ) {
      $tabtypeEmplacement[$champ]=htmlentities($data[$champ]);
    }
    return $tabtypeEmplacement;
  }
}
?>