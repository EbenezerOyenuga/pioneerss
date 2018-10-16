<?php

/**
 * Created by PhpStorm.
 * User: ebene
 * Date: 12/1/2016
 * Time: 12:37 PM
 */
class M_Students extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function add_student(){

        $posted_data = array(
            'matricno' => $this->input->post('matricno', TRUE),
            'email' => $this->input->post('email', TRUE),
            'surname' => $this->input->post('surname', TRUE),
            'othernames' => $this->input->post('other_names', TRUE),
            'phone' => $this->input->post('phone', TRUE),
            'residence_id' => $this->input->post('residence', TRUE),
            'program_id' => $this->input->post('program', TRUE),
            'unit_id' => $this->input->post('action_units', TRUE)
        );
        $this->db->insert('students', $posted_data);

        return $this->db->insert_id();
    }
    function update_user(){
        $this->db->set('EMAIL', $this->input->post('email', TRUE));
        $this->db->set('TITLE_ID', $this->input->post('title', TRUE));
        $this->db->set('FIRSTNAME', $this->input->post('firstname', TRUE));
        $this->db->set('SURNAME', $this->input->post('surname', TRUE));
        $this->db->where('EMAIL', $this->input->post('email', TRUE));

        return $this->db->update('tbl_login');
    }

    function update_role(){

        $this->db->set('ASSIGNED_ROLE', $this->input->post('role', TRUE));
        $this->db->where('LOGIN_ID', $this->input->post('id', TRUE));

        return $this->db->update('tbl_assigned_roles');
    }

    function update_admin_role(){

        $this->db->set('ASSIGNED_ROLE', 4);
        $this->db->where('LOGIN_ID', 11);

        return $this->db->update('tbl_assigned_roles');
    }


    function get_action_units_students($id){
        $this->db->select('othernames, surname, matricno, email, phone, program, residence');
        $this->db->from('students');
        $this->db->join('tbl_programs', 'students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_residence', 'students.residence_id = tbl_residence.residence_id');
        $this->db->where('unit_id', $id);
        $query = $this->db->get();

        return $query->result();
    }

    function change_status($id, $status){
        $this->db->set('status', $status);
        $this->db->where('login_id', $id);

        return $this->db->update('tbl_login');
    }


    function count_students(){
        $this->db->where('status', 1);
        $this->db->from('students');
        return $this->db->count_all_results();

    }

    function get_all_students(){
        $this->db->select('othernames, surname, matricno, email, phone, program, residence, name');
        $this->db->from('students');
        $this->db->join('tbl_programs', 'students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_residence', 'students.residence_id = tbl_residence.residence_id');
        $this->db->join('action_units', 'students.unit_id = action_units.id');
        $query = $this->db->get();
        return $query->result();
    }
}
