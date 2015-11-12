<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**************************************
*
*  @author : Tristan LAURENT (Trilunaire)
*
************************************/


class Parapente extends CI_Controller {

  private $colonne;

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Gestion');
    $this->colonne = 'immatriculation';
  }

	public function index()
	{

    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

    $this->form_validation->set_rules('immatriculation', 'Immatriculation', 'required');
    $this->form_validation->set_rules('aile', 'Aile', 'required');
    $this->form_validation->set_rules('suspente', 'Suspente', 'required');
    $this->form_validation->set_rules('sellette', 'Sellette', 'required');

    if($this->form_validation->run() == FALSE){

      $data = array(
        'table'=>$this->Gestion->getInfos('_parapente',$this->colonne),
        'ailes'=>$this->Gestion->getChamp('_aile','numero'),
        'suspentes'=>$this->Gestion->getChamp('_suspente','numero'),
        'sellettes'=>$this->Gestion->getChamp('_sellette','numero')
      );

      $this->load->view('parapente',$data);

    }else{

      $taille = current((array)current($this->Gestion->getCondition('_suspente','taille',"numero='".$this->input->post('suspente')."'")));
      $poidsMin = current((array)current($this->Gestion->getCondition('_aile','poidsMin',"numero='".$this->input->post('aile')."'")));
      $poidsMax = current((array)current(min($this->Gestion->getCondition('_sellette','poidsMAX',"numero='".$this->input->post('sellette')."'"),
                      $this->Gestion->getCondition('_aile','poidsMAX',"numero='".$this->input->post('aile')."'"))));

      $data = array(
        'immatriculation' => $this->input->post('immatriculation'),
        'aile' => $this->input->post('aile'),
        'suspente' => $this->input->post('suspente'),
        'sellette' => $this->input->post('sellette'),
        'tailleMax' => $taille,
        'poidsMax' => $poidsMax,
        'poidsMin' => $poidsMin
      );
      $this->Gestion->insertInfos('_parapente',$data);

      $data = array(
        'table'=>$this->Gestion->getInfos('_parapente',$this->colonne),
        'ailes'=>$this->Gestion->getChamp('_aile','numero'),
        'suspentes'=>$this->Gestion->getChamp('_suspente','numero'),
        'sellettes'=>$this->Gestion->getChamp('_sellette','numero')
      );
      $data['message'] = 'Succès de l\'insertion de données';

      $this->load->view('parapente', $data);
    }

	}

  public function delete($immatriculation){
    $immatPara = array('immatriculation' => $immatriculation);
    $this->Gestion->supprInfo('parapente',$immatPara);
    $this->index();
  }

  public function tri($col)
  {
    $this->colonne = $col;
    $this->index();
  }

}
