<?php

/**
 * Created by PhpStorm.
 * User: ebene
 * Date: 12/1/2016
 * Time: 12:37 PM
 */
class M_Departments extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function load_department($school_id, $dept_id, $dept_name){

        $posted_data = array(
            'DEPARTMENT_ID' => $dept_id,
            'SCHOOL_ID' => $school_id,
            'DEPARTMENT' => $dept_name
        );
        $this->db->insert('tbl_departments', $posted_data);

        return $this->db->insert_id();
    }

    function dept_exist($dept_id){
        $this->db->select('*');
        $this->db->from('tbl_departments');
        $this->db->where('department_id', $dept_id);
        $query = $this->db->get();

        return $query->result();
    }

}