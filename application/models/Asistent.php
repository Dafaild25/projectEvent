<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asistent extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database(); // Asegúrate de tener configurada tu base de datos en `application/config/database.php`
    }

    // Obtener todos los autores
    public function getAllAsistent() {
        $query = $this->db->get('asistent'); // Asegúrate de que tu tabla se llame 'authors'
        return $query->result();
    }

     // Insertar un nuevo autor
     public function insertAsistent($data) {
        return $this->db->insert('asistent', $data);
    }

    // Obtener un autor por ID
    public function getAsistentById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('asistent');
        return $query->row();
    }

    // Actualizar un autor
    public function updateAsistent($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('asistent', $data);
    }

    // Eliminar un autor
    public function deleteAsistent($id) {
        $this->db->where('id', $id);
        return $this->db->delete('asistent');
    }

    // Verificar si una Room está relacionada con registros en la tabla `collection`
    public function isAsistentRelated($id) {
		$this->db->where('asistent_id', $id); // Verifica si hay registros con el `party_id` en `Registration`
		$query = $this->db->get('Registration');
		return $query->num_rows() > 0; // Devuelve true si hay registros relacionados
	}
}
