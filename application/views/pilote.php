<?php include('includes/header.php'); ?>


<?php include('table.php');?>


<?php echo form_open('Accueil'); ?>
<h3>Information du client</h3><hr/>

<?php if (isset($message)) { ?>
<CENTER><h3 style="color:green;">Insertion d'un client réussie</h3></CENTER><br>

<?php } ?>
  <!-- Partie du formaulaire -->
  <?php echo form_label('Role :'); ?> <?php echo form_error('role:'); ?>
  <select id="role" onchange="cache()" name="role">
    <option value="pilote" selected>Pilote</option>
    <option value="invite">Invité</option>
  </select><br />
  <?php echo form_label('Licence :'); ?> <?php echo form_error('Licence :'); ?><br />
  <input class="textInput" id="licence" type="text" name="licence" /><br />
  <?php echo form_label('Niveau :'); ?> <?php echo form_error('niveau :'); ?><br />
  <input class="textInput" id="niveau" type="text" name="niveau" /><br />
  <?php echo form_label('Nom :'); ?> <?php echo form_error('nom:'); ?><br />
  <input class="textInput" type="text" name="nom" /><br />
  <?php echo form_label('Prenom :'); ?> <?php echo form_error('prenom:'); ?><br />
  <input class="textInput" type="text" name="prenom" /><br />
  <?php echo form_label('Naissance :'); ?> <?php echo form_error('naissance:'); ?><br />
  <input class="textInput" type="text" name="naissance" /><br />
  <?php echo form_label('Adresse :'); ?> <?php echo form_error('adresse:'); ?><br />
  <input class="textInput" type="text" name="adresse" /><br />
  <?php echo form_label('Téléphone :'); ?> <?php echo form_error('Téléphone:'); ?><br />
  <input class="textInput" type="text" name="telephone" /><br />
  <?php echo form_label('Poids :'); ?> <?php echo form_error('poids:'); ?><br />
  <input class="textInput" type="number" name="poids" min="45" max="150"/><br />
  <?php echo form_label('Taille :'); ?> <?php echo form_error('taille:'); ?><br />
  <input class="textInput" type="number" name="taille" min="135" max="250"/><br />

<?php echo form_submit(array('id' => 'submit', 'value' => 'Envoyer')); ?>
<?php echo form_close(); ?><br/>

<script type="text/javascript">
  function cache()
  {
    if(document.forms[0].role.value=="invite")
    {
      document.getElementById('licence').disabled = true;
      document.getElementById('licence').style.background="#AAA";
      document.getElementById('niveau').disabled = true;
      document.getElementById('niveau').style.background="#AAA";
    }else{
      document.getElementById('licence').disabled = false;
      document.getElementById('licence').style.background="#FFF";
      document.getElementById('niveau').disabled = false;
      document.getElementById('niveau').style.background="#FFF";
    }

  }
</script>

<?php include('includes/footer.php'); ?>
