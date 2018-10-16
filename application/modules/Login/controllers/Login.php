<?php

class Login extends MY_Controller{
    function __construct()
    {
        parent::__construct();

        $this->load->model("M_Login");
    }
    function index(){

        $this->load->view('login_v');
    }



    function sign_in(){

        $this->load->library('form_validation');

        //rules for registration

        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        // if validation fails
        if ($this->form_validation->run() == FALSE){
            $this->load->module('Admintemplate');
            $this->index();

        }
        //if validation succeeds
        else{


        if ($this->input->post()){

            $user_id = $this->M_Login->get_userid($this->input->post('username'));
            foreach ($user_id as $key => $value) {
                $userid = ($value->login_id);
            }


            if (isset($userid)) {
                $user_activated = $this->M_Login->confirm_user_status($userid);
                if (count($user_activated) == 1) {
                    $password = sha1($this->input->post('password'));

                    $userdetails = $this->M_Login->confirm_user_password($userid, $password);
                    if (count($userdetails) == 1) {

                        foreach ($userdetails as $key => $value) {
                            // Redirect to residence page

                                $this->session->set_userdata(array(
                                    'user_id' => $value->LOGIN_ID,
                                    'username' => $value->username,
                                    'loggedin' => 1
                                ));

                                redirect(base_url() . 'Admin/action_unit');
                             // Redirect to residence page

                }

            }
            else{
                $this->session->set_flashdata('message', 'Incorrect Password.');
                redirect(base_url().'Login');
            }
        }
        else{
            $this->session->set_flashdata('message', 'You have been deactivated. See the Administrator to activate your account');
            redirect(base_url().'Login');
        }
        }
        else{
            $this->session->set_flashdata('message', 'Incorrect Username.');
            redirect(base_url().'Login');
        }
      }
    }
    }


    function sign_out(){
        $this->session->sess_destroy();
        redirect(base_url().'Login');
    }
}
