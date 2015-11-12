<?php include('includes/header.php'); ?>
<?php include('includes/fonctions.php');?>

<?php include('table.php');?>




<?php echo form_open('Parapente'); ?>

<h3>Information du parapente</h3><hr/>

<?php if (isset($message)) { ?>
<CENTER><h3 style="color:green;">Insertion d'un parapente réussie</h3></CENTER><br>

<?php } ?>

    <?php echo form_label("Immatriculation :"); ?> <?php echo form_error("Immatriculation"); ?><br />
    <input class="textInput" type="text" name="immatriculation" /><br /><br />

    <!-- Partie du formulaire -->
    <?php echo form_label("Aile :"); ?> <?php echo form_error("Aile"); ?><br />
    <input class="textInput" list="ailes" name="aile" />
    <datalist id="ailes">
      <?php foreach($ailes as $item):?>
        <option value="<?php echo objectToArray($item)['numero'];?>">
      <?php endforeach?>
    </datalist><br /><br />

    <?php echo form_label("Suspente :"); ?> <?php echo form_error("Suspente"); ?><br />
    <input class="textInput" list="suspentes" name="suspente" />
    <datalist id="suspentes">
      <?php foreach($suspentes as $item):?>
        <option value="<?php echo objectToArray($item)['numero'];?>">
      <?php endforeach?>
    </datalist><br /><br />

    <?php echo form_label("Sellette :"); ?> <?php echo form_error("Sellette"); ?><br />
    <input class="textInput" list="sellettes" name="sellette" />
    <datalist id="sellettes">
      <?php foreach($sellettes as $item):?>
        <option value="<?php echo objectToArray($item)['numero'];?>" >
      <?php endforeach?>
    </datalist><br /><br />



<?php echo form_submit(array('id' => 'submit', 'value' => 'Envoyer')); ?>
<?php echo form_close(); ?><br/>


<?php include('includes/footer.php'); ?>
