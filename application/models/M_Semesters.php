<?php

/**
 * Created by PhpStorm.
 * User: ebene
 * Date: 12/1/2016
 * Time: 12:37 PM
 */
class M_Semesters extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function load_semester($semester_name){

        $posted_data = array(
            'SEMESTER' => $semester_name,
            'CURRENT' => 1
        );
        $this->db->insert('tbl_semesters', $posted_data);

        return $this->db->insert_id();
    }

    function deactivate_semester($semester_name){
        $this->db->set('CURRENT', 0);
        $this->db->where('SEMESTER', $semester_name);

        return $this->db->update('tbl_semesters');
    }

    function load_semester_requirement($semester_id){

        $posted_data = array(
            'SEMESTER_ID' => $semester_id
        );
        $this->db->insert('tbl_semester_requirements', $posted_data);

        return $this->db->insert_id();
    }

    function load_semester_program_requirement($semester_id, $program_id){

        $posted_data = array(
            'SEMESTER_ID' => $semester_id,
            'PROGRAM_ID' => $program_id
        );
        $this->db->insert('tbl_semester_program_requirements', $posted_data);

        return $this->db->insert_id();
    }

    function load_semester_weights($semester_id, $level_id){

        $posted_data = array(
            'SEMESTER_ID' => $semester_id,
            'LEVEL_ID' => $level_id
        );
        $this->db->insert('tbl_semester_weights', $posted_data);

        return $this->db->insert_id();
    }

    function semester_exist($semester_name){
        $this->db->select('*');
        $this->db->from('tbl_semesters');
        $this->db->where('semester', $semester_name);
        $query = $this->db->get();

        return $query->result();
    }

    function get_current_semesters(){
        $this->db->select('*');
        $this->db->from('tbl_semesters');
        $this->db->where('current', 1);
        $this->db->order_by('semester', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function get_graded_chapel_semesters(){
        $this->db->select('tbl_semesters.SEMESTER_ID, SEMESTER');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('chapel_status', 1);
        $this->db->where('chapel_grader', $this->session->userdata('user_id'));
        $this->db->group_by('semester');
        $this->db->order_by('semester', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function get_graded_residence_semesters(){
        $this->db->select('tbl_semesters.SEMESTER_ID, SEMESTER');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('residence_status', 6);
        $this->db->group_by('semester');
        $this->db->order_by('semester', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function get_forwarded_residence_semesters(){
        $this->db->select('tbl_semesters.SEMESTER_ID, SEMESTER');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('residence_status', 1);
        $this->db->group_by('semester');
        $this->db->order_by('semester', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function get_graded_chiefhall_residence_semesters(){
        $this->db->select('tbl_semesters.SEMESTER_ID, SEMESTER');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('residence_status', 1);
        $this->db->group_by('semester');
        $this->db->order_by('semester', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function get_forwarded_chiefhall_residence_semesters(){
        $this->db->select('tbl_semesters.SEMESTER_ID, SEMESTER');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('admin_status', 1);
        $this->db->group_by('semester');
        $this->db->order_by('semester', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function get_graded_worship_semesters(){
        $this->db->select('tbl_semesters.SEMESTER_ID, SEMESTER');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('worship_status', 1);
        $this->db->where('worship_grader', $this->session->userdata('user_id'));
        $this->db->group_by('semester');
        $this->db->order_by('semester', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function get_graded_semesters(){
        $this->db->select('tbl_semesters.SEMESTER_ID, SEMESTER');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->group_by('semester');
        $this->db->order_by('semester', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function get_forwarded_semesters(){
        $this->db->select('tbl_semesters.SEMESTER_ID, SEMESTER');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('admin_status', 1);
        $this->db->group_by('semester');
        $this->db->order_by('semester', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function get_semester($semester_id){
        $this->db->select('*');
        $this->db->from('tbl_semesters');
        $this->db->where('semester_id', $semester_id);
        $query = $this->db->get();

        return $query->result();
    }

    function get_if_grade_chapel_semesters_started($semester){
        $this->db->select('tbl_semesters.SEMESTER_ID');
        $this->db->from('tbl_semesters');
        $this->db->join('tbl_semester_students', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('tbl_semester_students.semester_id', $semester);
        $this->db->where('chapel_scores !=', NULL);
        $query = $this->db->get();

        return $query->result();
    }

    function get_if_grade_chapel_semesters_finished($semester){
        $this->db->select('tbl_semesters.SEMESTER_ID');
        $this->db->from('tbl_semesters');
        $this->db->join('tbl_semester_students', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('tbl_semester_students.semester_id', $semester);
        $this->db->where('chapel_scores =', NULL);
        $query = $this->db->get();

        return $query->result();
    }

    function get_if_grade_worship_semesters_started($semester){
        $this->db->select('tbl_semesters.SEMESTER_ID');
        $this->db->from('tbl_semesters');
        $this->db->join('tbl_semester_students', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('tbl_semester_students.semester_id', $semester);
        $this->db->where('worship_scores !=', NULL);
        $query = $this->db->get();

        return $query->result();
    }

    function get_if_grade_worship_semesters_finished($semester){
        $this->db->select('tbl_semesters.SEMESTER_ID');
        $this->db->from('tbl_semesters');
        $this->db->join('tbl_semester_students', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('tbl_semester_students.semester_id', $semester);
        $this->db->where('worship_scores =', NULL);
        $query = $this->db->get();

        return $query->result();
    }

    function get_if_grade_residence_semesters_started($semester){
        $this->db->select('tbl_semesters.SEMESTER_ID');
        $this->db->from('tbl_semesters');
        $this->db->join('tbl_semester_students', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('tbl_semester_students.semester_id', $semester);
        $this->db->where('tbl_semester_students.residence_id', $this->session->userdata('subrole'));
        $this->db->where('residence_scores !=', NULL);
        $query = $this->db->get();

        return $query->result();
    }

    function get_if_grade_residence_semesters_finished($semester){
        $this->db->select('tbl_semesters.SEMESTER_ID');
        $this->db->from('tbl_semesters');
        $this->db->join('tbl_semester_students', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('tbl_semester_students.semester_id', $semester);
        $this->db->where('tbl_semester_students.residence_id', $this->session->userdata('subrole'));
        $this->db->where('residence_scores =', NULL);
        $query = $this->db->get();

        return $query->result();
    }

    function get_if_any_submissions($semester){
        $this->db->select('tbl_semesters.SEMESTER_ID');
        $this->db->from('tbl_semesters');
        $this->db->join('tbl_semester_students', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('tbl_semester_students.semester_id', $semester);
        $this->db->where("(chapel_status = 1 OR residence_status = 1 OR worship_status = 1 OR chapel_status = 5 OR residence_status = 5 OR worship_status = 5 OR chapel_status = 4 OR residence_status = 4 OR worship_status = 4)");
        $query = $this->db->get();

        return $query->result();
    }

    function get_if_fully_submitted($semester){
        $this->db->select('tbl_semesters.SEMESTER_ID');
        $this->db->from('tbl_semesters');
        $this->db->join('tbl_semester_students', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('tbl_semester_students.semester_id', $semester);
        $this->db->where("(chapel_status != 1 OR residence_status != 1 OR worship_status != 1 OR chapel_status != 5 OR residence_status != 5 OR worship_status != 5 OR chapel_status != 4 OR residence_status != 4 OR worship_status != 4)");
        $query = $this->db->get();

        return $query->result();
    }

}
