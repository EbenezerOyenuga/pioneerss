<?php

class ActionUnit extends MY_Controller{

    function __construct()
    {
        parent::__construct();
        $this->load->module(["GradeResidence", "ResidenceResubmission", "Admintemplate"]);
        $this->load->model('M_ActionUnit');
    }

    function get_residence($residence_id)
    {
        $resi = $this->M_Residence->get_residence_name($residence_id);

        if (count($resi) > 0) {
            foreach ($resi as $key => $value)
                $residence = $value->RESIDENCE_NAME;
        }
        return $residence;
    }

    function create_radio_action_units(){
        $this->load->module('Requirements');
            $action_unit = $this->M_ActionUnit->get_action_units();
            $action_units = "";
            foreach ($action_unit as $key => $value) {
                $count_action_unit_students = $this->M_ActionUnit->count_students_in_action_unit($value->id);
                if ($count_action_unit_students < $this->requirements->get_max_action_unit()){
                  $action_units .= "<div class='col-md-4 col-md-offset-1'>";
                  $action_units .= "<input name='action_units' type='radio' id='{$value->id}' value='{$value->id}'/>";
                  $action_units .= "<label for='{$value->id}'>   {$value->name}</label><br/>";
                  $action_units .= "<img src='{$value->coordinator_picture}' style='width: 128px; height: 128px'/><br/>";

                  $action_units .= "<label for='{$value->id}'>Coordinated by {$value->coordinator}</label><br/>";
                  $action_units .= "</div>";

                }
            }


        return $action_units;
    }

    function display_action_units(){
        $data = $this->get_data_from_post();


        $data['action_units_table'] = $this->create_action_units_table();
        // setting page up for adding user
        $data['add_update'] = 1;
        $data['button_title'] = 'Add Action Units';
        $data['page_title'] = 'Action Units';
        $data['content_view'] = 'ActionUnit/action_units_v';
        $this->admintemplate->call_admin_template($data);

    }

    function students_action_unit($id){
        $data = $this->get_data_from_post();


        $data['action_units_table'] = $this->create_action_units_table();
        $data['students'] = $this->create_students_action_units_table($id);
        // setting page up for adding user
        $data['add_update'] = 1;
        $data['unit_id'] = $id;
        $data['button_title'] = 'Add Action Units';
        $data['page_title'] = 'Action Units';
        $data['content_view'] = 'ActionUnit/action_units_v';
        $this->admintemplate->call_admin_template($data);

    }

    function get_data_from_post(){
        $data['id'] = $this->input->post('id', TRUE);
        $data['action_unit'] = $this->input->post('action_unit', TRUE);
        $data['coordinator'] = $this->input->post('coordinator', TRUE);

        return $data;
    }

    function create_action_units_table(){
        $users = $this->M_ActionUnit->get_all_action_units();

        $users_table = "";

        if (count($users)>0){
            $counter = 1;
            foreach ($users as $key => $value){
                $users_table .="<tr>";
                $users_table .="<td>{$counter}</td>";
                $users_table .="<td>{$value->name}</td>";
                $users_table .="<td>{$value->coordinator}</td>";
                $pic_link = base_url().ltrim($value->coordinator_picture, '.');
                $users_table .="<td><img src='{$pic_link}' height='128' width='128'/></td>";
                $users_table .= "<td><a href='".base_url()."Admin/edit_action_unit/{$value->id}'>Edit</a></td> ";
                $users_table .= "<td><a href='".base_url()."Admin/student_action_unit/{$value->id}#students'>View</a></td> ";
                if ($value->STATUS == 1)
                    $users_table .= "<td> <a href='".base_url()."ActionUnit/change_status/{$value->id}/0'>Deactivate</a></td> ";
                else
                    $users_table .= "<td> <a href='".base_url()."ActionUnit/change_status/{$value->id}/1'>Activate</a></td> ";

                $users_table .= "</tr>";
                $counter++;
            }
            return $users_table;
        }
    }

    function change_status($action_unit_id, $status){
            $this->M_ActionUnit->change_status($action_unit_id, $status);
            redirect(base_url().'Admin/action_unit');
    }

    function create_students_action_units_table($id){
      $this->load->model('M_Students');
        $students = $this->M_Students->get_action_units_students($id);

        $students_table = "";

        if (count($students)>0){
            $counter = 1;
            foreach ($students as $key => $value){
                $students_table .="<tr>";
                $students_table .="<td>{$counter}</td>";
                $students_table .="<td>{$value->matricno}</td>";
                $students_table .="<td>{$value->surname}, {$value->othernames}</td>";
                $students_table .="<td>{$value->email}</td>";
                $students_table .="<td>{$value->phone}</td>";
                $students_table .="<td>{$value->program}</td>";
                $students_table .="<td>{$value->residence}</td>";
                $students_table .="<td>{$value->month} {$value->day}</td>";

                $students_table .= "</tr>";
                $counter++;
            }
            return $students_table;
        }
    }

    function post_action_units($add_update){
      // load form validation library
      $this->load->library('upload');
      $this->load->library('form_validation');

      //rules for registration
      $this->form_validation->set_rules('action_unit', 'Action Unit Name', 'trim|required');
      $this->form_validation->set_rules('coordinator', 'Coordinator Name', 'trim|required');

      // if validation fails
      if ($this->form_validation->run() == FALSE){
          $this->load->module('Admintemplate');
          $this->display_action_units();
      }
      //if validation succeeds
      else{
          if ($add_update == 1){
              //gets id and saves users registration information

              if (count($_FILES) > 0){
                  $files = $_FILES;
                  $config = $this->set_upload_option();
                  $this->upload->initialize($config);

                  if($this->upload->do_upload('coordinator_pics'))
                      $id = $this->M_ActionUnit->add_action_unit_pic($config['upload_path'].$files['coordinator_pics']['name']);
              }
              else {
                $id = $this->M_ActionUnit->add_action_unit();
              }
          }
          else{



                $files = $_FILES;
                $config = $this->set_upload_option();
                $this->upload->initialize($config);

                if($this->upload->do_upload('coordinator_pics'))
                    $id = $this->M_ActionUnit->update_action_unit_pic($config['upload_path'].$files['coordinator_pics']['name']);

            else

              $this->M_ActionUnit->update_action_unit();

          }
          //redirects to the users page to view the added user
          redirect(base_url().'Admin/action_unit');
      }
  }

