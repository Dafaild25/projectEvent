<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asistents extends CI_Controller {

    public function __construct() {
        parent::__construct();
       
        $this->load->model('Asistent'); // Asegúrate de tener el modelo cargado
        $this->load->helper('url');
    }

    // Página principal para listar 
    public function asistentPage() {
        $data['asistents'] = $this->Asistent->getAllAsistent(); // Obtiene todos los autores
        $this->load->view('header');
        $this->load->view('Asistents/asistentPage',$data);
        $this->load->view('footer');
    }

	//ahora para guardar 
	public function save() {
        $asistentData = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'email' => $this->input->post('email'),
			'phone' => $this->input->post('phone')
            
        );

        if ($this->Asistent->insertAsistent($asistentData)) {
            redirect('Asistents/asistentPage');
        } else {
            echo "Error: Room could not be saved.";
        }
    }

	public function selectAsistent($id) {
        $data['asistent'] = $this->Asistent->getAsistentById($id); 
		
        $data['asistents'] = $this->Asistent->getAllAsistent(); 
        $this->load->view('header');
        $this->load->view('Asistents/asistentPage',$data);
        $this->load->view('footer');
    }

	public function update() {
        $id = $this->input->post('id');
        $asistentData = array(
			
			'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'email' => $this->input->post('email'),
			'phone' => $this->input->post('phone')
            
        );

        if ($this->Asistent->updateAsistent($id, $asistentData)) {
            redirect('Asistents/asistentPage');
        } else {
            echo "Error: Room could not be updated.";
        }
    }

	public function delete($id) {
		// Verificar si la fiesta está relacionada con algún registro
		if ($this->Asistent->isAsistentRelated($id)) {
			// Si está relacionada con algún registro, redirigir con mensaje de error
			
			redirect('Asistents/asistentPage');
			return;
		}
	
		// Si no está relacionada, proceder con la eliminación
		if ($this->Asistent->deleteAsistent($id)) {
			echo "Error: Exit.";
		} else {
			echo "Error: Party could not be updated.";
		}
	
		// Redirigir después de la operación
		redirect('Asistents/asistentPage');
	}

    
    
    
    
    
    
}

