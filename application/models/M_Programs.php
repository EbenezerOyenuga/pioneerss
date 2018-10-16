<?php

/**
 * Created by PhpStorm.
 * User: ebene
 * Date: 12/1/2016
 * Time: 12:37 PM
 */
class M_Programs extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function load_program($dept_id, $prog_id, $prog_name){

        $posted_data = array(
            'DEPARTMENT_ID' => $dept_id,
            'PROGRAM_ID' => $prog_id,
            'PROGRAM' => $prog_name
        );
        $this->db->insert('tbl_programs', $posted_data);

        return $this->db->insert_id();
    }

    function get_programs(){
        $this->db->select('*');
        $this->db->from('tbl_programs');
        $this->db->order_by('program', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function program_exist($prog_id){
        $this->db->select('program_id, program');
        $this->db->from('tbl_programs');
        $this->db->where('program_id', $prog_id);
        $query = $this->db->get();

        return $query->result();
    }

    function get_program($program_id){
        $this->db->select('PROGRAM');
        $this->db->from('tbl_programs');
        $this->db->where('program_id', $program_id);
        $query = $this->db->get();

        return $query->result();
    }

    function update_program($id, $program, $department_id){
        $this->db->set('department_id', $department_id);
        $this->db->set('program', $program);
        $this->db->where('program_id', $id);

        return $this->db->update('tbl_programs');

    }
}
