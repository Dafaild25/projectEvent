<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Partys extends CI_Controller {

    public function __construct() {
        parent::__construct();
       
        $this->load->model('Party'); // Asegúrate de tener el modelo cargado
        $this->load->helper('url');
    }

    // Página principal para listar 
    public function partyPage() {
        $data['partys'] = $this->Party->getAllParty(); // Obtiene todos los autores
        $this->load->view('header');
        $this->load->view('Partys/partyPage',$data);
        $this->load->view('footer');
    }

	//ahora para guardar 
	public function save() {
        $partyData = array(
            'name' => $this->input->post('name'),
            'start_date' => $this->input->post('start_date'),
            'location' => $this->input->post('location'),
			'description' => $this->input->post('description')
            
        );

        if ($this->Party->insertParty($partyData)) {
            redirect('Partys/partyPage');
        } else {
            echo "Error: Room could not be saved.";
        }
    }

	public function selectParty($id) {
        $data['party'] = $this->Party->getPartyById($id); 
		if (isset($data['party']->start_date)) {
			$data['party']->start_date = date('Y-m-d', strtotime($data['party']->start_date));
		}
        $data['partys'] = $this->Party->getAllParty(); 
        $this->load->view('header');
        $this->load->view('Partys/partyPage',$data);
        $this->load->view('footer');
    }

	public function update() {
        $id = $this->input->post('id');
        $partyData = array(
			
			'name' => $this->input->post('name'),
            'start_date' => $this->input->post('start_date'),
            'location' => $this->input->post('location'),
			'description' => $this->input->post('description')
            
        );

        if ($this->Party->updateParty($id, $partyData)) {
            redirect('Partys/partyPage');
        } else {
            echo "Error: Room could not be updated.";
        }
    }

	public function delete($id) {
		// Verificar si la fiesta está relacionada con algún registro
		if ($this->Party->isPartyRelated($id)) {
			// Si está relacionada con algún registro, redirigir con mensaje de error
			
			redirect('Partys/partyPage');
			return;
		}
	
		// Si no está relacionada, proceder con la eliminación
		if ($this->Party->deleteParty($id)) {
			echo "Error: Exit.";
		} else {
			echo "Error: Party could not be updated.";
		}
	
		// Redirigir después de la operación
		redirect('Partys/partyPage');
	}

    
    
    
    
    
    
}

