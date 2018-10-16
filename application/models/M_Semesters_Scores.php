<?php

/**
 * Created by PhpStorm.
 * User: ebene
 * Date: 12/1/2016
 * Time: 12:37 PM
 */
class M_Semesters_Scores extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function load_semesterstudent($semester_student_id){

        $posted_data = array(
            'semester_student_id' => $semester_student_id
        );
        $this->db->insert('tbl_semester_scores', $posted_data);

    }

    function update_residence_score($semester_score_id, $student_score, $status){
        $this->db->set('RESIDENCE_SCORES', $student_score);
        $this->db->set('RESIDENCE_GRADER', $this->session->userdata('user_id'));
        $this->db->set('RESIDENCE_STATUS', $status);
        $this->db->where('SEMESTER_SCORE_ID', $semester_score_id);

        return $this->db->update('tbl_semester_scores');

    }

    function forward_score($semester_score_id, $status){
        $this->db->set('ADMIN_STATUS', $status);
        $this->db->where('SEMESTER_SCORE_ID', $semester_score_id);

        return $this->db->update('tbl_semester_scores');

    }

    function forward_chiefhall_score($semester_score_id, $status){
        $this->db->set('RESIDENCE_STATUS', $status);
        $this->db->where('SEMESTER_SCORE_ID', $semester_score_id);

        return $this->db->update('tbl_semester_scores');

    }

    function return_score($semester_score_id, $status){
        $this->db->set('ADMIN_STATUS', $status);
        $this->db->where('SEMESTER_SCORE_ID', $semester_score_id);

        return $this->db->update('tbl_semester_scores');

    }

    function update_residence_resubmit_score($semester_score_id, $student_old_score, $student_score, $status){
        $this->db->set('RESIDENCE_SCORES', $student_score);
        $this->db->set('RESIDENCE_OLD_SCORE', $student_old_score);
        $this->db->set('RESIDENCE_GRADER', $this->session->userdata('user_id'));
        $this->db->set('RESIDENCE_STATUS', $status);
        $this->db->where('SEMESTER_SCORE_ID', $semester_score_id);

        return $this->db->update('tbl_semester_scores');

    }

    function update_chapel_score($semester_score_id, $student_score, $status){
        $this->db->set('CHAPEL_SCORES', $student_score);
        $this->db->set('CHAPEL_GRADER', $this->session->userdata('user_id'));
        $this->db->set('CHAPEL_STATUS', $status);
        $this->db->where('SEMESTER_SCORE_ID', $semester_score_id);

        return $this->db->update('tbl_semester_scores');

    }

    function update_chapel_resubmit_score($semester_score_id, $student_old_score, $student_score, $status){
        $this->db->set('CHAPEL_SCORES', $student_score);
        $this->db->set('CHAPEL_OLD_SCORE', $student_old_score);
        $this->db->set('CHAPEL_GRADER', $this->session->userdata('user_id'));
        $this->db->set('CHAPEL_STATUS', $status);
        $this->db->where('SEMESTER_SCORE_ID', $semester_score_id);

        return $this->db->update('tbl_semester_scores');

    }

    function update_worship_score($semester_score_id, $student_score, $status){
        $this->db->set('WORSHIP_SCORES', $student_score);
        $this->db->set('WORSHIP_GRADER', $this->session->userdata('user_id'));
        $this->db->set('WORSHIP_STATUS', $status);
        $this->db->where('SEMESTER_SCORE_ID', $semester_score_id);

        return $this->db->update('tbl_semester_scores');

    }

    function update_worship_resubmit_score($semester_score_id, $student_old_score, $student_score, $status){
        $this->db->set('WORSHIP_SCORES', $student_score);
        $this->db->set('WORSHIP_OLD_SCORE', $student_old_score);
        $this->db->set('WORSHIP_GRADER', $this->session->userdata('user_id'));
        $this->db->set('WORSHIP_STATUS', $status);
        $this->db->where('SEMESTER_SCORE_ID', $semester_score_id);

        return $this->db->update('tbl_semester_scores');

    }

    function if_grade_submitted($semester_id, $residence, $level){
        $this->db->select('*');
        $this->db->from('tbl_semesters');
        $this->db->join('tbl_semester_students', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('tbl_semesters.semester_id', $semester_id);
        $this->db->where('residence_id', $residence);
        $this->db->where('level', $level);
        $this->db->where('hall_status', 0);
        $query = $this->db->get();

        return $query->result();
    }

    function update_residence_status($semester_score_id, $status, $comment)
    {
        $this->db->set('RESIDENCE_STATUS', $status);
        $this->db->set('RESIDENCE_REASON', $comment);
        $this->db->where('SEMESTER_SCORE_ID', $semester_score_id);
        return $this->db->update('tbl_semester_scores');
    }

    function update_chapel_status($semester_score_id, $status, $comment)
    {
        $this->db->set('CHAPEL_STATUS', $status);
        $this->db->set('CHAPEL_REASON', $comment);
        $this->db->where('SEMESTER_SCORE_ID', $semester_score_id);
        return $this->db->update('tbl_semester_scores');
    }

    function update_worship_status($semester_score_id, $status, $comment)
    {
        $this->db->set('WORSHIP_STATUS', $status);
        $this->db->set('WORSHIP_REASON', $comment);
        $this->db->where('SEMESTER_SCORE_ID', $semester_score_id);
        return $this->db->update('tbl_semester_scores');
    }

    function update_admin_chapel_status($semester_score_id, $status, $comment)
    {
        $this->db->set('CHAPEL_STATUS', $status);
        $this->db->set('CHAPEL_APPROVAL_REASON', $comment);
        $this->db->where('SEMESTER_SCORE_ID', $semester_score_id);
        return $this->db->update('tbl_semester_scores');
    }

    function update_admin_residence_status($semester_score_id, $status, $comment)
    {
        $this->db->set('RESIDENCE_STATUS', $status);
        $this->db->set('RESIDENCE_APPROVAL_REASON', $comment);
        $this->db->where('SEMESTER_SCORE_ID', $semester_score_id);
        return $this->db->update('tbl_semester_scores');
    }

    function update_admin_worship_status($semester_score_id, $status, $comment)
    {
        $this->db->set('WORSHIP_STATUS', $status);
        $this->db->set('WORSHIP_APPROVAL_REASON', $comment);
        $this->db->where('SEMESTER_SCORE_ID', $semester_score_id);
        return $this->db->update('tbl_semester_scores');
    }

    function get_resubmission_requests()
    {
        $this->db->select('*');
        $this->db->from('tbl_semesters');
        $this->db->join('tbl_semester_students', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('worship_status', 2);
        $this->db->or_where('residence_status', 2);
        $this->db->or_where('chapel_status', 2);
        $query = $this->db->get();

        return $query->result();
    }

    function get_pending_resubmissions()
    {
        $this->db->select('semester_score_id');
        $this->db->from('tbl_semesters');
        $this->db->join('tbl_semester_students', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('worship_status', 3);
        $this->db->or_where('residence_status', 3);
        $this->db->or_where('chapel_status', 3);
        $query = $this->db->get();

        return $query->result();
    }

    function get_resubmissions()
    {
        $this->db->select('semester_score_id');
        $this->db->from('tbl_semesters');
        $this->db->join('tbl_semester_students', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('worship_status', 5);
        $this->db->or_where('residence_status', 5);
        $this->db->or_where('chapel_status', 5);
        $query = $this->db->get();

        return $query->result();
    }

    function get_rejections()
    {
        $this->db->select('semester_score_id');
        $this->db->from('tbl_semesters');
        $this->db->join('tbl_semester_students', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('worship_status', 4);
        $this->db->or_where('residence_status', 4);
        $this->db->or_where('chapel_status', 4);
        $query = $this->db->get();

        return $query->result();
    }

    function get_forward()
    {
        $this->db->select('semester_score_id');
        $this->db->from('tbl_semesters');
        $this->db->join('tbl_semester_students', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('admin_status', 1);
        $query = $this->db->get();

        return $query->result();
    }

    function get_chiefresidence_resubmission_requests()
    {
        $this->db->select('*');
        $this->db->from('tbl_semesters');
        $this->db->join('tbl_semester_students', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->or_where('residence_status', 2);
        $query = $this->db->get();

        return $query->result();
    }

    function get_residence_pending_resubmissions()
    {
        $this->db->select('*');
        $this->db->from('tbl_semesters');
        $this->db->join('tbl_semester_students', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->or_where('residence_status', 3);
        $query = $this->db->get();

        return $query->result();
    }

    function get_chiefresidence_resubmissions()
    {
        $this->db->select('semester_score_id');
        $this->db->from('tbl_semesters');
        $this->db->join('tbl_semester_students', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->or_where('residence_status', 5);
        $query = $this->db->get();

        return $query->result();
    }

    function get_residence_rejections()
    {
        $this->db->select('semester_score_id');
        $this->db->from('tbl_semesters');
        $this->db->join('tbl_semester_students', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->or_where('residence_status', 4);
        $query = $this->db->get();

        return $query->result();
    }

    function get_residence_forward()
    {
        $this->db->select('semester_score_id');
        $this->db->from('tbl_semesters');
        $this->db->join('tbl_semester_students', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('residence_status', 1);
        $query = $this->db->get();

        return $query->result();
    }

    function get_worship_resubmission_requests()
    {
        $this->db->select('*');
        $this->db->from('tbl_semesters');
        $this->db->join('tbl_semester_students', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('worship_status', 2);
        $this->db->where('worship_grader', $this->session->userdata('user_id'));
        $query = $this->db->get();

        return $query->result();
    }

    function get_worship_resubmissions()
    {
        $this->db->select('*');
        $this->db->from('tbl_semesters');
        $this->db->join('tbl_semester_students', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('worship_status', 5);
        $this->db->where('worship_grader', $this->session->userdata('user_id'));
        $query = $this->db->get();

        return $query->result();
    }

    function get_worship_graded()
    {
        $this->db->select('*');
        $this->db->from('tbl_semesters');
        $this->db->join('tbl_semester_students', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('worship_status', 1);
        $this->db->where('worship_grader', $this->session->userdata('user_id'));
        $query = $this->db->get();

        return $query->result();
    }

    function get_worship_tograde()
    {
        $this->db->select('*');
        $this->db->from('tbl_semesters');
        $this->db->join('tbl_semester_students', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('worship_status', 0);
        $query = $this->db->get();

        return $query->result();
    }

    function get_searched_students($semester, $student){
        $this->db->select('*');
        $this->db->from('tbl_semester_students');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
          $this->db->group_start();
          $this->db->where('semester_id', $semester);
              $this->db->group_start();
                $this->db->like('matric_no', $student);
                $this->db->or_like('student_name', $student);
              $this->db->group_end();
              $this->db->group_start();
                $this->db->where('worship_status', 0);
              $this->db->group_end();
            $this->db->group_end();
        $query = $this->db->get();

        return $query->result();
    }

    function get_scores($semester_score_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_semester_scores');
        $this->db->where('semester_score_id', $semester_score_id);
        $query = $this->db->get();

        return $query->result();
    }

    function get_worship_accepted_requests()
    {
        $this->db->select('*');
        $this->db->from('tbl_semesters');
        $this->db->join('tbl_semester_students', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('worship_status', 3);
        $this->db->where('worship_grader', $this->session->userdata('user_id'));
        $query = $this->db->get();

        return $query->result();
    }

    function get_worship_rejected_requests()
    {
        $this->db->select('*');
        $this->db->from('tbl_semesters');
        $this->db->join('tbl_semester_students', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('worship_status', 4);
        $this->db->where('worship_grader', $this->session->userdata('user_id'));
        $query = $this->db->get();

        return $query->result();
    }

    function get_chapel_resubmission_requests()
    {
        $this->db->select('semester_score_id');
        $this->db->from('tbl_semesters');
        $this->db->join('tbl_semester_students', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('chapel_status', 2);
        $this->db->where('chapel_grader', $this->session->userdata('user_id'));
        $query = $this->db->get();

        return $query->result();
    }

    function get_chapel_resubmissions()
    {
        $this->db->select('semester_score_id');
        $this->db->from('tbl_semesters');
        $this->db->join('tbl_semester_students', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('chapel_status', 5);
        $this->db->where('chapel_grader', $this->session->userdata('user_id'));
        $query = $this->db->get();

        return $query->result();
    }

    function get_chapel_graded()
    {
        $this->db->select('semester_score_id');
        $this->db->from('tbl_semesters');
        $this->db->join('tbl_semester_students', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('chapel_status', 1);
        $this->db->where('chapel_grader', $this->session->userdata('user_id'));
        $query = $this->db->get();

        return $query->result();
    }

    function get_chapel_tograde()
    {
        $this->db->select('semester_score_id');
        $this->db->from('tbl_semesters');
        $this->db->join('tbl_semester_students', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('chapel_status', 0);
        $query = $this->db->get();

        return $query->result();
    }

    function get_chapel_accepted_requests()
    {
        $this->db->select('semester_score_id');
        $this->db->from('tbl_semesters');
        $this->db->join('tbl_semester_students', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('chapel_status', 3);
        $this->db->where('chapel_grader', $this->session->userdata('user_id'));
        $query = $this->db->get();

        return $query->result();
    }

    function get_chapel_rejected_requests()
    {
        $this->db->select('semester_score_id');
        $this->db->from('tbl_semesters');
        $this->db->join('tbl_semester_students', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('chapel_status', 4);
        $this->db->where('chapel_grader', $this->session->userdata('user_id'));
        $query = $this->db->get();

        return $query->result();
    }

    function get_residence_resubmission_requests()
    {
        $this->db->select('*');
        $this->db->from('tbl_semesters');
        $this->db->join('tbl_semester_students', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('residence_status', 2);
        $this->db->where('residence_grader', $this->session->userdata('user_id'));
        $query = $this->db->get();

        return $query->result();
    }

    function get_residence_resubmissions()
    {
        $this->db->select('*');
        $this->db->from('tbl_semesters');
        $this->db->join('tbl_semester_students', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('residence_status', 5);
        $this->db->where('residence_grader', $this->session->userdata('user_id'));
        $query = $this->db->get();

        return $query->result();
    }

    function get_residence_graded()
    {
        $this->db->select('*');
        $this->db->from('tbl_semesters');
        $this->db->join('tbl_semester_students', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('residence_status', 6);
        $this->db->where('residence_grader', $this->session->userdata('user_id'));
        $query = $this->db->get();

        return $query->result();
    }

    function get_residence_forwarded()
    {
        $this->db->select('*');
        $this->db->from('tbl_semesters');
        $this->db->join('tbl_semester_students', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('residence_status', 1);
        $this->db->where('residence_grader', $this->session->userdata('user_id'));
        $query = $this->db->get();

        return $query->result();
    }

    function get_residence_tograde()
    {
        $this->db->select('*');
        $this->db->from('tbl_semesters');
        $this->db->join('tbl_semester_students', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('residence_status', 0);
        $this->db->where('residence_id', $this->session->userdata('subrole'));
        $query = $this->db->get();

        return $query->result();
    }

    function get_residence_accepted_requests()
    {
        $this->db->select('*');
        $this->db->from('tbl_semesters');
        $this->db->join('tbl_semester_students', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('residence_status', 3);
        $this->db->where('residence_grader', $this->session->userdata('user_id'));
        $query = $this->db->get();

        return $query->result();
    }

    function get_residence_rejected_requests()
    {
        $this->db->select('*');
        $this->db->from('tbl_semesters');
        $this->db->join('tbl_semester_students', 'tbl_semester_students.semester_id = tbl_semesters.semester_id');
        $this->db->join('tbl_semester_scores', 'tbl_semester_students.semester_student_id = tbl_semester_scores.semester_student_id');
        $this->db->where('residence_status', 4);
        $this->db->where('residence_grader', $this->session->userdata('user_id'));
        $query = $this->db->get();

        return $query->result();
    }
}
