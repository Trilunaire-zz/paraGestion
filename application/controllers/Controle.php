<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**************************************
*
*  @author : Anthony LOHOU "RandomTony"
*
************************************/


class Controle extends CI_Controller {

  private $colonne;

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Gestion');
    $this->colonne = 'date';
  }

	public function index()
	{
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

    $this->form_validation->set_rules('numero','Numero','required');

    if($this->form_validation->run() == FALSE){

      $data = array(
        'table'=>$this->Gestion->getInfos('_controleTechnique',$this->colonne),
      );
      $this->load->view('controleTechnique',$data);

    }else{

      $y = explode('/',$this->input->post('date'))[2];
      $m = explode('/',$this->input->post('date'))[1];
      $d = explode('/',$this->input->post('date'))[0];
      $date = "$y-$m'$d";


      $resultat = "négatif";
      if($this->input->post('resultat')){
        $resultat = "positif";
      }
      $data = array(
          'numero' => 'DEFAULT',
          'type' => $this->input->post('type'),
          'resultat' => $resultat,
          'date' => $date,
          'numMat' => $this->input->post('numero'),
          'description' =>$this->input->post('description'),

        );


      $this->Gestion->insertInfos('_controleTechnique',$data);


      $data = array(
        'table'=>$this->Gestion->getInfos('_controleTechnique',$this->colonne),
        'message' => "insertion reussie"
      );
      $this->load->view('controleTechnique',$data);
    }
	}

  public function delete($numero){
    $numberControle = array('numero' => $numero);
    //on doit transformer la variable en array pour la suppression
    $this->Gestion->supprInfo('controle',$numberControle);
    $this->index();
  }

  public function tri($col)
  {
    $this->colonne = $col;
    $this->index();
  }

}
