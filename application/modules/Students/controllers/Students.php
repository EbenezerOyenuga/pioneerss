<?php

class Students extends MY_Controller{

    function __construct()
    {
        parent::__construct();
        $this->load->module(["GradeResidence", "ResidenceResubmission", "Admintemplate"]);
        $this->load->model('M_Students');
    }


    function download()
  {
      //rules for registration


          require('./fpdf/fpdf.php');
          $pdf = new FPDF('L');
          $pdf->AddPage();
          $pdf->SetFont('Arial','B',12);
          $pdf->Image('./images/bulogo.jpg', 20, 10);
          $pdf->Cell(0, 10, "Pioneer Report", 0, 1, "C");
          $pdf->SetFont('Arial','B',10);
          $pdf->Cell(0, 20, "List of Students", 0, 1, "C");

          // Colors, line width and bold font
          $pdf->SetFont('','B');
          $residence_grad = array();
          // Header
          $header = array('S/N', 'Matric', 'Student Name', 'Phone Number', 'Email Address', 'Action Unit', 'Residence');
          $w = array(10, 15, 70, 30, 70, 50, 30);
          for($i=0;$i<count($header);$i++)
              $pdf->Cell($w[$i],7,$header[$i],1,0,'C');
          $pdf->Ln();

          $pdf->SetFont('Arial','',10);
          $students = ($this->M_Students->get_all_students());

          if (count($students) > 0) {
              $counter = 1;
              foreach ($students as $key => $value) {
                $pdf->Cell($w[0], 7, $counter, 1, 0, 'C');
                $pdf->Cell($w[1], 7, $value->matricno, 1, 0, 'C');
                $pdf->Cell($w[2], 7, $value->surname.', '.$value->othernames, 1, 0);
                $pdf->Cell($w[3], 7, $value->phone, 1, 0, 'C');
                $pdf->Cell($w[4], 7, $value->email, 1, 0);
                $pdf->Cell($w[5], 7, $value->name, 1, 0);
                $pdf->Cell($w[6], 7, $value->residence, 1, 0);
                $pdf->Ln();

                $counter++;
              }
              $pdf->Output();
              }


      }

}
