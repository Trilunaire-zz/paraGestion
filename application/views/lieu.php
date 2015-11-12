<?php include('includes/header.php');?>
<?php include('table.php');?>

<?php echo form_open('Lieu'); ?>

<h3>Information du lieu de vol</h3><hr/>

<?php if (isset($message)) { ?>
<CENTER><h3 style="color:green;">Insertion d'un lieu de vol réussie</h3></CENTER><br>

<?php } ?>

<?php echo form_label("Nom :"); ?> <?php echo form_error("Nom"); ?><br />
<input class="textInput" type="text" name="nom" /><br /><br />

<?php echo form_label("Ville :"); ?> <?php echo form_error("Ville"); ?><br />
<input class="textInput" type="text" name="ville" /><br /><br />

<?php echo form_label("Longitude :"); ?> <?php echo form_error("Longitude"); ?><br />
<input class="textInput" type="text" name="lon" /><br /><br />

<?php echo form_label("Lattitude :"); ?> <?php echo form_error("Lattitude"); ?><br />
<input class="textInput" type="text" name="lat" /><br /><br />


<?php echo form_submit(array('id' => 'submit', 'value' => 'Envoyer')); ?>
<?php echo form_close(); ?><br/>


<?php include('includes/footer.php'); ?>
