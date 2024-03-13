<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class emploie extends CI_Controller {


	
	public function dashboard()
	{
		$this->load->view('login');
	}
	public function dash()
	{	
		$this->load->view('index');
		
	}

	public function login() {

		$this->load->model('emploies_model');
		// Traitez le formulaire de connexion ici
		$email = $this->input->post('email');
		$pass = $this->input->post('pass');

		$admin = $this->emploies_model->authenticate($email, $pass);
		$user = $this->emploies_model->authentification($email, $pass);

		if ($admin){
			// Authentification réussie, redirigez vers la page appropriée (utilisateur ou admin)
			// Vous pouvez également utiliser une session pour stocker les informations de l'utilisateur
			$this->session->set_userdata($admin);
			redirect('http://localhost/gbancaire/index.php/emploie/index/'); // Remplacez 'dashboard' par le chemin approprié
			//dash();
		}
		else if ($user){
			// Authentification réussie, redirigez vers la page appropriée (utilisateur ou admin)
			// Vous pouvez également utiliser une session pour stocker les informations de l'utilisateur
			$this->session->set_userdata($user);
			redirect('http://localhost/gbancaire/index.php/emploie/session/'); // Remplacez 'dashboard' par le chemin approprié
			//session();
		}		
		
		else {
				// Authentification réussie, redirigez vers la page appropriée (utilisateur ou admin)
				// Vous pouvez également utiliser une session pour stocker les informations de l'utilisateur
				// par exemple, $this->session->set_userdata('user_id', $user['id']);
				redirect('http://localhost/gbancaire/index.php/emploie/dashboard'); // Remplacez 'dashboard' par le chemin approprié
				//dashboard();
		} 
	} 

	public function deconnexion() {
		$this->session->sess_destroy();
		redirect('http://localhost/gbancaire/index.php/emploie/dashboard'); // Remplacez 'dashboard' par le chemin approprié
	 // Rediriger vers la page d'accueil ou une autre page après la déconnexion
	}
	

	function select_list()
    {
       
        
        $term = $this->input->get('searchTerm'); //$_GET['q'];
        
        if (isset($term)) {
            $sql = "SELECT `IDDomaine`, `NomDomaine`FROM 'domaine' WHERE 'NomDomaine' LIKE '%$term%'  ";
            $ville = $this->db->query($sql)->result();
            $json = [];
            foreach ($ville as $v) {
                $json[] = ['IDDomaine' => $v->IDDomaine, 'NomDomaine' => $v->NomDomaine];
            }
            echo json_encode($json);
        }
    }
	public function index(){
		$this->load->model('emploies_model');
		$audit_compte = $this->emploies_model->auditall();
		$data = array();
		$data['audit_compte'] = $audit_compte;
		$this->load->view('index',$data);
	}
	public function indexmodi(){
		$this->load->model('emploies_model');
		$audit_compte = $this->emploies_model->audimodif();
		$data = array();
		$data['audit_compte'] = $audit_compte;
		$this->load->view('modif',$data);
	}
	public function indexsuppre(){
		$this->load->model('emploies_model');
		$audit_compte = $this->emploies_model->audisuppre();
		$data = array();
		$data['audit_compte'] = $audit_compte;
		$this->load->view('suppre',$data);
	}
	public function emp(){
		$this->load->model('emploies_model');
		
		$this->form_validation->set_rules('matricule','Matricule','required');
		$this->form_validation->set_rules('codeservice','Code Service','required');
		$this->form_validation->set_rules('codeemploie','Code Emploie','required');
		$this->form_validation->set_rules('dateentrer','Date Entrer','required');
		$this->form_validation->set_rules('nom','Nom','required');
		$this->form_validation->set_rules('prenom','Prenom','required');
		$this->form_validation->set_rules('sexe','Sexe','required');
		$this->form_validation->set_rules('tel','Telephone','required');
		
		if ($this->form_validation->run() == false) {
			$emploies = $this->emploies_model->AllEtab();
			$service = $this->emploies_model->serviceAll();
			$data = array();
			$data['emploies'] = $emploies;
			$data['service'] = $service;
			$this->load->view('employeur',$data);
		} else {
			$formArray = array();
			$formArray['MATRICULE']=$this->input->post('matricule');
			$formArray['CODESERVICE']=$this->input->post('codeservice');
			$formArray['CODEEMPLOIS']=$this->input->post('codeemploie');
			$formArray['DATEENTRE']=$this->input->post('dateentrer');
			$formArray['NOM']=$this->input->post('nom');
			$formArray['PRENOM']=$this->input->post('prenom');
			$formArray['sexe']=$this->input->post('sexe');
			$formArray['TELEPHONE']=$this->input->post('tel');
			$this->emploies_model->cremp($formArray);
			$this->session->set_flashdata('success', 'Ajout avec succes');
			redirect(base_url().'index.php/emploie/emploindex');
		}
	}
	public function domaine(){
		$this->load->model('emploies_model');
		$domaine = $this->emploies_model->domaineAll();
		$data = array();
		$data['domaine'] = $domaine;
		$data['etablissement']=$domaine;
		$this->load->view('domaine',$data);
	}
	public function Congeindex(){
		$this->load->model('emploies_model');
		$data['conge']= $this->emploies_model->AllConge();
	
		$this->load->view('list_conge',$data);
	}
	public function demande(){
		$this->load->model('emploies_model');
		$data['demande'] = $this->emploies_model->dem();
		$this->load->view('list_demande',$data);
	}
	
	public function emploindex(){
		$this->load->model('emploies_model');
		$data['emplo'] = $this->emploies_model->empl();
		$this->load->view('list_employeur',$data);
	}
	

	//CRUD EMPLOI
	public function create(){
		$this->load->model('emploies_model');
		$this->form_validation->set_rules('code','Code Etablissement','required');
		$this->form_validation->set_rules('nom','Nom Etablissement','required');
		
		if ($this->form_validation->run() == false) {
			$this->load->view('add_etablissement');
		} else {
			$formArray = array();
			$formArray['CodeEtab']=$this->input->post('code');
			$formArray['NomEtab']=$this->input->post('nom');
			$this->emploies_model->create($formArray);
			$this->session->set_flashdata('success', 'Ajout avec succes');
			redirect(base_url().'index.php/emploie/index');
		}
	
	}
	public function dema(){
		$this->load->model('emploies_model');
		$this->form_validation->set_rules('matricule','Matricule','required');
		$this->form_validation->set_rules('codeconge','code conge','required');
		$this->form_validation->set_rules('datedebut','Date Debut','required');
		$this->form_validation->set_rules('daterep','Date Reprendre','required');
		
		if ($this->form_validation->run() == false) {
			$data['emplo'] = $this->emploies_model->empl();
			$data['conge'] = $this->emploies_model->AllConge();
			
			$this->load->view('demande',$data);
		} else {
			$formArray = array();
			$formArray['MATRICULE']=$this->input->post('matricule');
			$formArray['CODECONGE']=$this->input->post('codeconge');
			$formArray['DATEDEBUT']=$this->input->post('datedebut');
			$formArray['DATEREPRENDRE']=$this->input->post('daterep');
			$this->emploies_model->demende($formArray);
			$this->session->set_flashdata('success', 'Ajout avec succes');
			redirect(base_url().'index.php/emploie/demande');
		}
	
	}

	function edit ($etabId){
		$this->load->model('emploies_model');
		$etablissement = $this->emploies_model->getEtab($etabId);
		$data = array();
		$data['etablissement'] = $etablissement;

		$this->form_validation->set_rules('code','Code etablissement','required');
		$this->form_validation->set_rules('nom','Nom Etablisement','required');

		if ($this->form_validation->run() == false) {
			$this->load->view('edit_etablissement',$data);
		} else {
			$formArray = array();
			$formArray['CodeEtab'] = $this->input->post('code');
			$formArray['NomEtab'] = $this->input->post('nom');
			$this->emploies_model->modifEtab($etabId, $formArray);
			$this->session->set_flashdata('success', 'Modification avec succes');
			redirect(base_url().'index.php/emploie/index');
		}
		
	}
	
	function delete($etabId){
		$this->load->model('emploies_model');
		$etablissement = $this->emploies_model->getEtab($etabId);
		if(empty($etabId)){
			$this->session->set_flashdata('failure', 'error');
			redirect(base_url().'index.php/emploie/index');
		}
		$this->emploies_model->deleteEtab($etabId);
		$this->session->set_flashdata('Success', 'Emploie Supprimer');
		redirect(base_url().'index.php/emploie/index');
		
	}
	//CRUD SESSION
	public function session(){
		$this->load->model('emploies_model');
		$compte = $this->emploies_model->sessionAll();
		$data = array();
		$data['compte'] = $compte;
		$this->load->view('session',$data);
	}

	
	public function addsession(){
		$this->load->model('emploies_model');
		$this->form_validation->set_rules('id_user','id_user','required');
		$this->form_validation->set_rules('numcompte','numcompte','required');
		$this->form_validation->set_rules('nomclient','nomclient','required');
		$this->form_validation->set_rules('solde','solde ','required');
		if ($this->form_validation->run() == false) {
			$this->load->view('add_session');
		} else {
			$formArray = array();
			$formArray['id_user']=$this->input->post('id_user');
			$formArray['numcompte']=$this->input->post('numcompte');
			$formArray['nomclient']=$this->input->post('nomclient');
			$formArray['solde']=$this->input->post('solde');
			$this->emploies_model->session($formArray);
			$this->session->set_flashdata('success', 'Ajout avec succes');
			redirect(base_url().'index.php/emploie/session');
		}
	
	}
	public function registrer(){
		$this->load->model('emploies_model');
		$this->form_validation->set_rules('nom','nom','required');
		$this->form_validation->set_rules('email','email','required');
		$this->form_validation->set_rules('pass','pass ','required');
		if ($this->form_validation->run() == false) {
			$this->load->view('registrer');
		} else {
			$formArray = array();
			$formArray['nom']=$this->input->post('nom');
			$formArray['email']=$this->input->post('email');
			$formArray['pass']=$this->input->post('pass');
			$this->emploies_model->registrer($formArray);
			$this->session->set_flashdata('success', 'Ajout avec succes');
			redirect(base_url().'index.php/emploie/login');
		}
	
	}
	function editsession ($compteId){
		$this->load->model('emploies_model');
		$compte = $this->emploies_model->getsession($compteId);
		$data = array();
		$data['compte'] = $compte;
		$this->form_validation->set_rules('id_user','id_user','required');
		$this->form_validation->set_rules('numcompte','compte','required');
		$this->form_validation->set_rules('nomclient','client','required');
		$this->form_validation->set_rules('solde','solde ','required');
		

		if ($this->form_validation->run() == false) {
			$this->load->view('modif_session',$data);
		} else {
			$formArray = array();
			$formArray['id_user']=$this->input->post('id_user');
			$formArray['numcompte']=$this->input->post('numcompte');
			$formArray['nomclient']=$this->input->post('nomclient');
			$formArray['solde']=$this->input->post('solde');
			$this->emploies_model->modifsession($compteId, $formArray);
			$this->session->set_flashdata('success', 'Modification avec succes');
			redirect(base_url().'index.php/emploie/session');
		}
		
	}
	function deletesession($compteId){
		$this->load->model('emploies_model');
		$domaine = $this->emploies_model->getsession($compteId);
		if(empty($compteId)){
			$this->session->set_flashdata('failure', 'error');
			redirect(base_url().'index.php/emploie/index');
		}
		$this->emploies_model->deletesession($compteId);
		$this->session->set_flashdata('Success', 'session Supprimer');
		redirect(base_url().'index.php/emploie/session');
		
	}

	//CRUD DOMAINE
	public function adddomaine(){
		$this->load->model('emploies_model');
		$this->form_validation->set_rules('code','Code domaine','required');
		$this->form_validation->set_rules('nom','nom domaine','required');
		$this->form_validation->set_rules('etablissement','etablissement ','required');
		
		if ($this->form_validation->run() == false) {
			$this->load->view('add_domaine');
		} else {
			$formArray = array();
			$formArray['CodeDomaine']=$this->input->post('code');
			$formArray['NomDomaine']=$this->input->post('nom');
			$formArray['IDEtab']=$this->input->post('etablissement');
			$this->emploies_model->domaine($formArray);
			$this->session->set_flashdata('success', 'Ajout avec succes');
			redirect(base_url().'index.php/emploie/domaine');
		}
	
	}
	
	function editdomaine ($domaineId){
		$this->load->model('emploies_model');
		$domaine = $this->emploies_model->getdomaine($domaineId);
		$data = array();
		$data['domaine'] = $domaine;
		$data['etablissement'] = $domaine;
		$this->form_validation->set_rules('code','Code domaine','required');
		$this->form_validation->set_rules('nom','nom domaine','required');
		$this->form_validation->set_rules('etablissement','etablissement','required');

		if ($this->form_validation->run() == false) {
			$this->load->view('modif_domaine',$data);
		} else {
			$formArray = array();
			$formArray['CodeDomaine'] = $this->input->post('code');
			$formArray['NomDomaine'] = $this->input->post('nom');
			$formArray['IDEtab'] = $this->input->post('etablissement');
			$this->emploies_model->modifdomaine($domaineId, $formArray);
			$this->session->set_flashdata('success', 'Modification avec succes');
			redirect(base_url().'index.php/emploie/domaine');
		}
		
	}
	function deletedomaine($domaineId){
		$this->load->model('emploies_model');
		$domaine = $this->emploies_model->getdomaine($domaineId);
		if(empty($domaineId)){
			$this->session->set_flashdata('failure', 'error');
			redirect(base_url().'index.php/emploie/index');
		}
		$this->emploies_model->deletedomaine($domaineId);
		$this->session->set_flashdata('Success', 'domaine Supprimer');
		redirect(base_url().'index.php/emploie/domaine');
		
	}
	//CRUD MENTION
	public function mention(){
		$this->load->model('emploies_model');
		$mention = $this->emploies_model->mentionAll();
		$data = array();
		$data['mention'] = $mention;
		$data['domaine']=$mention;
		$this->load->view('mention',$data);
	}
	public function addmention(){
		$this->load->model('emploies_model');
		$this->form_validation->set_rules('code','Code mention','required');
		$this->form_validation->set_rules('nom','nom mention','required');
		$this->form_validation->set_rules('domaine','domaine ','required');
		
		if ($this->form_validation->run() == false) {
			$this->load->view('add_mention');
		} else {
			$formArray = array();
			$formArray['CodeMention']=$this->input->post('code');
			$formArray['NomMention']=$this->input->post('nom');
			$formArray['IDDomaine']=$this->input->post('domaine');
			$this->emploies_model->mention($formArray);
			$this->session->set_flashdata('success', 'Ajout avec succes');
			redirect(base_url().'index.php/emploie/mention');
		}
	
	}
	function editmention ($mentionId){
		$this->load->model('emploies_model');
		$mention = $this->emploies_model->getmention($mentionId);
		$data = array();
		$data['mention'] = $mention;
		$this->form_validation->set_rules('code','Code mention','required');
		$this->form_validation->set_rules('nom','nom mention','required');
		$this->form_validation->set_rules('domaine','domaine','required');

		if ($this->form_validation->run() == false) {
			$this->load->view('modif_mention',$data);
		} else {
			$formArray = array();
			$formArray['CodeMention'] = $this->input->post('code');
			$formArray['NomMention'] = $this->input->post('nom');
			$formArray['IDDomaine'] = $this->input->post('domaine');
			$this->emploies_model->modifmention($mentionId, $formArray);
			$this->session->set_flashdata('success', 'Modification avec succes');
			redirect(base_url().'index.php/emploie/mention');
		}
		
	}
	function deletemention($mentionId){
		$this->load->model('emploies_model');
		$mention = $this->emploies_model->getmention($mentionId);
		if(empty($mentionId)){
			$this->session->set_flashdata('failure', 'error');
			redirect(base_url().'index.php/emploie/index');
		}
		$this->emploies_model->deletemention($mentionId);
		$this->session->set_flashdata('Success', 'mention Supprimer');
		redirect(base_url().'index.php/emploie/mention');
		
	}
	//////////////////////////////////////////////////
	///CRUD PARCOURS////////
	public function parcours(){
		$this->load->model('emploies_model');
		$parcours = $this->emploies_model->parcoursAll();
		$data = array();
		$data['parcours'] = $parcours;
		$data['mention']=$parcours;
		$this->load->view('parcours',$data);
	}
	public function addparcours(){
		$this->load->model('emploies_model');
		$this->form_validation->set_rules('code','Code parcours','required');
		$this->form_validation->set_rules('nom','nom parcours','required');
		$this->form_validation->set_rules('mention','mention ','required');
		
		if ($this->form_validation->run() == false) {
			$this->load->view('add_parcours');
		} else {
			$formArray = array();
			$formArray['CodeParcours']=$this->input->post('code');
			$formArray['NomParcours']=$this->input->post('nom');
			$formArray['IDMention']=$this->input->post('mention');
			$this->emploies_model->parcours($formArray);
			$this->session->set_flashdata('success', 'Ajout avec succes');
			redirect(base_url().'index.php/emploie/parcours');
		}
	
	}
	function editparcours ($parcoursId){
		$this->load->model('emploies_model');
		$parcours = $this->emploies_model->getparcours($parcoursId);
		$data = array();
		$data['parcours'] = $parcours;
		$this->form_validation->set_rules('code','Code parcours','required');
		$this->form_validation->set_rules('nom','nom parcours','required');
		$this->form_validation->set_rules('mention','mention','required');

		if ($this->form_validation->run() == false) {
			$this->load->view('modif_parcours',$data);
		} else {
			$formArray = array();
			$formArray['CodeParcours'] = $this->input->post('code');
			$formArray['NomParcours'] = $this->input->post('nom');
			$formArray['IDMention'] = $this->input->post('mention');
			$this->emploies_model->modifparcours($parcoursId, $formArray);
			$this->session->set_flashdata('success', 'Modification avec succes');
			redirect(base_url().'index.php/emploie/parcours');
		}
		
	}
	///////////////////CRUD ETUDIANT/////////
	public function etudiant(){
		$this->load->model('emploies_model');
		$etudiant = $this->emploies_model->etudiantAll();
		$data = array();
		$data['etudiant'] = $etudiant;
		//$data['mention']=$parcours;
		$this->load->view('etudiant',$data);
	}
	///////////////////////////

	function editDemande ($demandeId){
		$this->load->model('emploies_model');
		$demande = $this->emploies_model->getDemande($demandeId);
		$conge = $this->emploies_model->AllConge();
		$dem = $this->emploies_model->Alldem();
		$data = array();
		$data['conge'] = $conge;
		$data['emplo'] = $dem;
		$data['demande'] = $demande;

		$this->form_validation->set_rules('matricule','Matricule','required');
		$this->form_validation->set_rules('codeconge','code conge','required');
		$this->form_validation->set_rules('datedebut','Date Debut','required');
		$this->form_validation->set_rules('daterep','Date Reprendre','required');

		if ($this->form_validation->run() == false) {
			$this->load->view('edit_demande',$data);
		} else {
			$formArray = array();
			$formArray['MATRICULE']=$this->input->post('matricule');
			$formArray['CODECONGE']=$this->input->post('codeconge');
			$formArray['DATEDEBUT']=$this->input->post('datedebut');
			$formArray['DATEREPRENDRE']=$this->input->post('daterep');
			$this->emploies_model->modifDemande($demandeId, $formArray);
			$this->session->set_flashdata('success', 'Modification avec succes');
			redirect(base_url().'index.php/emploie/demande');
		}
		
	}
	public function addetudiant(){
		//$this->load->model('emploies_model');
		//$this->form_validation->set_rules('code','Code parcours','required');
		//$this->form_validation->set_rules('nom','nom parcours','required');
		//$this->form_validation->set_rules('mention','mention ','required');
		
		//if ($this->form_validation->run() == false) {
			//$this->load->view('add_etudiant');
		//} else {
		/*	$formArray = array();
			$formArray['CodeParcours']=$this->input->post('code');
			$formArray['NomParcours']=$this->input->post('nom');
			$formArray['IDMention']=$this->input->post('mention');
			$this->emploies_model->parcours($formArray);
			$this->session->set_flashdata('success', 'Ajout avec succes');
			redirect(base_url().'index.php/emploie/parcours');
		}*/
	
	}
	function deleteparcours($parcoursId){
		$this->load->model('emploies_model');
		$mention = $this->emploies_model->getparcours($parcoursId);
		if(empty($parcoursId)){
			$this->session->set_flashdata('failure', 'error');
			redirect(base_url().'index.php/emploie/index');
		}
		$this->emploies_model->deleteparcours($parcoursId);
		$this->session->set_flashdata('Success', 'mention Supprimer');
		redirect(base_url().'index.php/emploie/parcours');
		
	}

	function deleteDemande($demandeId){
		$this->load->model('emploies_model');
		$conge = $this->emploies_model->getDemande($demandeId);
		if(empty($demandeId)){
			$this->session->set_flashdata('failure', 'error');
			redirect(base_url().'index.php/emploie/demande');
		}
		$this->emploies_model->deleteDemande($demandeId);
		$this->session->set_flashdata('Success', 'Emploie Supprimer');
		redirect(base_url().'index.php/emploie/demande');
		
	}

	function editEmplo($emploId){
		$this->load->model('emploies_model');
		$emplo = $this->emploies_model->getEmplo($emploId);
		$data['emplo'] = $emplo;
		
		
		$this->load->view('edit_employeur',$data);

		$this->form_validation->set_rules('matricule','Matricule','required');
		$this->form_validation->set_rules('codeservice','Code Service','required');
		$this->form_validation->set_rules('codeemploie','Code Emploie','required');
		$this->form_validation->set_rules('dateentrer','Date Entrer','required');
		$this->form_validation->set_rules('nom','Nom','required');
		$this->form_validation->set_rules('prenom','Prenom','required');
		$this->form_validation->set_rules('sexe','Sexe','required');
		$this->form_validation->set_rules('tel','Telephone','required');
		
		if ($this->form_validation->run() == false) {
			
		} else {
			$formArray = array();
			$formArray['MATRICULE']=$this->input->post('matricule');
			$formArray['CODESERVICE']=$this->input->post('codeservice');
			$formArray['CODEEMPLOIS']=$this->input->post('codeemploie');
			$formArray['DATEENTRE']=$this->input->post('dateentrer');
			$formArray['NOM']=$this->input->post('nom');
			$formArray['PRENOM']=$this->input->post('prenom');
			$formArray['sexe']=$this->input->post('sexe');
			$formArray['TELEPHONE']=$this->input->post('tel');
			$this->emploies_model->modifEmplo($emploId, $formArray);
			$this->session->set_flashdata('success', 'Ajout avec succes');
			redirect(base_url().'index.php/emploie/emploindex');
		}
		
	}
	function deleteEmplo($emploId){
		$this->load->model('emploies_model');
		$emplo = $this->emploies_model->getEmplo($emploId);
		if(empty($emploId)){
			$this->session->set_flashdata('failure', 'error');
			redirect(base_url().'index.php/emploie/emploindex');
		}
		$this->emploies_model->deleteEmplo($emploId);
		$this->session->set_flashdata('Success', 'Emploie Supprimer');
		redirect(base_url().'index.php/emploie/emploindex');
		
	}

	
}