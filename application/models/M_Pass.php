<?php

/**
 * Created by PhpStorm.
 * User: ebene
 * Date: 12/1/2016
 * Time: 12:37 PM
 */
class M_Pass extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function update_passmarks(){

        $this->db->set('ATTRI1', $this->input->post('passmark_chapel', TRUE));
        $this->db->set('ATTRI2', $this->input->post('passmark_residence', TRUE));
        $this->db->set('ATTRI3', $this->input->post('passmark_worship', TRUE));
        $this->db->where('LOOKUP_TYPE', 'Pass Marks');

        return $this->db->update('tbl_lookup');

    }

    function get_passmarks(){
        $this->db->select('*');
        $this->db->from('tbl_lookup');
        $this->db->where('lookup_type', 'Pass Marks');
        $query = $this->db->get();

        return $query->result();
    }
}