<?php

/**
 * Created by PhpStorm.
 * User: ebene
 * Date: 12/1/2016
 * Time: 6:39 AM
 */
class Requirements extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("M_Requirements");
    }

    function display_department_requirements(){
        $this->load->module("Semesters");
        $data['semesters_table'] = $this->semesters->create_department_semesters_table();
        $data['show_department'] = '';
        $data['page_title'] = 'Semester Department Requirements';
        $data['content_view'] = 'Requirements/dept_requirements_display_v';
        $this->admintemplate->call_admin_template($data);

    }

    function display_semester_programs($semester_id){
        $this->load->model(["M_Programs", "M_Semesters"]);
        $this->load->module(array("Semesters", "Programs"));
        $count_semester_prog_requirement = count($this->M_Requirements->get_if_semester_prog_requirement($semester_id));

        if ($count_semester_prog_requirement == 0){
          $programs = $this->M_Programs->get_programs();
          foreach ($programs as $key => $value_program){
            $this->M_Semesters->load_semester_program_requirement($semester_id, $value_program->PROGRAM_ID);
          }
        }
        $data['semester'] = $this->semesters->get_semester($semester_id);

        $data['semesters_table'] = $this->semesters->create_department_semesters_table();
        $data['requirements_programs_table'] = $this->programs->create_programs_requirements_table($semester_id);
        $data['page_title'] = 'Semester Department Requirements';
        $data['id'] = $semester_id;

        $data['content_view'] = 'Requirements/dept_requirements_display_v';
        $this->admintemplate->call_admin_template($data);
    }

    function display_requirements(){
        $data['page_title'] = 'Action Unit Requirement';

        $data['max_number'] = $this->get_max_action_unit();
        $data['content_view'] = 'Requirements/requirements_display_v';
        $this->admintemplate->call_admin_template($data);

    }


    function get_max_action_unit(){
      $max = $this->M_Requirements->get_max_students();
      if (count($max)>0){
          foreach ($max as $key => $value) {
              $max_number = "{$value->max_number}";

          }

      }
        return $max_number;
    }

    function update_requirements($id){
        // load form validation library
        $this->load->library('form_validation');

        //rules for registration
        $this->form_validation->set_rules('max_number', 'Maximum Number Required', 'trim|required|min_length[1]|max_length[2]|is_natural_no_zero');

        // if validation fails
        if ($this->form_validation->run() == FALSE){
            $this->load->module('Admintemplate');
            $this->display_requirements();
        }
        //if validation succeeds
        else{

                $this->M_Requirements->update_requirements();
                $this->session->set_flashdata('success', 'Maximum number of students per action unit, updated successfully');
        //redirects to the users page to view the added user
        redirect(base_url().'Admin/requirements');
        }
    }

    function edit_requirements($id){
        $requirements = $this->M_Requirements->edit_requirements($id);
        if (count($requirements)>0){
            foreach ($requirements as $key => $value) {
                $data['semester'] = "{$value->SEMESTER}";
                $data['chapel'] = "{$value->CHAPEL_REQUIREMENT}";
                $data['residence'] = "{$value->RESIDENCE_REQUIREMENT}";
                $data['worship'] = "{$value->WORSHIP_REQUIREMENT}";
                $data['id'] = "{$value->SEMESTER_REQUIREMENT_ID}";
            }

        }
        $this->load->module('Admintemplate');
        $data['show_edit'] = 1;
        $data['requirements_table'] = $this->create_requirements_table();
        $data['page_title'] = 'Semester Requirements';
        $data['content_view'] = 'Requirements/requirements_display_v';
        $this->admintemplate->call_admin_template($data);

    }

    function edit_program_requirements($semester_id, $program_id){
        $requirements = $this->M_Requirements->edit_program_requirements($semester_id, $program_id);
        if (count($requirements)>0){
            foreach ($requirements as $key => $value) {
                $data['semester'] = "{$value->SEMESTER}";
                $data['semester_id'] = "{$value->semester_id}";
                $data['chapel'] = "{$value->chapel_requirement}";
                $data['residence'] = "{$value->residence_requirement}";
                $data['worship'] = "{$value->worship_requirement}";
                $data['program_id'] = "{$value->program_id}";
            }

        }
        $this->load->module('Admintemplate');
        $data['show_edit'] = 1;
        $data['requirements_table'] = $this->create_requirements_table();
        $data['page_title'] = 'Semester Requirements';
        $data['content_view'] = 'Requirements/dept_requirements_display_v';
        $this->admintemplate->call_admin_template($data);

    }

    function create_requirements_table(){
        $requirements = $this->M_Requirements->get_all_requirements();

        $requirements_table = "";

        if (count($requirements)>0){
            $counter = 1;
            foreach ($requirements as $key => $value){
                $requirements_table .="<tr>";
                $requirements_table .="<td>{$counter}</td>";
                $requirements_table .="<td>{$value->SEMESTER}</td>";
                $requirements_table .="<td>{$value->CHAPEL_REQUIREMENT}</td>";
                $requirements_table .="<td>{$value->RESIDENCE_REQUIREMENT}</td>";
                $requirements_table .="<td>{$value->WORSHIP_REQUIREMENT}</td>";

                if ($value->CURRENT == 1){
                    $requirements_table .= "<td><a href='".base_url()."Requirements/edit_requirements/{$value->SEMESTER_REQUIREMENT_ID}'>Edit</a> </td> ";
                }

                $requirements_table .= "</tr>";
                $counter++;
            }
            return $requirements_table;
        }
    }

    function semester_requirement($semester_id){
        $this->load->model('M_Requirements');
        $semester_requirements = $this->M_Requirements->get_semester_requirements($semester_id);
        foreach ($semester_requirements as $key => $value) {
            if ($this->session->userdata('user_role') == 1)
                $requirement = $value->CHAPEL_REQUIREMENT;
            elseif ($this->session->userdata('user_role') == 2)
                $requirement = $value->RESIDENCE_REQUIREMENT;
            elseif ($this->session->userdata('user_role') == 3)
                $requirement = $value->WORSHIP_REQUIREMENT;
        }
        return $requirement;
    }

    function changestatus_program()
    {

      if (isset($_GET['program_id']) || isset($_GET['semester_id'])) {
        $this->load->module('Semesters');
        $update_requirements = 0;
        switch ($_GET['type']) {
          case 1:
            if (count($this->M_Requirements->get_if_chapel_required($_GET['semester_id'], $_GET['program_id']))==1 && count($this->M_Requirements->get_if_residence_required($_GET['semester_id'], $_GET['program_id']))==0 && count($this->M_Requirements->get_if_worship_required($_GET['semester_id'], $_GET['program_id']))==0)
              $update_requirements = 0;
            else {
              $update_requirements = 1;
            }
            break;
            case 2:
              if (count($this->M_Requirements->get_if_chapel_required($_GET['semester_id'], $_GET['program_id']))==0 && count($this->M_Requirements->get_if_residence_required($_GET['semester_id'], $_GET['program_id']))==1 && count($this->M_Requirements->get_if_worship_required($_GET['semester_id'], $_GET['program_id']))==0)
                $update_requirements = 0;
              else {
                $update_requirements = 1;
              }
              break;

              case 3:
                if (count($this->M_Requirements->get_if_chapel_required($_GET['semester_id'], $_GET['program_id']))==0 && count($this->M_Requirements->get_if_residence_required($_GET['semester_id'], $_GET['program_id']))==0 && count($this->M_Requirements->get_if_worship_required($_GET['semester_id'], $_GET['program_id']))==1)
                  $update_requirements = 0;
                else {
                  $update_requirements = 1;
                }
                break;
          default:

            break;
        }
        if ($update_requirements == 1)
          $this->M_Requirements->update_semester_program_status($_GET['semester_id'], $_GET['type'], $_GET['program_id'], $_GET['curr_status']);
        $semester = $_GET['semester_id'];
        $semester_name = $this->semesters->get_semester($_GET['semester_id']);
        echo "<div class='panel panel-default'>";
          echo "<div class='panel-heading'>Program Requirements for {$semester_name}</div>";
            echo "<div class='panel-body'>";
              echo "<table id='zctb' class='display table table-striped table-bordered table-hover' cellspacing='0' width='100%'>";
                echo "<thead>";
                  echo "<tr>";
                    echo "<th>S/N</th>";
                    echo "<th>Program</th>";
                    echo "<th>Chapel</th>";
                    echo "<th>Residence</th>";
                    echo "<th>Worship</th>";
                  echo "</tr>";
                echo "</thead>";
                echo "<tfoot>";
                  echo "<tr>";
                    echo "<th>S/N</th>";
                    echo "<th>Program</th>";
                    echo "<th>Chapel</th>";
                    echo "<th>Residence</th>";
                    echo "<th>Worship</th>";
                  echo "</tr>";
                echo "</tfoot>";
                echo "<tbody>";
                  $programs = $this->M_Requirements->get_program_requirements($_GET['semester_id']);
                  if (count($programs) >= 0) {
                      $counter = 1;

                      foreach ($programs as $key => $value) {
                        $chapel_checked = "";
                        $residence_checked = "";
                        $worship_checked = "";
                          $program_id = json_encode($value->program_id);
                          echo "<tr>";
                          echo "<td>{$counter}</td>";
                          echo "<td>{$value->PROGRAM}</td>";
                          if ($value->chapel_requirement == 1)
                            $chapel_checked = 'checked';
                          echo "<td><input type='checkbox' id = 'checkchapel{$value->program_id}' name = 'checkchapel{$value->program_id}' $chapel_checked value='accepted' onclick='changestatus_program($semester, 1, $program_id, $value->chapel_requirement);'></td>";
                          if ($value->residence_requirement == 1)
                            $residence_checked = 'checked';
                          echo "<td><input type='checkbox' id = 'checkresidence{$value->program_id}' name = 'checkresidence{$value->program_id}' $residence_checked value='accepted' onclick='changestatus_program($semester, 2, $program_id, $value->residence_requirement);'></td>";
                          if ($value->worship_requirement == 1)
                            $worship_checked = 'checked';
                          echo "<td><input type='checkbox' id = 'checkworship{$value->program_id}' name = 'checkworship{$value->program_id}' $worship_checked value='accepted' onclick='changestatus_program($semester, 3, $program_id, $value->worship_requirement);'></td>";

                          $counter++;
                      }
                  }
                  echo "</tbody>";
                  echo "</table>";
                  echo "</div>";
                  echo "</div>";
                  echo "</div>";
    }
  }
}
