<?php

/**
 * Created by PhpStorm.
 * User: ebene
 * Date: 12/1/2016
 * Time: 11:30 AM
 */
class M_Roles extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function get_active_roles(){
        $this->db->where('ROLE_STATUS', 1);
        $query = $this->db->get('tbl_roles');
        return $query->result();
    }
    function assign_role_user($id){
        $posted_data = array(
            'LOGIN_ID' => $id,
            'ASSIGNED_ROLE' => $this->input->post('role', TRUE)

        );
        return $this->db->insert('tbl_assigned_roles', $posted_data);
    }

    function assign_residence_subrole_user($id){
        $this->db->set('ASSIGNED_SUBROLE', $this->input->post('residence', TRUE));
        $this->db->set('ASSIGNED_SUBROLE2', '');
        $this->db->where('LOGIN_ID', $id);

        return $this->db->update('tbl_assigned_roles');

    }
    function assign_gender_subrole_user($id){
        $this->db->set('ASSIGNED_SUBROLE', $this->input->post('gender', TRUE));
        $this->db->where('LOGIN_ID', $id);

        return $this->db->update('tbl_assigned_roles');

    }
    function assign_gender_residence_subrole_user($id){
        $this->db->set('ASSIGNED_SUBROLE', $this->input->post('residence', TRUE));
        $this->db->set('ASSIGNED_SUBROLE2', $this->input->post('gender', TRUE));
        $this->db->where('LOGIN_ID', $id);

        return $this->db->update('tbl_assigned_roles');

    }

    function update_user_role(){
        $this->db->set('ASSIGNED_ROLE', $this->input->post('role', TRUE));
        $this->db->where('LOGIN_ID', $this->input->post('id', TRUE));

        return $this->db->update('tbl_assigned_roles');

    }
}
