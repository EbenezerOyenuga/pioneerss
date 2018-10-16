<?php

class Admintemplate extends MY_Controller{
    function __construct()
    {
        parent::__construct();
    }
    function call_admin_template($data = NULL){
        //call login template
        $this->load->view('admin_template_v', $data);
    }
}
