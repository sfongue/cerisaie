<?php
use Luracast\Restler\RestException;
require_once("localData.php");
class reservation {
  private $bd;
  static $CHAMPS = array('id_activite','id_sejour','nb_unite','date_activite');
  
  function __construct(){
    $this->bd = new PDO(DNS, USER, MDP);
  }

  function get($id=NULL) {
    if($id != NULL){
      $req="select * from reservation where id_reservation=?";
      $prep=$this->bd->prepare($req);
      $prep->bindParam(1,$id);
      $prep->execute();
      $reservation = $prep->fetchObject();
      $retour=$reservation;    
    } else {
      $req="select * from reservation";
      $resultat = $this->bd->query($req);
      while($reservation=$resultat->fetchObject()) {
        $retour[]=$reservation;
      }
    }
    return $retour;
  }

  function post($request_data = NULL) {
    $reservation=$this->_validation($request_data);
    $req="INSERT INTO reservation (id_activite, id_sejour, nb_unite, date_activite) VALUES (?,?)";
    $prep=$this->bd->prepare($req);
    $id_activite=$reservation["id_activite"];//
    $id_sejour=$reservation["id_sejour"];
    $id_sejour=$reservation["nb_unite"];
    $id_sejour=$reservation["date_activite"];
    $prep->bindParam(1,$id_activite);
    $prep->bindParam(2,$id_sejour);
    $prep->bindParam(3,$nb_unite);
    $prep->bindParam(4,$date_activite);
    $prep->execute();
    return $this->get($this->bd->lastInsertId());
  }

  function put($id, $request_data = NULL) {
    $reservation=$this->_validation($request_data);
    $req="update reservation set id_activite=?, id_sejour=? where id_reservation=?";
    $id_activite=$reservation["id_activite"];//
    $id_sejour=$reservation["id_sejour"];
    $id_sejour=$reservation["nb_unite"];
    $id_sejour=$reservation["date_activite"];
    $prep=$this->bd->prepare($req);
    $prep->bindParam(1,$id_activite);
    $prep->bindParam(2,$id_sejour);
    $prep->bindParam(3,$nb_unite);
    $prep->bindParam(4,$date_activite);
    $prep->bindParam(5,$id);
    $prep->execute();
    return $this->get($id);//$request_data;//$this->dp->update($id, $this->_validate($request_data));
  }

  function delete($id) {
    //nous verifions avant si l'reservation existe
    $retour = $this->get($id);
    if (!$retour) {
      return FALSE;
    } else {
      try {
        $req="delete from reservation where id_reservation=?;";
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
  //  $reservation = array();
    foreach (reservation::$CHAMPS as $champ) {
    //on commence par valider les données reçues
      if (!isset($data[$champ])) {
        throw new RestException(400, "$champ field missing");
      }
    }
    // on construit un $tabreservation par rapport aux données reçues
    foreach (reservation::$CHAMPS as $champ) {
      $tabreservation[$champ]=htmlentities($data[$champ]);
    }
    return $tabreservation;
  }
}
?>