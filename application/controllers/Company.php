<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Company';

		$this->load->model('model_company');
	}

    /* 
    * It redirects to the company page and displays all the company information
    * It also updates the company information into the database if the 
    * validation for each input field is successfully valid
    */
	public function index()
	{  
        if(!in_array('updateCompany', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
		$this->form_validation->set_rules('company_name', 'Company name', 'trim|required');
		$this->form_validation->set_rules('service_charge_value', 'Charge Amount', 'trim|integer');
		$this->form_validation->set_rules('vat_charge_value', 'GST Charge', 'trim|integer');
		$this->form_validation->set_rules('address', 'Address', 'trim|required');
		//$this->form_validation->set_rules('message', 'Message', 'trim|required');
	
	
        if ($this->form_validation->run() == TRUE) {
            // true case

        	$data = array(
                'company_name' => $this->input->post('company_name'),
        		'gstin' => $this->input->post('gstin'),
        		'service_charge_value' => '',
        		'vat_charge_value' => $this->input->post('vat_charge_value'),
        		'address' => $this->input->post('address'),
        		'phone' => $this->input->post('phone'),
                'country' => $this->input->post('country'),
                'state' => $this->input->post('state'),
        		'message' => $this->input->post('message'),
                'currency' => ''
        	);
            if(!empty($_FILES['company_logo']['name'])){
                $data['logo'] = $_FILES['company_logo']['name'];
                $field_name = "company_logo";
                $this->upload($field_name);
            }if(!empty($_FILES['company_sm_logo']['name'])){
                $data['sm_logo'] = $_FILES['company_sm_logo']['name'];
                $field_name = "company_sm_logo";
                $this->upload($field_name);
            }

            
            //echo "<pre>"; print_r($data); die;
            $company=$this->model_company->getCompanyData(1);
            if($company == true){
                $update = $this->model_company->update($data, 1);
            }else{
                $update = $this->model_company->create($data);
            }
        	
        	if($update == true) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('company/', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('company/index', 'refresh');
        	}
        }
        else {

            // false case
            
            
            $this->data['currency_symbols'] = $this->currency();
        	$this->data['company_data'] = $this->model_company->getCompanyData(1);
			$this->render_template('company/index', $this->data);			
        }	

		
	}

    public function upload($file) {
        $config['upload_path'] = './assets/images/';
        $config['allowed_types'] = 'gif|jpg|png';
        /*$config['max_size'] = 2000;
        $config['max_width'] = 1500;
        $config['max_height'] = 1500;*/

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($file)) {
            $error = array('error' => $this->upload->display_errors()); die;

        } else {
            $data = array('image_metadata' => $this->upload->data());
        }
    }


}