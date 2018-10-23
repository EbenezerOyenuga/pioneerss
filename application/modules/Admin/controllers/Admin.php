<?php



class Admin extends MY_Controller{

    function __construct()
    {
        parent::__construct();
        $this->load->module([
            'ActionUnit', 'Requirements'
        ]);
        $this->load->model([
            'M_ActionUnit', 'M_Students'
        ]);
    }

    function index(){
        $data['page_title'] = 'Dashboard';
        $data['count_action_units'] = $this->M_ActionUnit->count_action_units();
        $data['count_students'] = $this->M_Students->count_students();
        $data['content_view'] = 'Admin/home_v';
        $this->admintemplate->call_admin_template($data);
    }

    function load_semesters(){
        $this->loadstudents->display_semesters();
    }
    
    function load_programs($semester_id){
        $this->loadstudents->display_programs($semester_id);
    }
    function load_semester_programs($semester_id){
        $this->requirements->display_semester_programs($semester_id);
    }
    function action_unit(){
        $this->actionunit->display_action_units();
    }
    function student_action_unit($id){
        $this->actionunit->students_action_unit($id);
    }
    function edit_action_unit($id){
        $this->actionunit->edit_action_unit($id);
    }
    function change_password(){
        $this->users->display_change_password();
    }
    function requirements(){
        $this->requirements->display_requirements();
    }

}
