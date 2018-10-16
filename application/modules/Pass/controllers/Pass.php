<?php

/**
 * Created by PhpStorm.
 * User: ebene
 * Date: 12/1/2016
 * Time: 6:39 AM
 */
class Pass extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("M_Pass");
    }

    function display_pass(){

        $data = $this->get_data_from_post();

       if ($data['passmark_chapel'] == '')
        {
            $data = $this->get_passmarks();
        }

        $data['passmark_title'] = 'Update Pass Mark';
        $data['page_title'] = 'Update Weights and Pass Marks';
        $data['content_view'] = 'Pass/pass_display_v';
        $this->admintemplate->call_admin_template($data);

    }

    function get_data_from_post(){

        $data['passmark_chapel'] = $this->input->post('passmark_chapel', TRUE);
        $data['passmark_residence'] = $this->input->post('passmark_residence', TRUE);
        $data['passmark_worship'] = $this->input->post('passmark_worship', TRUE);
        return $data;
    }

    function update_passmarks(){
        // load form validation library
        $this->load->library('form_validation');

        //rules for registration

        $this->form_validation->set_rules('passmark_chapel', 'Chapel Seminar Pass Mark', 'trim|required|min_length[1]|max_length[2]|is_natural_no_zero');
        $this->form_validation->set_rules('passmark_residence', 'Residence Pass Mark', 'trim|required|min_length[1]|max_length[2]|is_natural_no_zero');
        $this->form_validation->set_rules('passmark_worship', 'Worship Pass Mark', 'trim|required|min_length[1]|max_length[2]|is_natural_no_zero');

        // if validation fails
        if ($this->form_validation->run() == FALSE){
            $this->load->module('Admintemplate');
            $this->display_pass();

        }
        //if validation succeeds
        else{
            //gets id and saves users registration information
            $id = $this->M_Pass->update_passmarks();

            //redirects to the users page to view the added user
            redirect(base_url().'Admin/pass');
        }
    }


    function get_passmarks(){
        $pass = $this->M_Pass->get_passmarks();
        if (count($pass)>0){
            foreach ($pass as $key => $value) {

                    $data['passmark_chapel'] = "{$value->ATTRI1}";
                    $data['passmark_residence'] = "{$value->ATTRI2}";
                    $data['passmark_worship'] = "{$value->ATTRI3}";

            }

        }
        return $data;
    }
}