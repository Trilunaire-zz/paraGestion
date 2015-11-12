<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**************************************
*
*  @author : Anthony LOHOU "RandomTony"
*
************************************/


class Accueil extends CI_Controller {

  private $colonne;

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Gestion');
    $this->colonne = 'nom';
  }

	public function index()
	{
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

    $this->form_validation->set_rules('nom', 'Nom', 'required');
    $this->form_validation->set_rules('prenom', 'Prenom', 'required');
    $this->form_validation->set_rules('naissance', 'Naissance', 'required');

    if($this->form_validation->run() == FALSE){
      //si on n'a pas rentré quelque chose de valide
      $data = array(
        'table'=>$this->Gestion->getInfos('_client',$this->colonne),
      );

      $this->load->view('pilote',$data);

    }else{

      $y = explode('/',htmlentities($this->input->post('naissance')))[2];
      $m = explode('/',htmlentities($this->input->post('naissance')))[1];
      $d = explode('/',htmlentities($this->input->post('naissance')))[0];
      $date = "$y-$m-$d";

      $data= array(
        'nom' => htmlentities($this->input->post('nom')),
        'prenom' => htmlentities($this->input->post('prenom')),
        'naissance' => $date,
        'adresse' => htmlentities($this->input->post('adresse')),
        'poids' => htmlentities($this->input->post('poids')),
        'taille' => htmlentities($this->input->post('taille')),
        'achat' => 0
      );

      $this->Gestion->insertInfos('_client',$data);
      if($this->input->post('role')=="pilote")
      {
        $data= array(
          'nom' => htmlentities($this->input->post('nom')),
          'prenom' => htmlentities($this->input->post('prenom')),
          'naissance' => $date,
          'no_licence' => htmlentities($this->input->post('licence')),
          'niveau' => htmlentities($this->input->post('niveau')),
        );
        $this->Gestion->insertInfos('_pilote',$data);
      }else{
        $data= array(
          'nom' => htmlentities($this->input->post('nom')),
          'prenom' => htmlentities($this->input->post('prenom')),
          'naissance' => $date,
        );
        $this->Gestion->insertInfos('_invite',$data);
      }

      $data['message'] = 'Succès de l\'insertion de données';
      $data['table'] = $this->Gestion->getInfos('_client',$this->colonne);
      $this->load->view('pilote', $data);
    }

	}

  function delete($client)
  {
    $idClient = array_fill_keys(array('nom','prenom','naissance'), NULL); //on rempli l'array avec les clé et les valeurs dont on a enlevé les underscores
    $idClient['nom'] = explode('_', $client)[0];
    $idClient['prenom'] = explode('_', $client)[1];
    $idClient['naissance'] = explode('_', $client)[2];
    $this->Gestion->supprInfo('pilote', $idClient);
    $this->index();
  }

  public function tri($col)
  {
    $this->colonne = $col;
    $this->index();
  }

}
