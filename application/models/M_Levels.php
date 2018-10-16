<?php

/**
 * Created by PhpStorm.
 * User: ebene
 * Date: 12/1/2016
 * Time: 12:37 PM
 */
class M_Levels extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_level($level_id){
        $this->db->select('*');
        $this->db->from('tbl_levels');
        $this->db->where('level_id', $level_id);
        $query = $this->db->get();

        return $query->result();
    }

    function get_all_levels(){
        $this->db->select('*');
        $this->db->from('tbl_levels');
        $query = $this->db->get();

        return $query->result();
    }

    function get_current_chapel_levels($semester, $program){
        $this->db->select('LEVEL, tbl_programs.PROGRAM_ID, tbl_semesters.SEMESTER_ID, tbl_levels.LEVEL_ID');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('tbl_semester_students.semester_id', $semester);
        $this->db->where('tbl_semester_students.program_id', $program);
        $this->db->where('chapel_status', 0);
        $this->db->where('admin_status', 0);
        $this->db->group_by('level');
        $query = $this->db->get();

        return $query->result();
    }

    function get_graded_chapel_levels($semester, $program){
        $this->db->select('LEVEL, tbl_programs.PROGRAM_ID, tbl_semesters.SEMESTER_ID, tbl_levels.LEVEL_ID');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('tbl_semester_students.semester_id', $semester);
        $this->db->where('tbl_semester_students.program_id', $program);
        $this->db->where('chapel_grader', $this->session->userdata('user_id'));
        $this->db->where('chapel_status', 1);
        $this->db->where('admin_status', 0);
        $this->db->group_by('level');
        $query = $this->db->get();

        return $query->result();
    }

    function get_current_residence_levels($semester, $program){
        $this->db->select('LEVEL, tbl_programs.PROGRAM_ID, tbl_semesters.SEMESTER_ID, tbl_levels.LEVEL_ID');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('tbl_semester_students.semester_id', $semester);
        $this->db->where('tbl_semester_students.program_id', $program);
        $this->db->where('residence_id', $this->session->userdata('subrole'));
        $this->db->where('residence_status', 0);
        $this->db->like('gender_id', $this->session->userdata('subrole2'));
        $this->db->group_by('level');
        $query = $this->db->get();

        return $query->result();
    }

    function get_graded_residence_levels($semester, $program){
        $this->db->select('LEVEL, tbl_programs.PROGRAM_ID, tbl_semesters.SEMESTER_ID, tbl_levels.LEVEL_ID');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('tbl_semester_students.semester_id', $semester);
        $this->db->where('tbl_semester_students.program_id', $program);
        $this->db->where('residence_grader', $this->session->userdata('user_id'));
        $this->db->where('residence_id', $this->session->userdata('subrole'));
        $this->db->where('residence_status', 6);
        $this->db->where('admin_status', 0);
        $this->db->group_by('level');
        $query = $this->db->get();

        return $query->result();
    }

    function get_forwarded_residence_levels($semester, $program){
        $this->db->select('LEVEL, tbl_programs.PROGRAM_ID, tbl_semesters.SEMESTER_ID, tbl_levels.LEVEL_ID');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('tbl_semester_students.semester_id', $semester);
        $this->db->where('tbl_semester_students.program_id', $program);
        $this->db->where('residence_grader', $this->session->userdata('user_id'));
        $this->db->where('residence_id', $this->session->userdata('subrole'));
        $this->db->where('residence_status', 1);
        $this->db->group_by('level');
        $query = $this->db->get();

        return $query->result();
    }
    function get_chiefhall_graded_residence_levels($semester){
        $this->db->select('LEVEL, tbl_levels.LEVEL_ID');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('tbl_semester_students.semester_id', $semester);
        $this->db->where('gender_id', $this->session->userdata('subrole'));
        $this->db->where('residence_status', 1);
        $this->db->where('admin_status', 0);
        $this->db->group_by('level');
        $this->db->order_by('level');
        $query = $this->db->get();

        return $query->result();
    }
    function get_chiefhall_forwarded_residence_levels($semester){
        $this->db->select('LEVEL, tbl_levels.LEVEL_ID');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('tbl_semester_students.semester_id', $semester);
        $this->db->where('gender_id', $this->session->userdata('subrole'));
        $this->db->where('admin_status', 1);
        $this->db->group_by('level');
        $this->db->order_by('level');
        $query = $this->db->get();

        return $query->result();
    }

    function get_current_worship_levels($semester, $program){
        $this->db->select('LEVEL, tbl_programs.PROGRAM_ID, tbl_semesters.SEMESTER_ID, tbl_levels.LEVEL_ID');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('tbl_semester_students.semester_id', $semester);
        $this->db->where('tbl_semester_students.program_id', $program);
        $this->db->where('worship_status', 0);
        $this->db->where('admin_status', 0);
        $this->db->group_by('level');
        $query = $this->db->get();

        return $query->result();
    }

    function get_graded_worship_levels($semester, $program){
        $this->db->select('LEVEL, tbl_programs.PROGRAM_ID, tbl_semesters.SEMESTER_ID, tbl_levels.LEVEL_ID');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('tbl_semester_students.semester_id', $semester);
        $this->db->where('tbl_semester_students.program_id', $program);
        $this->db->where('worship_grader', $this->session->userdata('user_id'));
        $this->db->where('worship_status', 1);
        $this->db->where('admin_status', 0);
        $this->db->group_by('level');
        $query = $this->db->get();

        return $query->result();
    }

    function get_graded_levels($semester, $program){
        $this->db->select('LEVEL, tbl_programs.PROGRAM_ID, tbl_semesters.SEMESTER_ID, tbl_levels.LEVEL_ID');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('tbl_semester_students.semester_id', $semester);
        $this->db->where('tbl_semester_students.program_id', $program);
        $this->db->where('admin_status', 0);
        $this->db->group_by('level');
        $query = $this->db->get();

        return $query->result();
    }

    function get_forwarded_levels($semester, $program){
        $this->db->select('LEVEL, tbl_programs.PROGRAM_ID, tbl_semesters.SEMESTER_ID, tbl_levels.LEVEL_ID');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('tbl_semester_students.semester_id', $semester);
        $this->db->where('tbl_semester_students.program_id', $program);
        $this->db->where('admin_status', 1);
        $this->db->group_by('level');
        $query = $this->db->get();

        return $query->result();
    }

    function get_if_grade_chapel_levels_started($semester, $program, $level){
        $this->db->select('LEVEL, tbl_programs.PROGRAM_ID, tbl_semesters.SEMESTER_ID, tbl_levels.LEVEL_ID');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('tbl_semester_students.semester_id', $semester);
        $this->db->where('tbl_semester_students.program_id', $program);
        $this->db->where('tbl_semester_students.level_id', $level);
        $this->db->where('chapel_scores !=', NULL);
        $query = $this->db->get();

        return $query->result();
    }

    function get_if_grade_chapel_levels_finished($semester, $program, $level){
        $this->db->select('LEVEL, tbl_programs.PROGRAM_ID, tbl_semesters.SEMESTER_ID, tbl_levels.LEVEL_ID');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('tbl_semester_students.semester_id', $semester);
        $this->db->where('tbl_semester_students.program_id', $program);
        $this->db->where('tbl_semester_students.level_id', $level);
        $this->db->where('chapel_scores =', NULL);
        $query = $this->db->get();

        return $query->result();
    }

    function get_if_grade_residence_levels_started($semester, $program, $level){
        $this->db->select('LEVEL, tbl_programs.PROGRAM_ID, tbl_semesters.SEMESTER_ID, tbl_levels.LEVEL_ID');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('tbl_semester_students.semester_id', $semester);
        $this->db->where('tbl_semester_students.program_id', $program);
        $this->db->where('tbl_semester_students.level_id', $level);
        $this->db->where('residence_id', $this->session->userdata('subrole'));
        $this->db->where('residence_scores !=', NULL);
        $query = $this->db->get();

        return $query->result();
    }

    function get_if_grade_residence_levels_finished($semester, $program, $level){
        $this->db->select('LEVEL, tbl_programs.PROGRAM_ID, tbl_semesters.SEMESTER_ID, tbl_levels.LEVEL_ID, RESIDENCE_NAME');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_residence', 'tbl_semester_students.residence_id = tbl_residence.residence_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('tbl_semester_students.semester_id', $semester);
        $this->db->where('tbl_semester_students.program_id', $program);
        $this->db->where('tbl_semester_students.level_id', $level);
        $this->db->where('tbl_semester_students.residence_id', $this->session->userdata('subrole'));
        $this->db->like('tbl_semester_students.gender_id', $this->session->userdata('subrole2'));
        $this->db->where('residence_scores =', NULL);
        $query = $this->db->get();

        return $query->result();
    }

    function get_if_grade_worship_levels_started($semester, $program, $level){
        $this->db->select('LEVEL, tbl_programs.PROGRAM_ID, tbl_semesters.SEMESTER_ID, tbl_levels.LEVEL_ID');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('tbl_semester_students.semester_id', $semester);
        $this->db->where('tbl_semester_students.program_id', $program);
        $this->db->where('tbl_semester_students.level_id', $level);
        $this->db->where('worship_scores !=', NULL);
        $query = $this->db->get();

        return $query->result();
    }

    function get_if_grade_worship_levels_finished($semester, $program, $level){
        $this->db->select('LEVEL, tbl_programs.PROGRAM_ID, tbl_semesters.SEMESTER_ID, tbl_levels.LEVEL_ID');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('tbl_semester_students.semester_id', $semester);
        $this->db->where('tbl_semester_students.program_id', $program);
        $this->db->where('tbl_semester_students.level_id', $level);
        $this->db->where('worship_scores =', NULL);
        $query = $this->db->get();

        return $query->result();
    }

    function get_if_any_submissions($semester, $program, $level){
        $this->db->select('LEVEL, tbl_programs.PROGRAM_ID, tbl_semesters.SEMESTER_ID, tbl_levels.LEVEL_ID');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('tbl_semester_students.semester_id', $semester);
        $this->db->where('tbl_semester_students.program_id', $program);
        $this->db->where('tbl_semester_students.level_id', $level);
        $this->db->where("(chapel_status = 1 OR residence_status = 1 OR worship_status = 1 OR chapel_status = 5 OR residence_status = 5 OR worship_status = 5 OR chapel_status = 4 OR residence_status = 4 OR worship_status = 4)");
        $query = $this->db->get();

        return $query->result();
    }

    function get_if_fully_submitted($semester, $program, $level){
        $this->db->select('LEVEL, tbl_programs.PROGRAM_ID, tbl_semesters.SEMESTER_ID, tbl_levels.LEVEL_ID');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semesters', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_programs', 'tbl_semester_students.program_id = tbl_programs.program_id');
        $this->db->join('tbl_levels', 'tbl_semester_students.level_id = tbl_levels.level_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('tbl_semester_students.semester_id', $semester);
        $this->db->where('tbl_semester_students.program_id', $program);
        $this->db->where('tbl_semester_students.level_id', $level);
        $this->db->where("(chapel_status != 0 OR residence_status != 0 OR worship_status != 0)");

        $query = $this->db->get();

        return $query->result();
    }
}
