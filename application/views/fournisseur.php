<?php
/**
* Vue pour un fournisseur
* @author Tristan Laurent (aka Trilunaire)
*/

?>

<?php include('includes/header.php'); ?>

<?php include('table.php');?>


<?php echo form_open('Fournisseur'); ?>
<h3>Information du fournisseur</h3><hr/>

<?php if (isset($message)) { ?>
<CENTER><h3 style="color:green;">Insertion d'un fournisseur réussie</h3></CENTER><br>

<?php } ?>
  <!-- Partie du formulaire -->
  <?php echo form_label('Nom :'); ?> <?php echo form_error('Nom :'); ?><br />
  <input class="textInput" type="text" name="nom" /><br />

  <?php echo form_label('Téléphone :'); ?> <?php echo form_error('Téléphone :'); ?><br />
  <input class="textInput" type="text" name='phone'/><br />

<?php echo form_submit(array('id' => 'submit', 'value' => 'Envoyer')); ?>
<?php echo form_close(); ?><br/>

<?php include('includes/footer.php'); ?>
