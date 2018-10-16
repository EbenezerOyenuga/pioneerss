<?php

class Departments extends MY_Controller{

    function __construct()
    {
        parent::__construct();

    }

    function load_departments()
    {
        $this->load->model('M_Departments');

            //require_once('./umis_api/soap_client.php');
        $this->load->module("UmisCall");

            $grades = $this->umiscall->load_api("getDepartments");
            //print_r($grades);
            foreach ($grades->transfer->record as $records) {

                        if(count($this->M_Departments->dept_exist((string) $records['item']))<=0)
                            $this->M_Departments->load_department((string) $records->schoolid, (string) $records['item'], (string) $records->departmentname);

            }

    }

}