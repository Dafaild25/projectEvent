<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Party extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database(); // Asegúrate de tener configurada tu base de datos en `application/config/database.php`
    }

    // Obtener todos los autores
    public function getAllParty() {
        $query = $this->db->get('party'); // Asegúrate de que tu tabla se llame 'authors'
        return $query->result();
    }

     // Insertar un nuevo autor
     public function insertParty($data) {
        return $this->db->insert('party', $data);
    }

    // Obtener un autor por ID
    public function getPartyById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('party');
        return $query->row();
    }

    // Actualizar un autor
    public function updateParty($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('party', $data);
    }

    // Eliminar un autor
    public function deleteParty($id) {
        $this->db->where('id', $id);
        return $this->db->delete('party');
    }

    // Verificar si una Room está relacionada con registros en la tabla `collection`
    public function isPartyRelated($id) {
		$this->db->where('party_id', $id); // Verifica si hay registros con el `party_id` en `Registration`
		$query = $this->db->get('Registration');
		return $query->num_rows() > 0; // Devuelve true si hay registros relacionados
	}
}
