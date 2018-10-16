<?php

/**
 * Created by PhpStorm.
 * User: ebene
 * Date: 12/1/2016
 * Time: 12:37 PM
 */
class M_Schools extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function load_school($school_id, $school_name){

        $posted_data = array(
            'SCHOOL_ID' => $school_id,
            'SCHOOL' => $school_name
        );
        $this->db->insert('tbl_schools', $posted_data);

        return $this->db->insert_id();
    }

    function school_exist($school_id){
        $this->db->select('*');
        $this->db->from('tbl_schools');
        $this->db->where('school_id', $school_id);
        $query = $this->db->get();

        return $query->result();
    }

}