<?php
/**
* Vue de contrôle technique
* @author Tristan Laurent (Trilunaire)
*/

?>

<?php include('includes/header.php'); ?>

<?php include('table.php');?>


<?php echo form_open('Controle'); ?>
<h3>Information du contrôle technique</h3><hr/>

<?php if (isset($message)) { ?>
<CENTER><h3 style="color:green;">Insertion d'un contrôle technique réussie</h3></CENTER><br>

<?php } ?>
  <!-- Partie du formulaire -->
  <?php echo form_label('Type :'); ?> <?php echo form_error('Type :'); ?><br />
  <input id="type" type="radio" name="type" value="annuel">Annuel<br />
  <input id="type" type="radio" name="type" value="normal" checked>Fin de sortie<br />

  <?php echo form_label('Resultat :'); ?> <?php echo form_error('Resultat :'); ?><br />
  <input id="resultat" type="checkbox" name='resultat' value="false"> Positif<br />

  <?php echo form_label('Date :'); ?> <?php echo form_error('Date :'); ?><br />
  <input class="textInput" type="date" name="date"><br/>

  <?php echo form_label('Numero :'); ?> <?php echo form_error('Numero :'); ?><br />
  <input class="textInput" type="text" name="numero"><br />

  <?php echo form_label('Description :'); ?> <?php echo form_error('Description :'); ?><br />
  <input class="textInput" type="text" name="description"><br />


<?php echo form_submit(array('id' => 'submit', 'value' => 'Envoyer')); ?>
<?php echo form_close(); ?><br/>

<script type="text/javascript">
  function cache()
  {
    if(document.forms[1].role.checked==true)
    {
      document.getElementById('resultat').value = "true";
    }else{
      document.getElementById('licence').value = "false";
    }

  }
</script>

<?php include('includes/footer.php'); ?>
