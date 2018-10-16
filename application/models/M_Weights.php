<?php

/**
 * Created by PhpStorm.
 * User: ebene
 * Date: 12/1/2016
 * Time: 12:37 PM
 */
class M_Weights extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function update_weights(){

        $this->db->set('chapel_weight', $this->input->post('weight_chapel', TRUE));
        $this->db->set('residence_weight', $this->input->post('weight_residence', TRUE));
        $this->db->set('worship_weight', $this->input->post('weight_worship', TRUE));
        $this->db->where('semester_weight_id', $this->input->post('semester_weight_id', TRUE));
        return $this->db->update('tbl_semester_weights');

    }

    function get_current_semesters_weights(){
        $this->db->select('*');
        $this->db->from('tbl_semester_weights');
        $this->db->join('tbl_semesters', 'tbl_semester_weights.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_levels', 'tbl_semester_weights.level_id = tbl_levels.level_id');
        $this->db->where('current', 1);
        $this->db->order_by('semester', 'ASC');
        $this->db->order_by('level', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function get_zero_chapel_semester_level_weights($semester, $level){
        $this->db->select('*');
        $this->db->from('tbl_semester_weights');
        $this->db->join('tbl_semesters', 'tbl_semester_weights.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_levels', 'tbl_semester_weights.level_id = tbl_levels.level_id');
        $this->db->where('tbl_semester_weights.semester_id', $semester);
        $this->db->where('tbl_semester_weights.level_id', $level);
        $this->db->where('chapel_weight', 0);
        $query = $this->db->get();

        return $query->result();
    }

    function get_zero_residence_semester_level_weights($semester, $level){
        $this->db->select('*');
        $this->db->from('tbl_semester_weights');
        $this->db->join('tbl_semesters', 'tbl_semester_weights.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_levels', 'tbl_semester_weights.level_id = tbl_levels.level_id');
        $this->db->where('tbl_semester_weights.semester_id', $semester);
        $this->db->where('tbl_semester_weights.level_id', $level);
        $this->db->where('residence_weight', 0);
        $query = $this->db->get();

        return $query->result();
    }

    function get_zero_worship_semester_level_weights($semester, $level){
        $this->db->select('*');
        $this->db->from('tbl_semester_weights');
        $this->db->join('tbl_semesters', 'tbl_semester_weights.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_levels', 'tbl_semester_weights.level_id = tbl_levels.level_id');
        $this->db->where('tbl_semester_weights.semester_id', $semester);
        $this->db->where('tbl_semester_weights.level_id', $level);
        $this->db->where('worship_weight', 0);
        $query = $this->db->get();

        return $query->result();
    }

    function get_semester_level_weights($semester, $level){
        $this->db->select('*');
        $this->db->from('tbl_semester_weights');
        $this->db->join('tbl_semesters', 'tbl_semester_weights.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_levels', 'tbl_semester_weights.level_id = tbl_levels.level_id');
        $this->db->where('tbl_semester_weights.semester_id', $semester);
        $this->db->where('tbl_semester_weights.level_id', $level);
        $query = $this->db->get();

        return $query->result();
    }

    function get_weights($semester_weight_id){
        $this->db->select('*');
        $this->db->from('tbl_semester_weights');
        $this->db->join('tbl_semesters', 'tbl_semester_weights.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_levels', 'tbl_semester_weights.level_id = tbl_levels.level_id');
        $this->db->where('semester_weight_id', $semester_weight_id);
        $query = $this->db->get();

        return $query->result();
    }
}