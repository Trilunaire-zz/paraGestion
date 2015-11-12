<?php include('includes/header.php'); ?>
<?php include('includes/fonctions.php'); ?>
<?php include('table.php');?>




<?php echo form_open('Materiel'); ?>
<h3>Information du materiel</h3><hr/>

<?php if (isset($message)) { ?>
<CENTER><h3 style="color:green;">Insertion du materiel réussie</h3></CENTER><br>

<?php } ?>
  <!-- Partie du formaulaire -->
  <fieldset >
    <legend>Type de materiel</legend>
    Aile :<input type="radio" name="type_mat" value="Aile" id="ch" onchange='hide("suspente");hide("sellette");show("aile")' /><br />
    Sellette :<input type="radio" name="type_mat" value="Sellette" onclick='hide("suspente");hide("aile");show("sellette")'/><br />
    Suspente :<input type="radio" name="type_mat" value="Suspente" onclick='hide("sellette");hide("aile");show("suspente")'/><br />
  </fieldset>

  <fieldset>
    <legend>Immatriculation</legend>
    <?php echo form_label("Numero :"); ?> <?php echo form_error("Numero"); ?><br />
    <input class="textInput" type="text" name="numero" /><br />

    <?php echo form_label("Marque :"); ?> <?php echo form_error("Marque"); ?><br />
    <input class="textInput" list="marques" type="text" name="marque" />
    <datalist id="marques">
      <?php foreach($marques as $item):?>
        <option value="<?php echo objectToArray($item)['nom'];?>">
      <?php endforeach?>
    </datalist><br />

    <?php echo form_label("Etat :"); ?> <?php echo form_error("Etat"); ?><br />
    <input class="textInput" type="text" name="etat" /><br />
  </fieldset>

  <fieldset id="aile">
    <legend>Information relative à l'aile</legend>
    <?php echo form_label("Surface :"); ?> <?php echo form_error("Surface"); ?><br />
    <input class="textInput" type="text" name="surface" /><br />

    <?php echo form_label("type :"); ?> <?php echo form_error("Type"); ?><br />
    <input class="textInput" type="text" name="type_aile" /><br />

    <?php echo form_label("Poids minimum :"); ?> <?php echo form_error("Poids minimum"); ?><br />
    <input class="textInput" type="number" name="poidsMIN" min="0" max="300" /><br />
    <?php echo form_label("Poids maximum :"); ?> <?php echo form_error("Poids maximum"); ?><br />
    <input class="textInput" type="number" name="poidsMAX" min="0" max="300" /><br />
  </fieldset>

  <fieldset id="sellette">
    <legend>Information relative à la sellette</legend>
    <?php echo form_label("Type :"); ?> <?php echo form_error("Type"); ?><br />
    <input class="textInput" type="text" name="type_selle" /><br />

    <?php echo form_label("Poids maximum :"); ?> <?php echo form_error("Poids maximum"); ?><br />
    <input class="textInput" type="number" name="poidsMax" min="0" max="300"/><br />

    <?php echo form_label("Places :"); ?> <?php echo form_error("Places"); ?><br />
    <input class="textInput" type="number" name="place" min="1" max="2" value="1" /><br />
  </fieldset>

  <fieldset id="suspente">
    <legend>Information relative aux suspentes</legend>
    <?php echo form_label("Taille :"); ?> <?php echo form_error("Taille"); ?><br />
    <input class="textInput" type="number" name="taille" min="0" /><br />
  </fieldset>


<?php echo form_submit(array('id' => 'submit', 'value' => 'Envoyer')); ?>
<?php echo form_close(); ?><br/>

</div>

<script type="text/javascript">
document.getElementById("sellette").style.display = "none";
document.getElementById("suspente").style.display = "none";
document.getElementById("ch").checked = true;
function show(id){
  document.getElementById(id).style.display = "block";
}
function hide(id){
  document.getElementById(id).style.display = "none";
}
</script>

<?php include('includes/footer.php'); ?>
