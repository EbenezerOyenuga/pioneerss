<?php

/**
 * Created by PhpStorm.
 * User: ebene
 * Date: 12/1/2016
 * Time: 11:30 AM
 */
class M_Titles extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function get_active_titles(){

        $query = $this->db->get('tbl_titles');

        return $query->result();
    }
}