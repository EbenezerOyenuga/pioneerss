<?php

/**
 * Created by PhpStorm.
 * User: ebene
 * Date: 12/1/2016
 * Time: 12:37 PM
 */
class M_Semester_Students extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function load_semesterstudent($semester_id, $matric_num, $std_nam, $residence, $program, $level, $gender){

        $posted_data = array(
            'semester_id' => $semester_id,
            'matric_no' => $matric_num,
            'student_name' => $std_nam,
            'residence_id' => $residence,
            'program_id' => $program,
            'level_id' => $level,
            'gender_id' => $gender
        );
        $this->db->insert('tbl_semester_students', $posted_data);

        return $this->db->insert_id();
    }

    function student_exist($semester, $matric_num){
        $this->db->select('*');
        $this->db->from('tbl_semester_students');
        $this->db->where('matric_no', $matric_num);
        $this->db->where('semester_id', $semester);
        $query = $this->db->get();

        return $query->result();
    }

    function get_semester_students($semester){
        $this->db->select('*');
        $this->db->from('tbl_semester_students');
        $this->db->where('semester_id', $semester);
        $query = $this->db->get();

        return $query->result();
    }

    function get_semester_program_students($semester, $program){
        $this->db->select('*');
        $this->db->from('tbl_semester_students');
        $this->db->where('semester_id', $semester);
        $this->db->where('program_id', $program);
        $this->db->order_by('student_name', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function get_current_chapel_students($semester, $program, $level){
        $this->db->select('MATRIC_NO, STUDENT_NAME, SEMESTER_SCORE_ID, CHAPEL_SCORES');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('tbl_semester_students.semester_id', $semester);
        $this->db->where('tbl_semester_students.program_id', $program);
        $this->db->where('tbl_semester_students.level_id', $level);
        $this->db->where('chapel_status', 0);
        $this->db->order_by('student_name', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }


    function get_graded_chapel_students($semester, $program, $level){
        $this->db->select('MATRIC_NO, STUDENT_NAME, SEMESTER_SCORE_ID, CHAPEL_SCORES');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('tbl_semester_students.semester_id', $semester);
        $this->db->where('tbl_semester_students.program_id', $program);
        $this->db->where('tbl_semester_students.level_id', $level);
        $this->db->where('chapel_grader', $this->session->userdata('user_id'));
        $this->db->where('chapel_status', 1);
        $this->db->where('admin_status', 0);
        $this->db->order_by('student_name', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function get_current_residence_students($semester, $program, $level){
        $this->db->select('MATRIC_NO, STUDENT_NAME, SEMESTER_SCORE_ID, RESIDENCE_SCORES');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('tbl_semester_students.semester_id', $semester);
        $this->db->where('tbl_semester_students.program_id', $program);
        $this->db->where('tbl_semester_students.level_id', $level);
        $this->db->where('residence_id', $this->session->userdata('subrole'));
        $this->db->where('residence_status', 0);
        $this->db->like('gender_id', $this->session->userdata('subrole2'));
        $this->db->order_by('student_name', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function get_graded_residence_students($semester, $program, $level){
        $this->db->select('MATRIC_NO, STUDENT_NAME, SEMESTER_SCORE_ID, RESIDENCE_SCORES');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('tbl_semester_students.semester_id', $semester);
        $this->db->where('tbl_semester_students.program_id', $program);
        $this->db->where('tbl_semester_students.level_id', $level);
        $this->db->where('residence_grader', $this->session->userdata('user_id'));
        $this->db->where('residence_status', 6);
        $this->db->where('admin_status', 0);
        $this->db->order_by('student_name', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function get_forwarded_residence_students($semester, $program, $level){
        $this->db->select('MATRIC_NO, STUDENT_NAME, SEMESTER_SCORE_ID, RESIDENCE_SCORES');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('tbl_semester_students.semester_id', $semester);
        $this->db->where('tbl_semester_students.program_id', $program);
        $this->db->where('tbl_semester_students.level_id', $level);
        $this->db->where('residence_grader', $this->session->userdata('user_id'));
        $this->db->where('residence_status', 1);
        $this->db->where('admin_status', 0);
        $this->db->order_by('student_name', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function get_graded_chiefresidence_students($semester, $residence, $program){
        $this->db->select('MATRIC_NO, STUDENT_NAME, SEMESTER_SCORE_ID, RESIDENCE_SCORES, LEVEL, RESIDENCE_GRADER');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->join('tbl_residence', 'tbl_semester_students.residence_id = tbl_residence.residence_id');
        $this->db->where('tbl_semester_students.semester_id', $semester);
        $this->db->where('tbl_semester_students.program_id', $program);
        $this->db->where('tbl_semester_students.residence_id', $residence);
        $this->db->where('tbl_semester_students.gender_id', $this->session->userdata('subrole'));
        $this->db->where('residence_status', 6);
        $this->db->where('admin_status', 0);
        $this->db->order_by('level', 'ASC');
        $this->db->order_by('student_name', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function get_graded_chiefhall_students(){
        $this->db->select('MATRIC_NO, STUDENT_NAME, SEMESTER, PROGRAM, RESIDENCE_NAME, RESIDENCE_SCORES, LEVEL');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->join('tbl_residence', 'tbl_semester_students.residence_id = tbl_residence.residence_id');
        $this->db->where('tbl_semester_students.gender_id', $this->session->userdata('subrole'));
        $this->db->where('residence_status', 1);
        $this->db->where('admin_status', 0);
        $this->db->order_by('student_name', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }
    function get_forwarded_chiefhall_students(){
        $this->db->select('MATRIC_NO, STUDENT_NAME, SEMESTER, PROGRAM, RESIDENCE_NAME, RESIDENCE_SCORES, LEVEL');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->join('tbl_residence', 'tbl_semester_students.residence_id = tbl_residence.residence_id');
        $this->db->where('tbl_semester_students.gender_id', $this->session->userdata('subrole'));
        $this->db->where('admin_status', 1);
        $this->db->order_by('student_name', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }
    function get_graded_chiefhall_semester_students($semester){
        $this->db->select('MATRIC_NO, STUDENT_NAME, SEMESTER, PROGRAM, RESIDENCE_NAME, RESIDENCE_SCORES, LEVEL');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->join('tbl_residence', 'tbl_semester_students.residence_id = tbl_residence.residence_id');
        $this->db->where('tbl_semester_students.semester_id', $semester);
        $this->db->where('tbl_semester_students.gender_id', $this->session->userdata('subrole'));
        $this->db->where('residence_status', 1);
        $this->db->where('admin_status', 0);
        $this->db->order_by('student_name', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function get_forwarded_chiefhall_semester_students($semester){
        $this->db->select('MATRIC_NO, STUDENT_NAME, SEMESTER, PROGRAM, RESIDENCE_NAME, RESIDENCE_SCORES, LEVEL');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->join('tbl_residence', 'tbl_semester_students.residence_id = tbl_residence.residence_id');
        $this->db->where('tbl_semester_students.semester_id', $semester);
        $this->db->where('tbl_semester_students.gender_id', $this->session->userdata('subrole'));
        $this->db->where('admin_status', 1);
        $this->db->order_by('student_name', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }
    function get_graded_chiefhall_semester_residence_program_level_students($semester, $residence, $program, $level){
        $this->db->select('MATRIC_NO, STUDENT_NAME, SEMESTER, PROGRAM, RESIDENCE_NAME, RESIDENCE_SCORES, LEVEL, RESIDENCE_GRADER, RESIDENCE_STATUS');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->join('tbl_residence', 'tbl_semester_students.residence_id = tbl_residence.residence_id');
        $this->db->where('tbl_semester_students.gender_id', $this->session->userdata('subrole'));
        $this->db->where('residence_status', 1);
        $this->db->where('admin_status', 0);
        $this->db->where('tbl_semester_students.semester_id', $semester);
        $this->db->like('tbl_semester_students.residence_id', $residence);
        $this->db->like('tbl_semester_students.program_id', $program);
        $this->db->like('tbl_semester_students.level_id', $level);
        $this->db->order_by('RESIDENCE_NAME', 'ASC');
        $this->db->order_by('PROGRAM', 'ASC');
        $this->db->order_by('LEVEL', 'ASC');
        $this->db->order_by('STUDENT_NAME', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }
    function get_forwarded_chiefhall_semester_residence_program_level_students($semester, $residence, $program, $level){
        $this->db->select('MATRIC_NO, STUDENT_NAME, SEMESTER, PROGRAM, RESIDENCE_NAME, RESIDENCE_SCORES, LEVEL');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->join('tbl_residence', 'tbl_semester_students.residence_id = tbl_residence.residence_id');
        $this->db->where('tbl_semester_students.gender_id', $this->session->userdata('subrole'));
        $this->db->where('admin_status', 1);
        $this->db->where('tbl_semester_students.semester_id', $semester);
        $this->db->like('tbl_semester_students.residence_id', $residence);
        $this->db->like('tbl_semester_students.program_id', $program);
        $this->db->like('tbl_semester_students.level_id', $level);
        $this->db->order_by('RESIDENCE_NAME', 'ASC');
        $this->db->order_by('PROGRAM', 'ASC');
        $this->db->order_by('LEVEL', 'ASC');
        $this->db->order_by('STUDENT_NAME', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function get_forwarded_chiefhall_residences($semester, $residence, $program, $level){
        $this->db->select('tbl_semester_students.RESIDENCE_ID, RESIDENCE_NAME');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->join('tbl_residence', 'tbl_semester_students.residence_id = tbl_residence.residence_id');
        $this->db->where('tbl_semester_students.gender_id', $this->session->userdata('subrole'));
        $this->db->where('admin_status', 1);
        $this->db->where('tbl_semester_students.semester_id', $semester);
        $this->db->like('tbl_semester_students.residence_id', $residence);
        $this->db->like('tbl_semester_students.program_id', $program);
        $this->db->like('tbl_semester_students.level_id', $level);
        $this->db->group_by('RESIDENCE_NAME', 'ASC');
        $this->db->order_by('RESIDENCE_NAME', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function get_forwarded_chiefhall_semester_program_level_students_by_residence($semester, $residence, $program, $level, $residence_id){
        $this->db->select('MATRIC_NO, STUDENT_NAME, SEMESTER, PROGRAM, RESIDENCE_NAME, RESIDENCE_SCORES, LEVEL, RESIDENCE_GRADER, RESIDENCE_STATUS');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->join('tbl_residence', 'tbl_semester_students.residence_id = tbl_residence.residence_id');
        $this->db->where('tbl_semester_students.gender_id', $this->session->userdata('subrole'));
        $this->db->where('admin_status', 1);
        $this->db->where('tbl_semester_students.semester_id', $semester);
        $this->db->where('tbl_semester_students.residence_id', $residence);
        $this->db->like('tbl_semester_students.program_id', $program);
        $this->db->like('tbl_semester_students.level_id', $level);
        $this->db->order_by('RESIDENCE_NAME', 'ASC');
        $this->db->order_by('PROGRAM', 'ASC');
        $this->db->order_by('LEVEL', 'ASC');
        $this->db->order_by('STUDENT_NAME', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function get_admin_graded_residence_students($semester, $program, $level, $residence){
        $this->db->select('MATRIC_NO, STUDENT_NAME, SEMESTER_SCORE_ID, RESIDENCE_SCORES');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('residence_status', 1);
        $this->db->where('admin_status', 0);
        $this->db->like('tbl_semester_students.semester_id', $semester);
        $this->db->like('tbl_semester_students.program_id', $program);
        $this->db->like('tbl_semester_students.level_id', $level);
        $this->db->like('tbl_semester_students.residence_id', $residence);
        $this->db->like('gender_id', $this->session->userdata('subrole'));
        $this->db->order_by('student_name', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function get_admin_forwarded_residence_students($semester, $program, $level, $residence){
        $this->db->select('MATRIC_NO, STUDENT_NAME, SEMESTER_SCORE_ID, RESIDENCE_SCORES');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('residence_status', 1);
        $this->db->where('admin_status', 0);
        $this->db->like('tbl_semester_students.semester_id', $semester);
        $this->db->like('tbl_semester_students.program_id', $program);
        $this->db->like('tbl_semester_students.level_id', $level);
        $this->db->like('tbl_semester_students.residence_id', $residence);
        $this->db->like('gender_id', $this->session->userdata('subrole2'));
        $this->db->order_by('student_name', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function get_current_worship_students($semester, $program, $level){
        $this->db->select('MATRIC_NO, STUDENT_NAME, SEMESTER_SCORE_ID, WORSHIP_SCORES');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('tbl_semester_students.semester_id', $semester);
        $this->db->where('tbl_semester_students.program_id', $program);
        $this->db->where('tbl_semester_students.level_id', $level);
        $this->db->where('worship_status', 0);
        $this->db->order_by('student_name', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function get_graded_worship_students($semester, $program, $level){
        $this->db->select('MATRIC_NO, STUDENT_NAME, SEMESTER_SCORE_ID, WORSHIP_SCORES');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('tbl_semester_students.semester_id', $semester);
        $this->db->where('tbl_semester_students.program_id', $program);
        $this->db->where('tbl_semester_students.level_id', $level);
        $this->db->where('worship_grader', $this->session->userdata('user_id'));
        $this->db->where('worship_status', 1);
        $this->db->where('admin_status', 0);
        $this->db->order_by('student_name', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function get_graded_students($semester, $program, $level){
        $this->db->select('MATRIC_NO, STUDENT_NAME, SEMESTER, SEMESTER_SCORE_ID, CHAPEL_SCORES, RESIDENCE_SCORES, WORSHIP_SCORES, CHAPEL_STATUS, RESIDENCE_STATUS, WORSHIP_STATUS, CHAPEL_GRADER, RESIDENCE_GRADER, WORSHIP_GRADER');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('tbl_semester_students.semester_id', $semester);
        $this->db->where('tbl_semester_students.program_id', $program);
        $this->db->where('tbl_semester_students.level_id', $level);
        $this->db->where('admin_status', 0);
        $this->db->order_by('student_name', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function get_forwarded_students($semester, $program, $level){

        $this->db->select('MATRIC_NO, STUDENT_NAME, SEMESTER_SCORE_ID, CHAPEL_SCORES, RESIDENCE_SCORES, WORSHIP_SCORES, CHAPEL_STATUS, RESIDENCE_STATUS, WORSHIP_STATUS, CHAPEL_GRADER, RESIDENCE_GRADER, WORSHIP_GRADER');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('tbl_semester_students.semester_id', $semester);
        $this->db->where('tbl_semester_students.program_id', $program);
        $this->db->where('tbl_semester_students.level_id', $level);
        $this->db->where('admin_status', 1);
        $this->db->order_by('student_name', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function get_resubmission_chapel_students(){
        $this->db->select('MATRIC_NO, STUDENT_NAME, SEMESTER_SCORE_ID, CHAPEL_SCORES, SEMESTER, PROGRAM, LEVEL');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('chapel_status', 2);
        $this->db->where('chapel_grader', $this->session->userdata('user_id'));
        $this->db->order_by('student_name', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function get_resubmitted_chapel_students(){
        $this->db->select('MATRIC_NO, STUDENT_NAME, SEMESTER_SCORE_ID, CHAPEL_SCORES, CHAPEL_OLD_SCORE, SEMESTER, PROGRAM, LEVEL');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('chapel_status', 5);
        $this->db->where('chapel_grader', $this->session->userdata('user_id'));
        $this->db->order_by('student_name', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function get_accepted_chapel_requests(){
        $this->db->select('SEMESTER_SCORE_ID, tbl_semester_students.SEMESTER_ID, MATRIC_NO, STUDENT_NAME, SEMESTER, PROGRAM, LEVEL, CHAPEL_APPROVAL_REASON, CHAPEL_REASON, CHAPEL_SCORES');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('chapel_status', 3);
        $this->db->where('chapel_grader', $this->session->userdata('user_id'));
        $this->db->order_by('student_name', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function get_rejected_chapel_requests(){
        $this->db->select('SEMESTER_SCORE_ID, tbl_semester_students.SEMESTER_ID, MATRIC_NO, STUDENT_NAME, SEMESTER, PROGRAM, LEVEL, CHAPEL_APPROVAL_REASON, CHAPEL_REASON, CHAPEL_SCORES');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('chapel_status', 4);
        $this->db->where('chapel_grader', $this->session->userdata('user_id'));
        $this->db->order_by('student_name', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function get_resubmission_residence_students(){
        $this->db->select('SEMESTER_SCORE_ID, tbl_semester_students.SEMESTER_ID, MATRIC_NO, STUDENT_NAME, SEMESTER, PROGRAM, LEVEL, RESIDENCE_APPROVAL_REASON, RESIDENCE_REASON, RESIDENCE_SCORES');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('residence_status', 2);
        $this->db->where('residence_grader', $this->session->userdata('user_id'));
        $this->db->order_by('student_name', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function get_resubmitted_residence_students(){
        $this->db->select('SEMESTER_SCORE_ID, tbl_semester_students.SEMESTER_ID, MATRIC_NO, STUDENT_NAME, SEMESTER, PROGRAM, LEVEL, RESIDENCE_APPROVAL_REASON, RESIDENCE_REASON, RESIDENCE_SCORES, RESIDENCE_OLD_SCORE');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('residence_status', 5);
        $this->db->where('residence_grader', $this->session->userdata('user_id'));
        $this->db->order_by('student_name', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function get_accepted_residence_requests(){
        $this->db->select('SEMESTER_SCORE_ID, tbl_semester_students.SEMESTER_ID, MATRIC_NO, STUDENT_NAME, SEMESTER, PROGRAM, LEVEL, RESIDENCE_APPROVAL_REASON, RESIDENCE_REASON, RESIDENCE_SCORES');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('residence_status', 3);
        $this->db->where('residence_grader', $this->session->userdata('user_id'));
        $this->db->order_by('student_name', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function get_rejected_residence_requests(){
        $this->db->select('SEMESTER_SCORE_ID, tbl_semester_students.SEMESTER_ID, MATRIC_NO, STUDENT_NAME, SEMESTER, PROGRAM, LEVEL, RESIDENCE_APPROVAL_REASON, RESIDENCE_REASON, RESIDENCE_SCORES');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('residence_status', 4);
        $this->db->where('residence_grader', $this->session->userdata('user_id'));
        $this->db->order_by('student_name', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function get_resubmission_worship_students(){
        $this->db->select('SEMESTER_SCORE_ID, tbl_semester_students.SEMESTER_ID, MATRIC_NO, STUDENT_NAME, SEMESTER, PROGRAM, LEVEL, WORSHIP_APPROVAL_REASON, WORSHIP_REASON, WORSHIP_SCORES');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('worship_status', 2);
        $this->db->where('worship_grader', $this->session->userdata('user_id'));
        $this->db->order_by('student_name', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function get_resubmitted_worship_students(){
        $this->db->select('SEMESTER_SCORE_ID, tbl_semester_students.SEMESTER_ID, MATRIC_NO, STUDENT_NAME, SEMESTER, PROGRAM, LEVEL, WORSHIP_APPROVAL_REASON, WORSHIP_REASON, WORSHIP_SCORES');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('worship_status', 5);
        $this->db->where('worship_grader', $this->session->userdata('user_id'));
        $this->db->order_by('student_name', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function get_accepted_worship_requests(){
        $this->db->select('SEMESTER_SCORE_ID, tbl_semester_students.SEMESTER_ID, MATRIC_NO, STUDENT_NAME, SEMESTER, PROGRAM, LEVEL, WORSHIP_APPROVAL_REASON, WORSHIP_REASON, WORSHIP_SCORES');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('worship_status', 3);
        $this->db->where('worship_grader', $this->session->userdata('user_id'));
        $this->db->order_by('student_name', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function get_grading_worship_students(){
        $this->db->select('SEMESTER_SCORE_ID, tbl_semester_students.SEMESTER_ID, MATRIC_NO, STUDENT_NAME, SEMESTER, PROGRAM, LEVEL, WORSHIP_APPROVAL_REASON, WORSHIP_REASON, WORSHIP_SCORES');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('worship_status', 0);
        $this->db->where('worship_grader', $this->session->userdata('user_id'));
        $this->db->order_by('student_name', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function get_rejected_worship_requests(){
        $this->db->select('SEMESTER_SCORE_ID, tbl_semester_students.SEMESTER_ID, MATRIC_NO, STUDENT_NAME, SEMESTER, PROGRAM, LEVEL, WORSHIP_APPROVAL_REASON, WORSHIP_REASON, WORSHIP_SCORES');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('worship_status', 4);
        $this->db->where('worship_grader', $this->session->userdata('user_id'));
        $this->db->order_by('student_name', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function get_resubmission_admin_chapel_students(){
        $this->db->select('tbl_semester_students.SEMESTER_ID, SEMESTER, PROGRAM, LEVEL, MATRIC_NO, STUDENT_NAME, SEMESTER_SCORE_ID, CHAPEL_SCORES, CHAPEL_STATUS, FIRSTNAME, SURNAME, title, CHAPEL_REASON');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->join('tbl_login', 'tbl_login.login_id = tbl_semester_scores.chapel_grader');
        $this->db->join('tbl_titles', 'tbl_login.title_id = tbl_titles.titleId');
        $this->db->where('chapel_status', 2);
        $this->db->order_by('student_name', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function get_resubmission_admin_residence_students(){
        $this->db->select('tbl_semester_students.SEMESTER_ID, SEMESTER, PROGRAM, LEVEL, MATRIC_NO, STUDENT_NAME, SEMESTER_SCORE_ID, RESIDENCE_SCORES, RESIDENCE_OLD_SCORE, RESIDENCE_STATUS, FIRSTNAME, SURNAME, title, SEMESTER, PROGRAM, RESIDENCE_NAME, LEVEL, RESIDENCE_REASON');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->join('tbl_residence', 'tbl_semester_students.residence_id = tbl_residence.residence_id');
        $this->db->join('tbl_login', 'tbl_login.login_id = tbl_semester_scores.residence_grader');
        $this->db->join('tbl_titles', 'tbl_login.title_id = tbl_titles.titleId');
        $this->db->where('residence_status', 2);
        $this->db->where('tbl_semester_students.gender_id', $this->session->userdata('subrole'));
        $this->db->order_by('student_name', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function get_resubmission_admin_worship_students(){
        $this->db->select('tbl_semester_students.SEMESTER_ID, SEMESTER, PROGRAM, LEVEL, MATRIC_NO, STUDENT_NAME, SEMESTER_SCORE_ID, WORSHIP_SCORES, WORSHIP_STATUS, FIRSTNAME, SURNAME, title, WORSHIP_REASON');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->join('tbl_login', 'tbl_login.login_id = tbl_semester_scores.worship_grader');
        $this->db->join('tbl_titles', 'tbl_login.title_id = tbl_titles.titleId');
        $this->db->where('worship_status', 2);
        $this->db->order_by('student_name', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function get_pending_resubmission_admin_chapel_students(){
        $this->db->select('tbl_semester_students.SEMESTER_ID, SEMESTER, PROGRAM, LEVEL, MATRIC_NO, STUDENT_NAME, SEMESTER_SCORE_ID, CHAPEL_SCORES, CHAPEL_STATUS, FIRSTNAME, SURNAME, title, CHAPEL_REASON, CHAPEL_APPROVAL_REASON');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->join('tbl_login', 'tbl_login.login_id = tbl_semester_scores.chapel_grader');
        $this->db->join('tbl_titles', 'tbl_login.title_id = tbl_titles.titleId');
        $this->db->where('chapel_status', 3);
        $this->db->order_by('student_name', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function get_pending_resubmission_admin_residence_students(){
        $this->db->select('tbl_semester_students.SEMESTER_ID, SEMESTER, PROGRAM, LEVEL, MATRIC_NO, STUDENT_NAME, SEMESTER_SCORE_ID, RESIDENCE_SCORES, RESIDENCE_OLD_SCORE, RESIDENCE_STATUS, FIRSTNAME, SURNAME, title, SEMESTER, PROGRAM, RESIDENCE_NAME, LEVEL, RESIDENCE_REASON, RESIDENCE_APPROVAL_REASON');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->join('tbl_residence', 'tbl_semester_students.residence_id = tbl_residence.residence_id');
        $this->db->join('tbl_login', 'tbl_login.login_id = tbl_semester_scores.residence_grader');
        $this->db->join('tbl_titles', 'tbl_login.title_id = tbl_titles.titleId');
        $this->db->where('residence_status', 3);
        $this->db->order_by('student_name', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function get_pending_resubmission_admin_worship_students(){
        $this->db->select('tbl_semester_students.SEMESTER_ID, SEMESTER, PROGRAM, LEVEL, MATRIC_NO, STUDENT_NAME, SEMESTER_SCORE_ID, WORSHIP_SCORES, WORSHIP_STATUS, FIRSTNAME, SURNAME, title, WORSHIP_REASON, WORSHIP_APPROVAL_REASON');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->join('tbl_login', 'tbl_login.login_id = tbl_semester_scores.worship_grader');
        $this->db->join('tbl_titles', 'tbl_login.title_id = tbl_titles.titleId');
        $this->db->where('worship_status', 3);
        $this->db->order_by('student_name', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function get_resubmissions_admin_chapel_students(){
        $this->db->select('tbl_semester_students.SEMESTER_ID, SEMESTER, PROGRAM, LEVEL, MATRIC_NO, STUDENT_NAME, SEMESTER_SCORE_ID, CHAPEL_SCORES, CHAPEL_OLD_SCORE, CHAPEL_STATUS, FIRSTNAME, SURNAME, title, CHAPEL_REASON, CHAPEL_APPROVAL_REASON');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->join('tbl_login', 'tbl_login.login_id = tbl_semester_scores.chapel_grader');
        $this->db->join('tbl_titles', 'tbl_login.title_id = tbl_titles.titleId');
        $this->db->where('chapel_status', 5);
        $this->db->order_by('student_name', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function get_resubmissions_admin_residence_students(){
        $this->db->select('tbl_semester_students.SEMESTER_ID, SEMESTER, PROGRAM, LEVEL, MATRIC_NO, STUDENT_NAME, SEMESTER_SCORE_ID, RESIDENCE_SCORES, RESIDENCE_OLD_SCORE, RESIDENCE_STATUS, FIRSTNAME, SURNAME, title, SEMESTER, PROGRAM, RESIDENCE_NAME, LEVEL, RESIDENCE_REASON, RESIDENCE_APPROVAL_REASON');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->join('tbl_residence', 'tbl_semester_students.residence_id = tbl_residence.residence_id');
        $this->db->join('tbl_login', 'tbl_login.login_id = tbl_semester_scores.residence_grader');
        $this->db->join('tbl_titles', 'tbl_login.title_id = tbl_titles.titleId');
        $this->db->where('residence_status', 5);
        $this->db->order_by('student_name', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function get_resubmissions_admin_worship_students(){
        $this->db->select('tbl_semester_students.SEMESTER_ID, SEMESTER, PROGRAM, LEVEL, MATRIC_NO, STUDENT_NAME, SEMESTER_SCORE_ID, WORSHIP_SCORES, WORSHIP_OLD_SCORE, WORSHIP_STATUS, FIRSTNAME, SURNAME, title, WORSHIP_REASON, WORSHIP_APPROVAL_REASON');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->join('tbl_login', 'tbl_login.login_id = tbl_semester_scores.worship_grader');
        $this->db->join('tbl_titles', 'tbl_login.title_id = tbl_titles.titleId');
        $this->db->where('worship_status', 5);
        $this->db->order_by('student_name', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function get_rejected_admin_chapel_students(){
        $this->db->select('tbl_semester_students.SEMESTER_ID, SEMESTER, PROGRAM, LEVEL, MATRIC_NO, STUDENT_NAME, SEMESTER_SCORE_ID, CHAPEL_SCORES, CHAPEL_STATUS, FIRSTNAME, SURNAME, title, CHAPEL_REASON, CHAPEL_APPROVAL_REASON');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->join('tbl_login', 'tbl_login.login_id = tbl_semester_scores.chapel_grader');
        $this->db->join('tbl_titles', 'tbl_login.title_id = tbl_titles.titleId');
        $this->db->where('chapel_status', 4);
        $this->db->order_by('student_name', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function get_rejected_admin_residence_students(){
        $this->db->select('tbl_semester_students.SEMESTER_ID, SEMESTER, PROGRAM, LEVEL, MATRIC_NO, STUDENT_NAME, SEMESTER_SCORE_ID, RESIDENCE_SCORES, RESIDENCE_OLD_SCORE, RESIDENCE_STATUS, FIRSTNAME, SURNAME, title, SEMESTER, PROGRAM, RESIDENCE_NAME, LEVEL, RESIDENCE_REASON, RESIDENCE_APPROVAL_REASON');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->join('tbl_residence', 'tbl_semester_students.residence_id = tbl_residence.residence_id');
        $this->db->join('tbl_login', 'tbl_login.login_id = tbl_semester_scores.residence_grader');
        $this->db->join('tbl_titles', 'tbl_login.title_id = tbl_titles.titleId');
        $this->db->where('residence_status', 4);
        $this->db->order_by('student_name', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function get_rejected_admin_worship_students(){
        $this->db->select('tbl_semester_students.SEMESTER_ID, SEMESTER, PROGRAM, LEVEL, MATRIC_NO, STUDENT_NAME, SEMESTER_SCORE_ID, WORSHIP_SCORES, WORSHIP_STATUS, FIRSTNAME, SURNAME, title, WORSHIP_REASON, WORSHIP_APPROVAL_REASON');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->join('tbl_login', 'tbl_login.login_id = tbl_semester_scores.worship_grader');
        $this->db->join('tbl_titles', 'tbl_login.title_id = tbl_titles.titleId');
        $this->db->where('worship_status', 4);
        $this->db->order_by('student_name', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }
}
