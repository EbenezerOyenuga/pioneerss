<?php

class Residence extends MY_Controller{

    function __construct()
    {
        parent::__construct();
        $this->load->module(["GradeResidence", "ResidenceResubmission", "ResidenceTemplate"]);
        $this->load->model('M_Residence');
    }

    function get_residence($residence_id)
    {
        $resi = $this->M_Residence->get_residence_name($residence_id);

        if (count($resi) > 0) {
            foreach ($resi as $key => $value)
                $residence = $value->RESIDENCE_NAME;
        }
        return $residence;
    }

    function create_select_residence(){

            $residence = $this->M_Residence->get_residence();
            $residences = "";
            foreach ($residence as $key => $value) {

                $residences .= "<option value = '{$value->residence_id}' onchange= 'change_gender()' name = 'residencedd' id= 'residencedd'> {$value->residence}</option>";

            }


        return $residences;
    }

}
