<?php
echo "<table border=1>";
echo "<tr><th>ID</th><th>Libell&eacute; </th><th>Quantit&eacute;</th><th></th></tr>";
try {
    require_once("localData.php");
    $db = new PDO(DNS, USER, MDP);
    $req="select * from client";
    $resultat = $db->query($req);
    while ($matiere=$resultat->fetchObject()){
        echo '<tr><td>'.$matiere->id_client.'</td>';
        echo '<td>'.$matiere->nom.'</td>';
        echo '<td>'.$matiere->prenom.'</td>';
        echo "<td><form name='a".$matiere->id_client."' action='client.php' method='post'>";
        echo "<input type='hidden' name='id' value='".$matiere->id_client."'/>"; 
        echo "<input type='submit' value='modifier'/>"; 
        echo "<input type='submit' value='supprimer' formaction='supr.php' method='post' onclick='return ".'confirm("Voulez-vous supprimer cet element?")'."'/></form>"; 
        echo '</td></tr>';
    }
    echo "</table>";
    echo '<form name="inserer" action="client.php" method="post">';
    echo '<input type="submit" value="ajouter" />';
    echo '</form>';
}
catch (PDOException $e) {
    print "Erreur avec la BD!: " .$e->getMessage() ."<br/>";
    die();
}
