<?php
use Luracast\Restler\RestException;
require_once("localData.php");
class client {
  private $bd;
  static $CHAMPS = array('nom','prenom');
  
  function __construct(){
    $this->bd = new PDO(DNS, USER, MDP);
  }

  function get($id=NULL) {
    if($id != NULL){
      $req="select * from client where id_client=?";
      $prep=$this->bd->prepare($req);
      $prep->bindParam(1,$id);
      $prep->execute();
      $client = $prep->fetchObject();
      $retour=$client;    
    } else {
      $req="select * from client";
      $resultat = $this->bd->query($req);
      while($client=$resultat->fetchObject()) {
        $retour[]=$client;
      }
    }
    return $retour;
  }

  function post($request_data = NULL) {
    $client=$this->_validation($request_data);
    $req="INSERT INTO client (nom, prenom) VALUES (?,?)";
    $prep=$this->bd->prepare($req);
    $nom=$client["nom"];//
    $prenom=$client["prenom"];
    $prep->bindParam(1,$nom);
    $prep->bindParam(2,$prenom);
    $prep->execute();
    return $this->get($this->bd->lastInsertId());
  }

  function put($id, $request_data = NULL) {
    $client=$this->_validation($request_data);
    $req="update client set nom=?, prenom=? where id_client=?";
    $nom=$client["nom"];//
    $prenom=$client["prenom"];
    $prep=$this->bd->prepare($req);
    $prep->bindParam(1,$nom);
    $prep->bindParam(2,$prenom);
    $prep->bindParam(3,$id);
    $prep->execute();
    return $this->get($id);//$request_data;//$this->dp->update($id, $this->_validate($request_data));
  }

  function delete($id) {
    //nous verifions avant si l'client existe
    $retour = $this->get($id);
    if (!$retour) {
      return FALSE;
    } else {
      try {
        $req="delete from client where id_client=?;";
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
  //  $client = array();
    foreach (client::$CHAMPS as $champ) {
    //on commence par valider les données reçues
      if (!isset($data[$champ])) {
        throw new RestException(400, "$champ field missing");
      }
    }
    // on construit un $tabclient par rapport aux données reçues
    foreach (client::$CHAMPS as $champ) {
      $tabclient[$champ]=htmlentities($data[$champ]);
    }
    return $tabclient;
  }
}
?>