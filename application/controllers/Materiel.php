<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**************************************
*
*  @author : Anthony LOHOU "RandomTony"
*
************************************/


class Materiel extends CI_Controller {

  private $colonne;

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Gestion');
    $this->colonne = 'numero';
  }

	public function index()
	{
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

    $this->form_validation->set_rules('numero', 'Numero', 'required');


    if($this->form_validation->run() == FALSE){

      $data = array(
        'table'=>$this->Gestion->getInfos('_materiel',$this->colonne),
        'marques' => $this->Gestion->getChamp('_fournisseur','nom')
      );

      $this->load->view('materiel',$data);

    }else{

      $data = array(
        'numero' => $this->input->post('numero'),
        'marque' => $this->input->post('marque'),
        'etat' => $this->input->post('etat')
      );
      $this->Gestion->insertInfos('_materiel',$data);

      switch($this->input->post('type_mat')){
        case 'Sellette' :
          $data = array(
            'numero' => $this->input->post('numero'),
            'type' => $this->input->post('type_selle'),
            'poidsMAX' => $this->input->post('poidsMax'),
            'places' => $this->input->post('place')
          );
          $this->Gestion->insertInfos('_sellette',$data);
          break;
        case 'Suspente' :
          $data = array(
            'numero' => $this->input->post('numero'),
            'taille' => $this->input->post('taille'),
          );
          $this->Gestion->insertInfos('_suspente',$data);
          break;
        case 'Aile' :
          $data = array(
            'numero' => $this->input->post('numero'),
            'type' => $this->input->post('type_aile'),
            'surface' => $this->input->post('surface'),
            'poidsMin' => $this->input->post('poidsMIN'),
            'poidsMAX' => $this->input->post('poidsMAX')
          );
          $this->Gestion->insertInfos('_aile',$data);
          break;

      }



      $data['message'] = 'Succès de l\'insertion de données';
      $data['table'] = $this->Gestion->getInfos('_materiel',$this->colonne);
      $data['marques'] = $this->Gestion->getChamp('_fournisseur','nom');
      $this->load->view('materiel', $data);
    }


	}

  function modification()
  {

  }

  public function tri($col)
  {
    $this->colonne = $col;
    $this->index();
  }

  function delete($numero){
    $numMatos = array('numero', $numero);
    $this->Gestion->supprInfo('materiel', $numMatos);
    $this->index();
  }

}
