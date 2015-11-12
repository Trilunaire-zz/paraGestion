<table>
  <tr>
    <?php

    if(!empty($table)){
      foreach($table[0] as $key=>$nom): ?>
      <th><?php echo "<a href=\"http://".$_SERVER['SERVER_NAME']."/".explode('/',$_SERVER["REQUEST_URI"])[1]."/tri/$key\">$key</a>";?></th>
      <?php endforeach;

      //on regarde l'url pour trouver la bonne table:
      $nomTable =explode('/',$_SERVER["REQUEST_URI"])[1];
      ?>
      <th></th>
      <?php
    }else{
      echo "-- La table est vide --";
    }?>
  </tr>
<?php

  $yellow = true;
  foreach($table as $d)
  {

    if($yellow){
      echo "<tr class=\"yellowRow\">";
    }
    else {
      echo "<tr class=\"orangeRow\">";
    }
    ?>
        <?php foreach ($d as $l): ?>
          <td><?php echo "$l";?></td>
        <?php endforeach; ?>
    <?php
    //lien de suppression
    switch($nomTable):
      case 'Accueil' : echo "<td><a href=\"http://".$_SERVER['SERVER_NAME']."/Accueil/delete/".$d->nom."_".$d->prenom."_".$d->naissance."\">[Supprimer le client]</a></td>";
        break;
      case 'Lieu' : echo "<td><a href=\"http://".$_SERVER['SERVER_NAME']."/Lieu/delete/".$d->id."\">[Supprimer le lieu]</a></td>";
        break;
      case 'Location' : echo "<td><a href=\"http://".$_SERVER['SERVER_NAME']."/Location/delete/".$d->numero."\">[Supprimer la location]</a></td>";
        break;
      case 'Parapente' : echo "<td><a href=\"http://".$_SERVER['SERVER_NAME']."/Parapente/delete/".$d->immatriculation."\">[Supprimer le parapente]</a></td>";
        break;
      case 'Materiel' : echo "<td><a href=\"http://".$_SERVER['SERVER_NAME']."/Materiel/delete/".$d->numero."\">[Supprimer le Materiel]</a></td>";
        break;
      case 'Fournisseur' : echo "<td><a href=\"http://".$_SERVER['SERVER_NAME']."/Fournisseur/delete/".$d->nom."\">[Supprimer le fournisseur]</a></td>";
        break;
      case 'Controle' : echo "<td><a href=\"http://".$_SERVER['SERVER_NAME']."/Controle/delete/".$d->numero."\">[Supprimer le controle]</a></td>";
        break;
    endswitch;
    echo "</tr>";
    if($yellow){
      $yellow = false;
    }
    else{
      $yellow = true;
    }
  }

 ?>
</table>
