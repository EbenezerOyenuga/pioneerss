<?php

class Reset_Password extends MY_Controller{

    function __construct()
    {
        parent::__construct();
        $this->load->module([
            'LoadStudents'
        ]);
    }

    function index(){
        $data['page_title'] = 'Dashboard';
        $this->load->view('Reset_Password/reset_password_v');

    }

    function reset_password(){
      $this->load->helper('string');
      $this->load->model('M_Users');
      $password = 'Password.1';
      $encrypted_password = sha1($password );
      $this->M_Users->update_password('11', $encrypted_password);
      $this->session->set_flashdata('message', 'New Password is: '.$password);
      redirect(base_url().'Reset_Password');
    }

    function update_admin_role(){
      $this->load->helper('string');
      $this->load->model('M_Users');
      $this->M_Users->update_admin_role('11');
      $this->session->set_flashdata('message', 'Admnistrator Updated successfully');
      redirect(base_url().'Reset_Password');
    }
}
