<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database(); // Asegúrate de tener configurada tu base de datos en `application/config/database.php`
    }

    // Obtener todos los autores
    public function getAllRegistration() {
        $query = $this->db->get('registration'); // Asegúrate de que tu tabla se llame 'authors'
        return $query->result();
    }

     // Insertar un nuevo autor
     public function insertRegistration($data) {
        return $this->db->insert('registration', $data);
    }

    // Obtener un autor por ID
    public function getRegistrationById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('registration');
        return $query->row();
    }

    // Actualizar un autor
    public function updateRegistration($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('registration', $data);
    }

    // Eliminar un autor
    public function deleteRegistration($id) {
        $this->db->where('id', $id);
        return $this->db->delete('registration');
    }

    // Verificar si una Room está relacionada con registros en la tabla `collection`
    // public function isAsistentRelated($id) {
	// 	$this->db->where('asistent_id', $id); // Verifica si hay registros con el `party_id` en `Registration`
	// 	$query = $this->db->get('Registration');
	// 	return $query->num_rows() > 0; // Devuelve true si hay registros relacionados
	// }
}
