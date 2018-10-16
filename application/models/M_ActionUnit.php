<?php

/**
 * Created by PhpStorm.
 * User: ebene
 * Date: 12/1/2016
 * Time: 12:37 PM
 */
class M_ActionUnit extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_all_action_units(){
        $this->db->select('*');
        $this->db->from('action_units');
        $query = $this->db->get();
        return $query->result();
    }

    function get_action_units(){
        $this->db->select('*');
        $this->db->from('action_units');
        $this->db->where('STATUS', 1);
        $query = $this->db->get();
        return $query->result();
    }

    function get_action_unit_by_id($id){
        $this->db->select('*');
        $this->db->from('action_units');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    function count_students_in_action_unit($id){
        $this->db->where('unit_id', $id);
        $this->db->from('students');
        return $this->db->count_all_results();

    }

    function count_action_units(){
        $this->db->where('status', 1);
        $this->db->from('action_units');
        return $this->db->count_all_results();

    }

    function add_action_unit_pic($picloc){

        $posted_data = array(
            'name' => $this->input->post('action_unit', TRUE),
            'coordinator' => $this->input->post('coordinator', TRUE),
            'coordinator_picture' => $picloc
        );
        $this->db->insert('action_units', $posted_data);

        return $this->db->insert_id();
    }

    function add_action_unit(){

        $posted_data = array(
            'name' => $this->input->post('action_unit', TRUE),
            'coordinator' => $this->input->post('coordinator', TRUE),

        );
        $this->db->insert('action_units', $posted_data);

        return $this->db->insert_id();
    }

    function update_action_unit(){
        $this->db->set('name', $this->input->post('action_unit', TRUE));
        $this->db->set('coordinator', $this->input->post('coordinator', TRUE));
        $this->db->where('id', $this->input->post('id', TRUE));

        return $this->db->update('action_units');
    }

    function update_action_unit_pic($picloc){
        $this->db->set('name', $this->input->post('action_unit', TRUE));
        $this->db->set('coordinator', $this->input->post('coordinator', TRUE));
        $this->db->set('coordinator_picture', $picloc);
        $this->db->where('id', $this->session->userdata('id'));

        return $this->db->update('action_units');
    }

    function change_status($id, $status){
            $this->db->set('status', $status);
            $this->db->where('id', $id);

            return $this->db->update('action_units');
    }
}
