<?php include('includes/header.php');?>
<?php include('includes/fonctions.php');?>
<?php include('table.php');?>

<?php echo form_open('Location'); ?>

<h3>Information de la location</h3><hr/>


<?php if (isset($message)) { ?>
<CENTER><h3 style="color:green;">Location réussie</h3></CENTER><br>
<?php } ?>

<fieldset>
  <legend>Information client</legend>

  <?php echo form_label("Pilote :"); ?> <?php echo form_error("Pilote"); ?><br />
  <input class="textInput" list="pilotes" name="pilote" />
  <datalist id="pilotes">
    <?php foreach($pilotes as $p):$str = objectToArray($p)?>
      <?php echo '<option value="'.$str['nom'].'-'.$str['prenom'].'-'.$str['naissance'].'" >';?>
    <?php endforeach?>
  </datalist><br /><br />

  <?php echo form_label("Présence d'un invité :"); ?> <?php echo form_error("Présence d'un invité"); ?>
  <input class="textInput" type="checkbox" name="invitation" value="true" onchange="cache()"/><br /><br />

  <?php echo form_label("Invité :"); ?> <?php echo form_error("Invité"); ?><br />
  <input class="textInput" id="invite" list="invites" name="invite" />
  <datalist id="invites">
    <?php foreach($invites as $p):$str = objectToArray($p)?>
      <?php echo '<option value="'.$str['nom'].'-'.$str['prenom'].'-'.$str['naissance'].'" >';?>
    <?php endforeach?>
  </datalist><br /><br />
</fieldset>

<fieldset>
  <legend>Information du vol</legend>
  <?php echo form_label("Lieu de départ :"); ?> <?php echo form_error("Lieu de départ"); ?><br />
  <input class="textInput" list="lieux" name="depart" />
  <datalist id="lieux">
    <?php foreach($lieux as $p):$str = objectToArray($p)?>
      <?php echo '<option value="'.$str['nom'].'" >';?>
    <?php endforeach?>
  </datalist><br /><br />

  <?php echo form_label("Lieu d'arrivée :"); ?> <?php echo form_error("Lieu de'arrivée"); ?><br />
  <input class="textInput" list="lieux" name="arrive" />
  <datalist id="lieux">
    <?php foreach($lieux as $p):$str = objectToArray($p)?>
      <?php echo '<option value="'.$str['nom'].'" >';?>
    <?php endforeach?>
  </datalist><br /><br />

  <?php echo form_label("Date :"); ?> <?php echo form_error("Date"); ?><br />
  <input class="textInput" type="text" name="date" /><br /><br />

  <?php echo form_label("Durée de la location :"); ?> <?php echo form_error("Durée de la location"); ?><br />
  <input class="textInput" type="text" name="duree" /><br /><br />
</fieldset>


<!-- Bouton de validation -->
<?php echo form_submit(array('id' => 'submit', 'value' => 'Envoyer')); ?>
<?php echo form_close(); ?><br/>




<script type="text/javascript">
document.getElementById('invite').disabled = true;
document.getElementById('invite').style.background="#AAA";
  function cache()
  {
    if(document.forms[0].invitation.value=="false")
    {
      document.getElementById('invite').disabled = true;
      document.getElementById('invite').style.background="#AAA";
      document.forms[0].invitation.value="true";
    }else{
      document.getElementById('invite').disabled = false;
      document.getElementById('invite').style.background="#FFF";
      document.forms[0].invitation.value="false";
    }

  }
</script>


<?php include('includes/footer.php'); ?>
