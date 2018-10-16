<?php

/**
 * Created by PhpStorm.
 * User: ebene
 * Date: 12/1/2016
 * Time: 12:37 PM
 */
class M_Grades extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function load_grade($grade, $min_range, $max_range, $grade_weight){

        $posted_data = array(
            'GRADE' => $grade,
            'MIN_RANGE' => $min_range,
            'MAX_RANGE' => $max_range,
            'GRADE_WEIGHT' => $grade_weight
        );
        $this->db->insert('tbl_grades', $posted_data);

        return $this->db->insert_id();
    }

    function grade_exist($grade){
        $this->db->select('*');
        $this->db->from('tbl_grades');
        $this->db->where('grade', $grade);
        $query = $this->db->get();

        return $query->result();
    }

    function get_grades(){
        $this->db->select('*');
        $this->db->from('tbl_grades');
        $query = $this->db->get();

        return $query->result();
    }

}