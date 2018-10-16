<?php

/**
 * Created by PhpStorm.
 * User: ebene
 * Date: 12/1/2016
 * Time: 6:39 AM
 */
class Users extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("M_Users");
    }
    function display_users(){
        $data = $this->get_data_from_post();
        $this->load->module("Titles");
        $this->load->module("Roles");
        $data['title'] = $this->titles->create_titles_select();
        $data['role'] = $this->roles->create_roles_select();
        $data['users_table'] = $this->create_user_table();
        // setting page up for adding user
        $data['add_update'] = 1;
        $data['button_title'] = 'Add User';
        $data['page_title'] = 'Users';
        $data['content_view'] = 'Users/users_display_v';
        $this->admintemplate->call_admin_template($data);

    }

    function display_change_password(){

        $this->load->module("Admintemplate");
        $data['button_title'] = 'Change Password';
        $data['page_title'] = 'Change Password';
        $data['content_view'] = 'Users/change_password_display_v';
        $this->admintemplate->call_admin_template($data);

    }

    function change_password(){
        // load form validation library
        $this->load->library('form_validation');
        $this->form_validation->set_rules('old_pass', 'Old Password', 'required');
        $this->form_validation->set_rules('new_pass', 'New Password', 'required');
        $this->form_validation->set_rules('con_pass', 'Confirm Password', 'required|matches[new_pass]');

        if ($this->form_validation->run() == FALSE){
            $this->load->module('Admintemplate');
            $this->display_change_password();

        }
        //if validation succeeds
        else{
            $this->load->model('M_Login');

            $userdetails = $this->M_Login->confirm_user_password($this->session->userdata('user_id'), sha1($this->input->post('old_pass')), $this->session->userdata('user_role'));

            if (count($userdetails) == 1){
                $this->M_Login->update_password();
                $this->session->set_flashdata('message', 'Password Updated successfully.');
                $this->display_change_password();

            }
            else{
                $this->session->set_flashdata('message', 'Incorrect Previous Password.');
                $this->display_change_password();
            }
        }

    }
    function get_data_from_post(){
        $data['id'] = $this->input->post('id', TRUE);
        $data['title'] = $this->input->post('title', TRUE);
        $data['firstname'] = $this->input->post('firstname', TRUE);
        $data['surname'] = $this->input->post('surname', TRUE);
        $data['email'] = $this->input->post('email', TRUE);
        $data['role'] = $this->input->post('role', TRUE);
        return $data;
    }
    function create_roles_select(){
        $this->load->model('M_Roles');

        $role = $this->M_Roles->get_active_roles();
        $options = "";
        if (count($role)){
            foreach ($role as $key => $value){
                $options .= "<option value = '{$value->ROLE_ID}'>{$value->ROLE}</option>";
            }
        }
        return $options;
    }
    function create_role_select($selected_role)
    {
        $this->load->model('M_Roles');

        $role = $this->M_Roles->get_active_roles();
        $options = "";

        if (count($role)) {
            foreach ($role as $key => $value) {
                if ($selected_role == $value->ROLE_ID) {
                    $selected = "selected=selected ";
                } else {
                    $selected = "";
                }
                $options .= "<option value = '{$value->ROLE_ID}' $selected>{$value->ROLE}</option>";

            }

            return $options;
        }
    }


    function post_user($add_update){
        // load form validation library
        $this->load->library('form_validation');
        $this->load->model('M_Roles');

        //rules for registration
        if ($add_update == 1)
            $this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email|is_unique[tbl_login.email]');
        else $this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
        $this->form_validation->set_rules('firstname', 'First Name', 'trim|required|min_length[3]|max_length[20]');
        $this->form_validation->set_rules('surname', 'Surname', 'trim|required|min_length[3]|max_length[20]');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('role', 'Role', 'required');

        // if validation fails
        if ($this->form_validation->run() == FALSE){
            $this->load->module('Admintemplate');
            $this->display_users();

        }
        //if validation succeeds
        else{
            if ($add_update == 1)
            {
                //gets id and saves users registration information

                $id = $this->M_Users->add_user();
                $this->M_Roles->assign_role_user($id);

                if ($this->input->post('residence', TRUE)!= NULL && $this->input->post('gender', TRUE)!= NULL)
                    $this->M_Roles->assign_gender_residence_subrole_user($id);
                else if ($this->input->post('residence', TRUE)!= NULL && $this->input->post('gender', TRUE)== NULL)
                    $this->M_Roles->assign_residence_subrole_user($id);
                else if ($this->input->post('residence', TRUE)== NULL && $this->input->post('gender', TRUE)!= NULL){
                    $this->M_Roles->assign_gender_subrole_user($id);
                }
            }

            else{
                $this->M_Users->update_user();
                $this->M_Users->update_role();
                if ($this->input->post('residence', TRUE)!= NULL && $this->input->post('gender', TRUE)!= NULL)
                    $this->M_Roles->assign_gender_residence_subrole_user($this->input->post('id', TRUE));
                else if ($this->input->post('residence', TRUE)!= NULL && $this->input->post('gender', TRUE)== NULL)
                    $this->M_Roles->assign_residence_subrole_user($this->input->post('id', TRUE));
                else if ($this->input->post('residence', TRUE)== NULL && $this->input->post('gender', TRUE)!= NULL)
                    $this->M_Roles->assign_gender_subrole_user($this->input->post('id', TRUE));


            }
        //redirects to the users page to view the added user
        redirect(base_url().'Admin/users');
        }
    }
    function delete_user($userid){
        $this->M_Users->delete_user($userid);
        redirect(base_url().'Admin/users');
    }
    function edit_user($id){
        $this->load->module(['Titles', 'Roles']);
        $users = $this->M_Users->edit_user($id);
        if (count($users)>0){
            foreach ($users as $key => $value) {
                $title_id = $value->TITLE_ID;
                $data['firstname'] = "{$value->FIRSTNAME}";
                $data['surname'] = "{$value->SURNAME}";
                $data['email'] = "{$value->EMAIL}";
                $role_id = "{$value->ROLE_ID}";
                $data['id'] = "{$value->LOGIN_ID}";
            }

        }
        $this->load->module('Admintemplate');
        $data['title'] = $this->titles->create_titles_selected($title_id);
        $data['role'] = $this->roles->create_role_select($role_id);
        $data['users_table'] = $this->create_user_table();
        // setting page up for update
        $data['add_update'] = 2;
        $data['button_title'] = 'Update User';
        $data['page_title'] = 'Users';
        $data['content_view'] = 'Users/users_display_v';
        $this->admintemplate->call_admin_template($data);
    }

    function create_user_table(){
        $users = $this->M_Users->get_all_users();

        $users_table = "";

        if (count($users)>0){
            $counter = 1;
            foreach ($users as $key => $value){
                $users_table .="<tr>";
                $users_table .="<td>{$counter}</td>";
                $users_table .="<td>{$value->FIRSTNAME} {$value->SURNAME}</td>";
                $users_table .="<td>{$value->EMAIL}</td>";
                $users_table .="<td>{$value->ROLE}</td>";
                $users_table .= "<td><a href='".base_url()."Users/edit_user/{$value->LOGIN_ID}'>Edit</a></td> ";
                if ($value->STATUS == 1)
                    $users_table .= "<td> <a href='".base_url()."Users/change_status/{$value->LOGIN_ID}/0'>Deactivate</a></td> ";
                else
                    $users_table .= "<td> <a href='".base_url()."Users/change_status/{$value->LOGIN_ID}/1'>Activate</a></td> ";
                $users_table .= "<td><a href='".base_url()."Users/reset_password/{$value->LOGIN_ID}'>Reset Password</a> </td> ";
                $users_table .= "</tr>";
                $counter++;
            }
            return $users_table;
        }
    }

    function change_status($user_id, $status){
        $this->M_Users->change_status($user_id, $status);
        redirect(base_url().'Admin/users');
    }

    function reset_password($user_id){
        $this->load->helper('string');
        $password = random_string('alnum', 7);
        $encrypted_password = sha1($password );
        $this->M_Users->update_password($user_id, $encrypted_password);
        $this->session->set_flashdata('message', 'New Password is: '.$password);
        redirect(base_url().'Admin/users');
    }
}
