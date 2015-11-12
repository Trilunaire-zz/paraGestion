<?php
/**
* Vue de vol
* @author Tristan Laurent (Trilunaire)
*/

?>

<?php include('includes/header.php'); ?>


<table>
  <tr>
    <?php
    if(!empty($table)){
      foreach($table[0] as $key=>$nom): ?>
      <th><?php echo $key ?></th>
      <?php endforeach;
    }else{
      echo "-- La table est vide --";
    }?>
  <tr/>
<?php
  foreach($table as $d)
  {

    echo "<tr>";
    ?>
        <?php foreach ($d as $l): ?>
          <td><?php echo "$l";?></td>
        <?php endforeach; ?>
    <?php
    echo "<tr/>";
  }

 ?>
</table>


<?php echo form_open('Vol'); ?>
<h3>Information du vol</h3><hr/>

<?php if (isset($message)) { ?>
<CENTER><h3 style="color:green;">Insertion d'un vol réussie</h3></CENTER><br>

<?php } ?>
  <!-- Partie du formulaire -->
  <?php echo form_label('Date :'); ?> <?php echo form_error('Date :'); ?><br />
  <input id="date" type="date" name="date" /><br />

  <?php echo form_label('Duree :'); ?> <?php echo form_error('Duree :'); ?><br />
  <input id="duree" type="number" name='duree'/><br />

  <?php echo form_label('Depart :'); ?> <?php echo form_error('Depart :'); ?><br />
  <input id="depart" type="text" name="depart" /><br />

  <?php echo form_label('Arrive   :'); ?> <?php echo form_error('Arrive   :'); ?><br />
  <input id="arrive" type="text" name="arrive" /><br />


<?php echo form_submit(array('id' => 'submit', 'value' => 'Envoyer')); ?>
<?php echo form_close(); ?><br/>

<?php include('includes/footer.php'); ?>
