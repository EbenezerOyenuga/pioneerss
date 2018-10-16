<?php

class Schools extends MY_Controller{

    function __construct()
    {
        parent::__construct();

    }

    function load_schools()
    {
        $this->load->model('M_Schools');
        $this->load->module("UmisCall");

           // require_once('./umis_api/soap_client.php');

            $grades = $this->umiscall->load_api("getSchools");
            //print_r($grades);
            foreach ($grades->transfer->record as $records) {

                        if(count($this->M_Schools->school_exist((string) $records['item']))<=0)
                            $this->M_Schools->load_school((string) $records['item'], (string) $records->schoolname);

            }


    }

}