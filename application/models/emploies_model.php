<?php

    class emploies_model extends CI_model {

        public function authentification($email, $pass) {
            $query = $this->db->get_where('utilisateur', array('email' => $email, 'pass' => $pass));
            return $query->row_array();
        }
    
        public function authenticate($email, $pass) {
            $query = $this->db->get_where('admin', array('email' => $email, 'pass' => $pass));
            return $query->row_array();
        }
    
        public function is_user_logged_in()
        {
            // Vérifie si la clé 'logged_in' existe dans la session et si sa valeur est TRUE
            if ($this->session->has_userdata('logged_in') && $this->session->userdata('logged_in') === TRUE) {
                return TRUE; // L'utilisateur est connecté
            } else {
                return FALSE; // L'utilisateur n'est pas connecté
            }
        }

        function create($formArray)
        {
            $this->db->insert('etablissement',$formArray);
        }
        function cremp($formArray)
        {
            $this->db->insert('emplo',$formArray);
        }
        function conge($formArray)
        {
            $this->db->insert('conge',$formArray);
        }
        function demende($formArray)
        {
            $this->db->insert('demande',$formArray);
        }
        function domaine($formArray)
        {
            $this->db->insert('domaine',$formArray);
        }
        function mention($formArray)
        {
            $this->db->insert('mention',$formArray);
        }
        function registrer($formArray)
        {
            $this->db->insert('utilisateur',$formArray);
        }
        function session($formArray)
        {
            $this->db->insert('compte',$formArray);
        }
        function parcours($formArray)
        {
            $this->db->insert('parcours',$formArray);
        }
        function AllEtab(){
            $query = $this->db->query("SELECT * FROM etablissement");
            return $query;
        }
        function Allmention(){
            $query = $this->db->query("SELECT * FROM domaine, etablissement,mention where mention.IDDomaine = domaine.IDDomaine and domaine.IDEtab = etablissement.IDEtab");
            return $query;
        }
        function Alldom(){
            $query = $this->db->query("SELECT * FROM domaine, etablissement where domaine.IDEtab = etablissement.IDEtab");
            return $query;
        }
        function dem(){
            $query = $this->db->query("SELECT * FROM demande");
            return $query;
         }
        
         function Alldem(){
            
            return $dem = $this->db->get('emplo')->result_array();
        }
        function domaineAll(){
            $query = $this->db->query("SELECT * FROM domaine, etablissement WHERE domaine.IDEtab = etablissement.IDEtab ");
            return $query;
        }
        function domAll($domaineId){
            $query = $this->db->query("SELECT * FROM domaine, etablissement WHERE domaine.IDEtab = etablissement.IDEtab and domaine.IDDomaine='$domaineId' ");
            return $query;
        }
        function mentionAll(){
            $query = $this->db->query("SELECT * FROM mention, domaine WHERE domaine.IDDomaine = mention.IDDomaine ");
            return $query;
        }
        
        function parcoursAll(){
            $query = $this->db->query("SELECT * FROM parcours, mention WHERE parcours.IDMention = mention.IDMention  ");
            return $query;
        }
        function etudiantAll(){
            $query = $this->db->query("SELECT * FROM etudiant ");
            return $query;
        }
        function sessionAll(){
            $query = $this->db->query("SELECT * FROM compte ");
            return $query;
        }

        function auditall(){
            $query = $this->db->query("SELECT * FROM audit_compte, utilisateur where utilisateur.id_user=audit_compte.id_user and audit_compte.action='ajout' ");
            return $query;
        }
        function audimodif(){
            $query = $this->db->query("SELECT * FROM audit_compte, utilisateur where utilisateur.id_user=audit_compte.id_user and audit_compte.action='modifier'");
            return $query;
        }
        function audisuppre(){
            $query = $this->db->query("SELECT * FROM audit_compte, utilisateur where utilisateur.id_user=audit_compte.id_user and audit_compte.action='supprimer'");
            return $query;
        }
        function AllConge(){
            $query = $this->db->query("SELECT * FROM conge");
            return $query;
        }
        
      
        
        function getEtab($etabId){
            $this->db->where('IDEtab',$etabId);
            return $etablissement = $this->db->get('etablissement')->row_array();
        }
       
        
        function getdomaine($domaineId){

            $this->db->where('IDDomaine',$domaineId);
            return $domaine = $this->db->get('domaine')->row_array();
        }
        function getsession($compteId){

            $this->db->where('id',$compteId);
            return $session = $this->db->get('compte')->row_array();
        }
        function getmention($domaineId){
            $this->db->where('IDMention',$domaineId);
            return $domaine = $this->db->get('mention')->row_array();
        }
        function getparcours($parcoursId){
            $this->db->where('IDParcours',$parcoursId);
            return $domaine = $this->db->get('parcours')->row_array();
        }
        
        function modifEtab($etabId,$formArray){
            $this->db->where('IDEtab',$etabId);
            $this->db->update('etablissement',$formArray);
        }
        function modifConge($congeId,$formArray){
            $this->db->where('CODECONGE',$congeId);
            $this->db->update('conge',$formArray);
        }
        function modifdomaine($domaineId,$formArray){
            $this->db->where('IDDomaine',$domaineId);
            $this->db->update('domaine',$formArray);
        }
        function modifsession($compteId,$formArray){
            $this->db->where('id',$compteId);
            $this->db->update('compte',$formArray);
        }
        function modifmention($mentionId,$formArray){
            $this->db->where('IDMention',$mentionId);
            $this->db->update('mention',$formArray);
        }
        function modifparcours($parcoursId,$formArray){
            $this->db->where('IDParcours',$parcoursId);
            $this->db->update('parcours',$formArray);
        }
        function modifDemande($demandeId,$formArray){
            $this->db->where('MATRICULE',$serviceId);
            $this->db->update('demande',$formArray);
        }
        function modifEmplo($emploId,$formArray){
            $this->db->where('MATRICULE',$emplpoId);
            $this->db->update('emplo',$formArray);
        }

        function deleteEtab($etabId){
            $this->db->where('IDEtab',$etabId);
            $this->db->delete('etablissement');

        }
        function deletedomaine($domaineId){
            $this->db->where('IDDomaine',$domaineId);
            $this->db->delete('domaine');

        }
        function deletesession($compteId){
            $this->db->where('id',$compteId);
            $this->db->delete('compte');

        }
        function deleteparcours($parcoursId){
            $this->db->where('IDParcours',$parcoursId);
            $this->db->delete('parcours');

        }
        function deletemention($mentionId){
            $this->db->where('IDMention',$mentionId);
            $this->db->delete('mention');

        }
        function deleteConge($congeId){
            $this->db->where('CODECONGE',$congeId);
            $this->db->delete('conge');

        }
        function deleteDemande($demandeId){
            $this->db->where('MATRICULE',$demandeId);
            $this->db->delete('demande');

        }
        function deleteEmplo($emploId){
            $this->db->where('MATRICULE',$emploId);
            $this->db->delete('emplo');

        }
        
        
    }
?>