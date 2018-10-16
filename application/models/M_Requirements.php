<?php

/**
 * Created by PhpStorm.
 * User: ebene
 * Date: 12/1/2016
 * Time: 12:37 PM
 */
class M_Requirements extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function update_requirements($id){
        $this->db->set('max_number', $this->input->post('max_number', TRUE));

        return $this->db->update('max_students_unit');

    }

    function update_semester_program_status($semester_id, $type, $program_id, $curr_status){
        if ($curr_status == 1)
            $updated_status = 0;
        else
          $updated_status = 1;
        if ($type == 1)
          $this->db->set('CHAPEL_REQUIREMENT', $updated_status);
        if ($type == 2)
          $this->db->set('RESIDENCE_REQUIREMENT', $updated_status);
        if ($type == 3)
          $this->db->set('WORSHIP_REQUIREMENT', $updated_status);

        $this->db->where('semester_id', $semester_id);
        $this->db->where('program_id', $program_id);

        return $this->db->update('tbl_semester_program_requirements');
    }

    function get_max_students(){
        $this->db->select('*');
        $this->db->from('max_students_unit');

        $query = $this->db->get();

        return $query->result();
    }

    function get_program_requirements($semester_id){
        $this->db->select('tbl_semester_program_requirements.semester_id, PROGRAM, tbl_semester_program_requirements.program_id, chapel_requirement, residence_requirement, worship_requirement');
        $this->db->from('tbl_semester_program_requirements');
        $this->db->join('tbl_semesters', 'tbl_semester_program_requirements.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_program_requirements.program_id = tbl_programs.program_id');
        $this->db->where('tbl_semester_program_requirements.semester_id', $semester_id);
        $query = $this->db->get();

        return $query->result();
    }

    function get_if_semester_prog_requirement($semester_id){
        $this->db->select('semester_id');
        $this->db->from('tbl_semester_program_requirements');
        $this->db->where('semester_id', $semester_id);
        $query = $this->db->get();

        return $query->result();
    }

    function get_if_chapel_required($semester_id, $program_id){
        $this->db->select('semester_program_requirements_id');
        $this->db->from('tbl_semester_program_requirements');
        $this->db->where('semester_id', $semester_id);
        $this->db->where('program_id', $program_id);
        $this->db->where('chapel_requirement', 1);
        $query = $this->db->get();

        return $query->result();
    }

    function get_if_residence_required($semester_id, $program_id){
        $this->db->select('semester_program_requirements_id');
        $this->db->from('tbl_semester_program_requirements');
        $this->db->where('semester_id', $semester_id);
        $this->db->where('program_id', $program_id);
        $this->db->where('residence_requirement', 1);
        $query = $this->db->get();

        return $query->result();
    }

    function get_if_worship_required($semester_id, $program_id){
        $this->db->select('semester_program_requirements_id');
        $this->db->from('tbl_semester_program_requirements');
        $this->db->where('semester_id', $semester_id);
        $this->db->where('program_id', $program_id);
        $this->db->where('worship_requirement', 1);
        $query = $this->db->get();

        return $query->result();
    }

    function get_semester_requirements($semester_id){
        $this->db->select('*');
        $this->db->from('tbl_semester_requirements');
        $this->db->where('SEMESTER_ID', $semester_id);
        $query = $this->db->get();

        return $query->result();
    }

    function edit_requirements($id){
        $this->db->select('*');
        $this->db->from('tbl_semesters');
        $this->db->join('tbl_semester_requirements', 'tbl_semesters.semester_id = tbl_semester_requirements.semester_id');
        $this->db->where('semester_requirement_id', $id);
        $query = $this->db->get();

        return $query->result();
    }

    function edit_program_requirements($semester_id, $program_id){
        $this->db->select('*');
        $this->db->from('tbl_semesters');
        $this->db->join('tbl_semester_requirements', 'tbl_semesters.semester_id = tbl_semester_requirements.semester_id');
        $this->db->where('semester_requirement_id', $id);
        $query = $this->db->get();

        return $query->result();
    }

}
