<?php
use Luracast\Restler\RestException;
require_once("localData.php");
class Emplacement {
  private $bd;
  static $CHAMPS = array('id_type_emplacement','surface','capacite');
  
  function __construct(){
    $this->bd = new PDO(DNS, USER, MDP);
  }

  function get($id=NULL) {
    if($id != NULL){
      $req="select * from emplacement where id_emplacement=?";
      $prep=$this->bd->prepare($req);
      $prep->bindParam(1,$id);
      $prep->execute();
      $typeEmplacement = $prep->fetchObject();
      $retour=$typeEmplacement;    
    } else {
      $req="select * from emplacement";
      $resultat = $this->bd->query($req);
      while($typeEmplacement=$resultat->fetchObject()) {
        $retour[]=$typeEmplacement;
      }
    }
    return $retour;
  }

  function post($request_data = NULL) {
    $typeEmplacement=$this->_validation($request_data);
    $req="INSERT INTO emplacement (id_type_emplacement, surface, capacite) VALUES (?,?,?)";
    $prep=$this->bd->prepare($req);
    $idTypeEmp=$typeEmplacement["id_type_emplacement"];
    $surface=$typeEmplacement["surface"];
    $capacite=$typeEmplacement["capacite"];
    $prep->bindParam(1,$idTypeEmp);
    $prep->bindParam(2,$surface);
    $prep->bindParam(3,$capacite);
    $prep->execute();
    return $this->get($this->bd->lastInsertId());
  }

  function put($id, $request_data = NULL) {
    $typeEmplacement=$this->_validation($request_data);
    $req="update emplacement set id_type_emplacement=?, surface=?, capacite=? where id_emplacement=?";
    $idTypeEmp=$typeEmplacement["id_type_emplacement"];//
    $surface=$typeEmplacement["surface"];//
    $capacite=$typeEmplacement["capacite"];
    $prep=$this->bd->prepare($req);
    $prep->bindParam(1,$idTypeEmp);
    $prep->bindParam(2,$surface);
    $prep->bindParam(3,$capacite);
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
        $req="delete from emplacement where id_emplacement=?;";
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