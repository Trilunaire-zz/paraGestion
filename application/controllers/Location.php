<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**************************************
*
*  @author : Anthony LOHOU "RandomTony"
*
************************************/


class Location extends CI_Controller {

  private $colonne;

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Gestion');
    $this->colonne = 'dateDeVol';
  }

	public function index()
	{


    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

    $this->form_validation->set_rules('pilote','Pilote','required');

    if($this->form_validation->run() == FALSE){

      $data = array(
        'table'=>$this->Gestion->getInfos('_location',$this->colonne),
        'pilotes' => $this->Gestion->getChamp('_pilote','nom,prenom,naissance'),
        'invites' => $this->Gestion->getChamp('_client','nom,prenom,naissance'),
        'lieux' =>$this->Gestion->getChamp('_lieu','nom')
      );
      $this->load->view('location',$data);

    }else{
      $data = array();

      $licence = explode("-",$this->input->post('pilote'));
      $parapente="false";
      $poids = (array)$this->Gestion->getCondition('_client','poids',"nom='$licence[0]' and prenom='$licence[1]' and naissance='$licence[2]-$licence[3]-$licence[4]'")[0];
      $taille = (array)$this->Gestion->getCondition('_client','taille',"nom='$licence[0]' and prenom='$licence[1]' and naissance='$licence[2]-$licence[3]-$licence[4]'")[0];
      if($this->input->post('invitation')=="false")
      {
        $inv = explode("-",$this->input->post('invite'));
        $temp = (array)$this->Gestion->getCondition('_client','poids',"nom='$inv[0]' and prenom='$inv[1]' and naissance='$inv[2]-$inv[3]-$inv[4]'")[0];
        $poids['poids'] += $temp['poids'];
        $temp = (array)$this->Gestion->getCondition('_client','taille',"nom='$inv[0]' and prenom='$inv[1]' and naissance='$inv[2]-$inv[3]-$inv[4]'")[0];
        $taille['taille'] = max($taille['taille'],$temp['taille']);
      }


      $y = explode('/',htmlentities($this->input->post('date')))[2];
      $m = explode('/',htmlentities($this->input->post('date')))[1];
      $d = explode('/',htmlentities($this->input->post('date')))[0];
      $date = "$y-$m-$d";

      $parapente = $this->Gestion->getParapente($taille['taille'],$poids['poids'],$date);


      if($parapente!="0"){

        $prix = 45*$this->input->post('duree');
        $data = array(
          'pilote' => "$licence[0] $licence[1] $licence[2]-$licence[3]-$licence[4]",
          'invite' => "---",
          'depart' => $this->input->post('depart'),
          'arrivee' => $this->input->post('arrive'),
          'duree' => $this->input->post('duree'),
          'dateDeVol' => $date,
          'parapente' => $parapente,
          'prix' => $prix
        );

        if($this->input->post('invitation')=="false")
        {
          $prix = 50*$this->input->post('duree');
          $data['prix'] = $prix;
          $invite = explode('-',$this->input->post('invite'));
          $data['invite'] = "$invite[0] $invite[1] $invite[2]-$invite[3]-$invite[4]";
          $this->Gestion->buy(array('nom'=>$licence[0],'prenom'=>$licence[1],'naissance'=>"$licence[2]-$licence[3]-$licence[4]"),$prix*.8);
          $this->Gestion->buy(array('nom'=>$invite[0],'prenom'=>$invite[1],'naissance'=>"$invite[2]-$invite[3]-$invite[4]"),$prix-$prix*.8);
        }else{
          $this->Gestion->buy(array('nom'=>$licence[0],'prenom'=>$licence[1],'naissance'=>"$licence[2]-$licence[3]-$licence[4]"),$prix);
        }

        $this->Gestion->insertInfos('_location',$data);
        $data = array(
          'table'=>$this->Gestion->getInfos('_location',$this->colonne),
          'pilotes' => $this->Gestion->getChamp('_pilote','nom,prenom,naissance'),
          'invites' => $this->Gestion->getChamp('_client','nom,prenom,naissance'),
          'lieux' =>$this->Gestion->getChamp('_lieu','nom')
        );
        $data['message'] = 'Succès de l\'insertion de données';
        $this->load->view('location', $data);

      }else{
        $data = array(
          'table'=>$this->Gestion->getInfos('_location',$this->colonne),
          'pilotes' => $this->Gestion->getChamp('_pilote','nom,prenom,naissance'),
          'invites' => $this->Gestion->getChamp('_client','nom,prenom,naissance'),
          'lieux' =>$this->Gestion->getChamp('_lieu','nom')
        );
        $this->load->view('fail', $data);
      }

    }
	}

  public function delete($numero){
    $numberLoc = array('numero' => $numero);
    //on doit transformer la variable en array pour la suppression
    $this->Gestion->supprInfo('location',$numberLoc);
    $this->index();
  }

  public function tri($col)
  {
    $this->colonne = $col;
    $this->index();
  }

}
