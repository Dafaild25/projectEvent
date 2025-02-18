<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registrations extends CI_Controller {

    public function __construct() {
        parent::__construct();
		$this->load->model('Party');
       	$this->load->model('Asistent');
        $this->load->model('Registration'); // Asegúrate de tener el modelo cargado
		$this->load->library('session');
        $this->load->helper('url');
    }

    // Página principal para listar 
    public function registrationPage() {
        $data['registrations'] = $this->Registration->getAllRegistration(); 
        $data['asistents'] = $this->Asistent->getAllAsistent(); 
        $data['partys'] = $this->Party->getAllParty(); 
        $this->load->view('header');
        $this->load->view('Registrations/registrationPage',$data);
        $this->load->view('footer');
    }

	//ahora para guardar 
	public function save() {
		// Obtener los valores del formulario
		$asistent_id = $this->input->post('asistent_id');
		$party_id = $this->input->post('party_id');
	
		// Validar si los campos están vacíos
		if (empty($asistent_id) || empty($party_id)) {
			// Mostrar un mensaje de error o redirigir con un mensaje de error
			$this->session->set_flashdata('error', 'Please select both Asistent and Event.');
			redirect('Registrations/registrationPage');
			return;
		}
	
		// Preparar los datos para guardar
		$registrationData = array(
			'asistent_id' => $asistent_id,
			'party_id' => $party_id,
		);
	
		// Intentar guardar los datos
		if ($this->Registration->insertRegistration($registrationData)) {
			redirect('Registrations/registrationPage');
		} else {
			echo "Error: Room could not be saved.";
		}
	}

	public function selectRegistration($id) {
        $data['registration'] = $this->Registration->getRegistrationById($id); 
		$data['asistents'] = $this->Asistent->getAllAsistent(); 
        $data['partys'] = $this->Party->getAllParty(); 
        $data['registrations'] = $this->Registration->getAllRegistration(); 
        $this->load->view('header');
        $this->load->view('Registrations/registrationPage',$data);
        $this->load->view('footer');
    }

	public function update() {
        $id = $this->input->post('id');
        $registrationData = array(
			
			'asistent_id' => $this->input->post('asistent_id'),
            'party_id' => $this->input->post('party_id'),
            
        );

        if ($this->Registration->updateRegistration($id, $registrationData)) {
            redirect('Registrations/registrationPage');
        } else {
            echo "Error: Room could not be updated.";
        }
    }

	public function delete($id) {
		
	
		// Si no está relacionada, proceder con la eliminación
		if ($this->Registration->deleteRegistration($id)) {
			echo "Error: Exit.";
		} else {
			echo "Error: Registrartioncould not be updated.";
		}
	
		// Redirigir después de la operación
		redirect('Registrations/registrationPage');
	}

    
    
    
    
    
    
}

