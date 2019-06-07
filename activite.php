<?php
use Luracast\Restler\RestException;
require_once("localData.php");
class Activite {
  private $bd;
  static $CHAMPS = array('libelle','tarif', 'unite');
  function __construct(){
    $this->bd = new PDO(DNS, USER, MDP);
  }

  function get($id=NULL) {
    if($id != NULL){
      $req="select * from activite where id_activite=?";
      $prep=$this->bd->prepare($req);
      $prep->bindParam(1,$id);
      $prep->execute();
      $activite = $prep->fetchObject();
      $retour=$activite;    
    } else {
      $req="select * from activite";
      $resultat = $this->bd->query($req);
      while($activite=$resultat->fetchObject()) {
        $retour[]=$activite;
      }
    }
    return $retour;
  }

  function post($request_data = NULL) {
    $activite=$this->_validation($request_data);
    $req="INSERT INTO activite (libelle, tarif, unite) VALUES (?,?,?)";
    $prep=$this->bd->prepare($req);
    $libelle=$activite["libelle"];//
    $tarif=$activite["tarif"];
    $unite=$activite["unite"];
    $prep->bindParam(1,$libelle);
    $prep->bindParam(2,$prix);
    $prep->bindParam(3,$unite);
    $prep->execute();
    return $this->get($this->bd->lastInsertId());
  }

  function put($id, $request_data = NULL) {
    $activite=$this->_validation($request_data);
    $req="update activite set libelle=?, tarif=?, unite=? where id_activite=?";
    $libelle=$activite["libelle"];//
    $tarif=$activite["tarif"];
    $unite=$activite["unite"];
    $prep=$this->bd->prepare($req);
    $prep->bindParam(1,$libelle);
    $prep->bindParam(2,$tarif);
    $prep->bindParam(3,$unite);
    $prep->execute();
    return $this->get($id);
  }

  function delete($id) {
    //nous verifions avant si l'activite existe
    $retour = $this->get($id);
    if (!$retour)	{
      return FALSE;
    }	else {
      try {
        $req="delete from type_emplacement where id_activite=?;";
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
    foreach (activite::$CHAMPS as $champ) {
    //on commence par valider les données reçues
      if (!isset($data[$champ]))
      {
      throw new RestException(400, "$champ field missing");
      }
    }
    // on construit un $tabactivite par rapport aux données reçues
    foreach (activite::$CHAMPS as $champ) {
      $tabactivite[$champ]=htmlentities($data[$champ]);
    }
    return $tabactivite;
  }
}
?>
