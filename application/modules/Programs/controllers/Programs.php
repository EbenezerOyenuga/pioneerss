<?php

class Programs extends MY_Controller{

    function __construct()
    {
        parent::__construct();
        $this->load->model("M_Requirements");
    }


    function get_program($program_id)
    {
        $this->load->model('M_Programs');
        $prog = $this->M_Programs->get_program($program_id);

        if (count($prog) > 0) {
            foreach ($prog as $key => $value)
                $program = $value->PROGRAM;
        }
        return $program;
    }


    function create_select_program(){

        $this->load->model('M_Programs');

            $programs = $this->M_Programs->get_programs();
            $select_programs= "";
            foreach ($programs as $key => $value) {

                $select_programs .= "<option value = '{$value->program_id}'> {$value->program}</option>";

            }



        return $select_programs;

    }


}
