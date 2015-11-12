<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**************************************
*
*  @author : Anthony LOHOU "RandomTony"
*
************************************/


class Fournisseur extends CI_Controller {

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

    $this->form_validation->set_rules('nom','Nom','required');

    if($this->form_validation->run() == FALSE){

      $data = array(
        'table'=>$this->Gestion->getInfos('_fournisseur',$this->colonne),
      );
      $this->load->view('fournisseur',$data);

    }else{

      $data = array(
          'nom' => $this->input->post('nom'),
          'telephone' => $this->input->post('phone'),
        );


      $this->Gestion->insertInfos('_fournisseur',$data);


      $data = array(
        'table'=>$this->Gestion->getInfos('_fournisseur',$this->colonne),
        'message' => "insertion reussie"
      );
      $this->load->view('fournisseur',$data);
    }
	}

  public function delete($nom){
    $nomFour = array('nom' => $nom);
    //on doit transformer la variable en array pour la suppression
    $this->Gestion->supprInfo('fournisseur',$nomFour);
    $this->index();
  }

  public function tri($col)
  {
    $this->colonne = $col;
    $this->index();
  }

}
