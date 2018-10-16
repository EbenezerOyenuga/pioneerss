<?php

/**
 * Created by PhpStorm.
 * User: ebene
 * Date: 12/1/2016
 * Time: 12:37 PM
 */
class M_Residence extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_residence(){
        $this->db->select('*');
        $this->db->from('tbl_residence');
        $query = $this->db->get();
        return $query->result();
    }

    function get_residence_name($residence_id){
        $this->db->select('*');
        $this->db->from('tbl_residence');
        $this->db->where('residence_id', $residence_id);
        $query = $this->db->get();
        return $query->result();
    }


}