  function edit_action_unit($id){
        $action_unit = $this->M_ActionUnit->get_action_unit_by_id($id);
        if (count($action_unit)>0){
            foreach ($action_unit as $key => $value) {
                $data['action_unit'] = "{$value->name}";
                $data['coordinator'] = "{$value->coordinator}";
                $data['id'] = "{$value->id}";
            }

        }
        $this->load->module('Admintemplate');
          $data['action_units_table'] = $this->create_action_units_table();
        // setting page up for update
        $data['add_update'] = 2;
        $data['button_title'] = 'Update Action Unit';
        $data['page_title'] = 'Action Units';
        $data['content_view'] = 'ActionUnit/action_units_v';
        $this->admintemplate->call_admin_template($data);
    }

    function get_action_unit_by_id($id){
          $action_unit = $this->M_ActionUnit->get_action_unit_by_id($id);
          if (count($action_unit) > 0) {
              $counter = 1;
              foreach ($action_unit as $key => $value) {
                  $action_unit_name = $value->name;
              }
          }
          return $action_unit_name;
    }
    private function set_upload_option(){
        //upload image options
        $config = array();
        $config['upload_path'] = './images/';
        $config['allowed_types'] = 'png|gif|jpg|jpeg';
        $config['max_size'] = '0';
        $config['overwrite'] = FALSE;

        return $config;
    }

    function download()
  {
      //rules for registration


          require('./fpdf/fpdf.php');
          $pdf = new FPDF();
          $pdf->AddPage();
          $pdf->SetFont('Arial','B',12);
          $pdf->Image('./images/bulogo.jpg', 20, 10);
          $pdf->Cell(0, 10, "Pioneer Report", 0, 1, "C");
          $pdf->SetFont('Arial','B',10);
          $pdf->Cell(0, 20, "List of Action Units", 0, 1, "C");

          // Colors, line width and bold font
          $pdf->SetFont('','B');
          $residence_grad = array();
          // Header
          $header = array('S/N', 'Action Unit', 'Action Unit Co-Ordinator', 'Num of Stds', 'Status');
          $w = array(10, 80, 60, 25, 15);
          for($i=0;$i<count($header);$i++)
              $pdf->Cell($w[$i],7,$header[$i],1,0,'C');
          $pdf->Ln();

          $pdf->SetFont('Arial','',10);
          $action_units = ($this->M_ActionUnit->get_all_action_units());

          if (count($action_units) > 0) {
              $counter = 1;
              foreach ($action_units as $key => $value) {
                  $pdf->Cell($w[0], 7, $counter, 1, 0, 'C');
                  $pdf->Cell($w[1], 7, $value->name, 1, 0, 'C');
                  $pdf->Cell($w[2], 7, $value->coordinator, 1, 0);
                  $pdf->Cell($w[3], 7, $this->M_ActionUnit->count_students_in_action_unit($value->id), 1, 0, 'C');
                  $pdf->Cell($w[4], 7, $value->STATUS, 1, 0, 'C');
                  $pdf->Ln();

                  $counter++;
              }
              $pdf->Output();
              }


      }

    function download_action_unit_students()
    {
        $this->load->model('M_Students');
      //rules for registration
      if (isset($_POST['download'])){
        require('./fpdf/fpdf.php');
        $pdf = new FPDF();
        $pdf->AddPage("L");
        $pdf->SetFont('Arial','B',12);
        $pdf->Image('./images/bulogo.jpg', 20, 10);
        $pdf->Cell(0, 10, "Pioneer Report", 0, 1, "C");
        $pdf->SetFont('Arial','B',10);

        $pdf->Cell(0, 20, "List of Students in ".$this->get_action_unit_by_id($this->input->post('unit_id', TRUE))." Action Unit", 0, 1, "C");

        $pdf->SetFont('','B');
        $residence_grad = array();
        // Header
          $header = array('S/N', 'Matric', 'Student Name', 'Phone Number', 'Email Address', 'Program', 'Residence');
          $w = array(10, 15, 60, 30, 65, 70, 30);
          for($i=0;$i<count($header);$i++)
              $pdf->Cell($w[$i],7,$header[$i],1,0,'C');
          $pdf->Ln();

        $pdf->SetFont('Arial','',10);

        $students = $this->M_Students->get_action_units_students($this->input->post('unit_id', TRUE));



        if (count($students)>0){
            $counter = 1;
            foreach ($students as $key => $value){
              $pdf->Cell($w[0], 7, $counter, 1, 0, 'C');
              $pdf->Cell($w[1], 7, $value->matricno, 1, 0, 'C');
              $pdf->Cell($w[2], 7, $value->surname.', '.$value->othernames, 1, 0);
              $pdf->Cell($w[3], 7, $value->phone, 1, 0, 'C');
              $pdf->Cell($w[4], 7, $value->email, 1, 0);
              $pdf->Cell($w[5], 7, $value->program, 1, 0);
              $pdf->Cell($w[6], 7, $value->residence, 1, 0);
              $pdf->Ln();

              $counter++;
            }
                  $pdf->Output();
        }



      }
    }

}
