<?php

/**
 * Created by PhpStorm.
 * User: ebene
 * Date: 12/1/2016
 * Time: 12:37 PM
 */
class M_Gender extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_gender(){
        $this->db->select('*');
        $this->db->from('tbl_genders');
        $query = $this->db->get();
        return $query->result();
    }

    function get_gender_name($gender_id){
        $this->db->select('*');
        $this->db->from('tbl_genders');
        $this->db->where('gender_id', $gender_id);
        $query = $this->db->get();
        return $query->result();
    }
}