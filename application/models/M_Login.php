<?php

/**
 * Created by PhpStorm.
 * User: ebene
 * Date: 12/1/2016
 * Time: 12:37 PM
 */
class M_Login extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }


    function get_userid($username){
        $this->db->select('login_id');
        $this->db->from('tbl_login');
        $this->db->where('username', $username);
        $query = $this->db->get();

        return $query->result();
    }
    function confirm_user_status($userid){
        $this->db->select('login_id');
        $this->db->from('tbl_login');
        $this->db->where('tbl_login.login_id', $userid);
        $this->db->where('status', 1);
        $query = $this->db->get();

        return $query->result();
    }
    function confirm_user_password($userid, $password){

        $this->db->select('*');
        $this->db->from('tbl_login');
        $this->db->where('tbl_login.login_id', $userid);
        $this->db->where('password', $password);

        $query = $this->db->get();

        return $query->result();
    }

    function update_password(){

        $this->db->set('password', sha1($this->input->post('new_pass', TRUE)));
        $this->db->where('login_id', $this->session->userdata('user_id'));

        return $this->db->update('tbl_login');
    }
}
