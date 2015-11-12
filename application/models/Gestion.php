<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**************************************
*
*  @author : Anthony LOHOU "RandomTony"
*
************************************/


class Gestion extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function getInfos($table,$champ)
	{
		return $this->db->select('*')
						->from($table)
						->order_by($champ,'ASC')
						->get()
						->result();
	}

	public function getChamp($table,$champ)
	{
		return $this->db->select($champ)
						->from($table)
						->get()
						->result();
	}

	public function insertInfos($table,$data)
	{
		$this->db->insert($table,$data);
	}

	public function updateAll($table,$champs,$id,$idValue)
	{
		$this->db->where($id,$idValue);
		$this->db->update($table,$data);
	}

	public function updateChamp($table,$id,$idVal,$value,$champ)
	{

		$this->db->set($champ, $value);
		$this->db->where($id,$idVal);
		$this->db->update($table);
	}

	public function supprInfo($table,$data) //pour supprimer,$data doit être sous la forme d'un array
	{
		switch ($table) {
			case 'pilote':
				//TODO: Trouver le numero de licence qui correspond au nom et prénom et supprimer ensuite les locations
				$this->db->delete('db570839030._invite',$data);
				$this->db->delete('db570839030._pilote',$data);
				$this->db->delete('db570839030._client',$data);
				break;
			case 'lieu':
			//la aussi faut del les locations relatives au lieu
				$this->db->where('depart', $data['id']);
				$this->db->or_where('arrivee', $data['id']);
				$this->db->delete('db570839030._location'); //donne DELETE FROM _location WHERE depart = $data OR arrive = $data
				$this->db->delete('db570839030._lieu',$data);
				break;
			case 'location':
				$this->db->delete('db570839030._location',$data);
				break;
			case 'parapente':
				$this->db->where('parapente', $data['immatriculation']);
				$this->db->delete('db570839030._location');
				$this->db->delete('db570839030._parapente',$data);
				break;
			case 'materiel':
				//on doit supprimer les parapentes relatifs au matos (on va réutiliser la fonction supprimer)
				//$old_parapente = $this->db->select('immatriculation')->from('db570839030._parapente')->where('sellette', $data['numero'])->or_where('aile', $data['numero'])->or_where('suspente', $data['numero'])->get()->result();
				//maintenant on a les parapentes, on peut supprimer les locations
				// foreach ($old_parapente as $immat => $para) {
				// 	$this->db->where('parapente', $para);
				// 	$this->db->delete('db570839030._location');
				// }
				//maintenant on supprime les parapentes
				// $this->db->where('sellette', $data['numero'])->or_where('aile', $data['numero'])->or_where('suspente', $data['numero']);
				// $this->db->delete('_parapente');
				$this->db->delete('db570839030._aile', $data);
				$this->db->delete('db570839030._suspente', $data);
				$this->db->delete('db570839030._sellette', $data);
				$this->db->delete('db570839030._materiel', $data);
				break;
			case 'fournisseur':
				$this->db->delete('db570839030._fournisseur',$data);
				break;
			case 'controle':
				$this->db->delete('db570839030._controleTechnique',$data);
				break;
			default:
				//do nothing
				break;
		}
	}


	//Modification des achats (prix ++ )
	function buy($id,$somme)
	{
		$p = $this->getCondition('_client','achat',"nom = '".$id['nom']."' and prenom='".$id['prenom']."' and naissance='".$id['naissance']."'");
		$this->db->set('achat', (double)$p+$somme);
		$this->db->where('nom',$id['nom'])->where('prenom',$id['prenom'])->where('naissance',$id['naissance']);
		$this->db->update('_client');
	}


	public function getCondition($table,$champ,$condition)
	{
		return $this->db->select($champ)
						->from($table)
						->where($condition)
						->get()
						->result();
	}

	public function getParapente($taille,$poids,$date)
	{
		$p = "false";

		$temp = $this->getCondition('_parapente','immatriculation',"tailleMax>=$taille
																																		and poidsMax>=$poids
																																		and poidsMin<=$poids
																																		and immatriculation not in(SELECT parapente FROM _location WHERE dateDeVol='$date')"
																																		);

		if(!is_null($temp))
		{
			$p = current((array)current($temp));
		}
		return $p;
	}




}
