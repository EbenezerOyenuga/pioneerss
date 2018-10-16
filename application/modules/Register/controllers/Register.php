<?php

class Register extends MY_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->module(['Programs', 'Residence', 'ActionUnit']);
        $this->load->model(['M_Login', 'M_Students']);
    }
    function index(){

        $this->session->sess_destroy();
        $data['program'] = $this->programs->create_select_program();
        $data['residence'] = $this->residence->create_select_residence();
        $data['months'] = $this->create_select_months();
        $data['action_units'] = $this->actionunit->create_radio_action_units();

        $this->load->view('register_v', $data);
    }


    function create_select_months(){

            $month = $this->M_Students->get_months();
            $months = "";
            foreach ($month as $key => $value) {

                $months .= "<option value = '{$value->month_id}'> {$value->month}</option>";

            }


        return $months;
    }

    function store(){
        // load form validation library
        $this->load->library('form_validation');
        $this->load->model('M_Students');
        //rules for registration

        $this->form_validation->set_rules('matricno', 'Matriculation Number', 'trim|required|is_unique[students.matricno]');
        $this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');

        $this->form_validation->set_rules('other_names', 'Other Names', 'trim|required|min_length[3]|max_length[20]');
        $this->form_validation->set_rules('surname', 'Surname', 'trim|required|min_length[3]|max_length[20]');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|min_length[3]|max_length[20]');
        $this->form_validation->set_rules('program', 'Programs', 'required');
        $this->form_validation->set_rules('residence', 'Residence', 'required');
        $this->form_validation->set_rules('action_units', 'Action Unit', 'required');
        $this->form_validation->set_rules('birthmonth', 'Birthmonth', 'required');
        $this->form_validation->set_rules('birthday', 'Birthday', 'required');

        // if validation fails
        if ($this->form_validation->run() == FALSE){
            $this->load->module('Admintemplate');
            $this->index();

        }
        //if validation succeeds
        else{

                //gets id and saves users registration information

                    $this->M_Students->add_student();
                    $this->session->set_flashdata('success', 'Your registeration was successfull');

        //redirects to the users page to view the added user
        redirect(base_url().'');
        }
    }


}
