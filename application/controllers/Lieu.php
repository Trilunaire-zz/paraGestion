<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**************************************
*
*  @author : Tristan LAURENT (Trilunaire)
*
************************************/


class Lieu extends CI_Controller {

  private $colonne;

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Gestion');
    $this->colonne = 'id';
  }

	public function index()
	{

    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

    $this->form_validation->set_rules('nom', 'Nom', 'required');

    if($this->form_validation->run() == FALSE){

      $data = array(
        'table'=>$this->Gestion->getInfos('_lieu',$this->colonne),
      );

      $this->load->view('lieu',$data);

    }else{

      $data = array(
        'nom' => $this->input->post('nom'),
        'ville' => $this->input->post('ville'),
        'lat' => $this->input->post('lat'),
        'lon' => $this->input->post('lon')
      );
      $this->Gestion->insertInfos('_lieu',$data);

      $data['message'] = 'Succès de l\'insertion de données';
      $data['table'] = $this->Gestion->getInfos('_lieu',$this->colonne);
      $this->load->view('lieu', $data);
    }

	}

  function delete($numLieu){
    $idLieu = array('id' => $numLieu);
    $this->Gestion->supprInfo('lieu', $idLieu);
    $this->index();
  }

  public function tri($col)
  {
    $this->colonne = $col;
    $this->index();
  }

}
