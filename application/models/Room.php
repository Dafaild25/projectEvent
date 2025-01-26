<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Room extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database(); // Asegúrate de tener configurada tu base de datos en `application/config/database.php`
    }

    // Obtener todos los autores
    public function getAllRooms() {
        $query = $this->db->get('room'); // Asegúrate de que tu tabla se llame 'authors'
        return $query->result();
    }

     // Insertar un nuevo autor
     public function insertRoom($data) {
        return $this->db->insert('room', $data);
    }

    // Obtener un autor por ID
    public function getRoomById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('room');
        return $query->row();
    }

    // Actualizar un autor
    public function updateRoom($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('room', $data);
    }

    // Eliminar un autor
    public function deleteRoom($id) {
        $this->db->where('id', $id);
        return $this->db->delete('room');
    }

    // Verificar si una Room está relacionada con registros en la tabla `collection`
    public function isRoomRelated($id) {
        $this->db->where('room_id', $id); // Cambia `room_id` al nombre de la columna que relaciona con la tabla `room`
        $query = $this->db->get('collection'); // Asegúrate de que `collection` es el nombre correcto de la tabla
        return $query->num_rows() > 0; // Devuelve true si hay registros relacionados
    }
    
}
