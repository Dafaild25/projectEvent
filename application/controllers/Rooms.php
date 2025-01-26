<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rooms extends CI_Controller {

    public function __construct() {
        parent::__construct();
       
        $this->load->model('Room'); // Asegúrate de tener el modelo cargado
        $this->load->helper('url');
    }

    // Página principal para listar 
    public function rooms() {
        $data['rooms'] = $this->Room->getAllRooms(); // Obtiene todos los autores
        $this->load->view('header');
        $this->load->view('Rooms/rooms',$data);
        $this->load->view('footer');
    }

    // Guardar un nuevo 
    public function save() {
        $roomData = array(
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
            
        );

        if ($this->Room->insertRoom($roomData)) {
            redirect('Rooms/rooms');
        } else {
            echo "Error: Room could not be saved.";
        }
    }

    // Cargar datos para edición
    public function edit($id) {
        $data['room'] = $this->Room->getRoomById($id); // Obtiene datos del autor por ID
        $data['rooms'] = $this->Room->getAllRooms(); // Obtiene todos los autores
        $this->load->view('header');
        $this->load->view('Rooms/rooms',$data);
        $this->load->view('footer');
    }

    // Actualizar un autor existente
    public function update() {
        $id = $this->input->post('id');
        $roomData = array(
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
            
        );

        if ($this->Room->updateRoom($id, $roomData)) {
            redirect('Rooms/rooms');
        } else {
            echo "Error: Room could not be updated.";
        }
    }

    public function delete($id) {
        if ($this->input->is_ajax_request()) {
            if ($this->Room->isRoomRelated($id)) {
                // If the room is related, return an error response
                echo json_encode([
                    'status' => 'error',
                    'message' => 'The room cannot be deleted because it is related to other records.'
                ]);
                return;
            }
    
            if ($this->Room->deleteRoom($id)) {
                // If deletion was successful
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Room successfully deleted.'
                ]);
            } else {
                // If there was an error during deletion
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Error: The room could not be deleted.'
                ]);
            }
            return;
        }
    
        // If it's not an AJAX request, redirect
        redirect('Rooms/rooms');
    }
    
    
    
    
    
}

