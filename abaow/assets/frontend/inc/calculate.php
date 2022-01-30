<?php
 require('../fpdf/fpdf.php');
 
$cnt=0;
$comp_error="";
$prod_error="";
$year_error="";
$per_error="";
$phone_error="";
$email_error="";

if(isset($_POST['submit'])) 
{	
	$cnt=0;
	$que= '';
	
	$company = $_POST['form_company'];
	if(!ctype_alpha($company))
	{
		//return $comp_error;
		$comp_error= "Only alphabets are allowed";
	}
	$product = $_POST['form_prod'];
	if(!ctype_alpha($product))
	{
		$prod_error= "Only alphabets are allowed";
	}
	$years = $_POST['form_years'];
	if(!ctype_digit($years))
	{
		$year_error= "Only numbers are allowed";
	}
	$person = $_POST['form_person'];
	if (!ctype_alpha($person))
	{
		$per_error= "Only alphabets are allowed";
	}
	$phone = $_POST['form_phone'];
	if (!ctype_digit($phone))
	{
		$phone_error= "Only numbers are allowed";
	}
	$email = $_POST['form_email'];
	if(filter_var($email, FILTER_VALIDATE_EMAIL)) 
	{
		$email_error= "Please enter valid email id";   
	}
	
	
	$radiovalue= array ($_POST['optradio'],$_POST['optradio1'],$_POST['optradio2'],$_POST['optradio3'],$_POST['optradio4'],$_POST['optradio5'],$_POST['optradio6'],$_POST['optradio7'],$_POST['optradio8'],$_POST['optradio9'],$_POST['optradio10'],$_POST['optradio11'],$_POST['optradio12'],$_POST['optradio13'],$_POST['optradio14'],$_POST['optradio15'],$_POST['optradio16'],$_POST['optradio17'],$_POST['optradio18'],$_POST['optradio19'],$_POST['optradio20'],$_POST['optradio21'],);

	foreach($radiovalue as $result)
	{
		if($result=='yes')
		{
			$cnt++;
		}
	}
	
	
	$pdf = new FPDF();
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',12);
	//$pdf->cell(10,20,'Hello world '.$company.' '.$product.' '.$cnt);
	//$pdf->output('test1.pdf','F');
	//$pdf->output();
					
					$pdf->SetFont('Arial','B',26);
					$pdf->SetTextColor(0, 92, 230);
					$pdf->Cell(0,10,'Sales Angiography',0,1,'C');
					$pdf->Ln(6);
					
					$pdf->SetFont('Arial','BU',16);
					$pdf->SetTextColor(0, 0, 0);
					$pdf->Cell(0,10,'Report & Prescription',0,1,'C');
					$pdf->Ln(8);
 										
					//$pdf->Line(10, 30, 200, 30); // 50mm from each edge
					
					$pdf->SetFont('Arial','B',12);
					$pdf->Cell(10,20,'Company Name: '.$company);
					$pdf->Ln(4);
					$pdf->Cell(90);
					$pdf->Cell(40,10,'Product: '.$product);
					$pdf->Ln(4);
					
					$pdf->SetFont('Arial','B',12);
					$pdf->Cell(10,20,'Years in Business: '.$years);
					$pdf->Ln(4);
					$pdf->Cell(90);
					$pdf->Cell(40,10,'Contact Person: '.$person);
					$pdf->Ln(4);
					
					$pdf->SetFont('Arial','B',12);
					$pdf->Cell(10,20,'Mobile No.: '.$phone);
					$pdf->Ln(4);
					$pdf->Cell(90);
					$pdf->Cell(40,10,'Email id: '.$email);
					$pdf->Ln(10);
					
					$pdf->SetFont('Arial','BU',16);
					$pdf->SetTextColor(230, 0, 0);
					$pdf->Cell(10,20,'Your Score: '.$cnt);
					$pdf->Ln(20);
					
					$pdf->SetFont('Arial','BU',11);
					$pdf->SetTextColor(0, 0, 0);
					$pdf->Cell(40,10,'Score: Between 01 - 07: ');
					$pdf->Cell(10);
					$pdf->SetFont('Arial','',11);
					$pdf->MultiCell(140,5,'Your sales process is having many blockages which is affecting your sales adversely. It is suggested that you consider taking support from Sales experts to revive your sales immediately.');
					$pdf->Ln(7);
					
					$pdf->SetFont('Arial','BU',11);
					$pdf->Cell(40,10,'Score: Between 08 - 15: ');
					$pdf->Cell(10);
					$pdf->SetFont('Arial','',11);
					$pdf->MultiCell(140,5,'You have some built some foundation for your sales process and your basic building blocks are in place. However, there is significant scope for improvement in your sales process which can be streamlined and organised properly. ');
					$pdf->Ln(7);
					
					$pdf->SetFont('Arial','BU',11);
					$pdf->Cell(40,10,'Score: Between 16 - 22: ');
					$pdf->Cell(10);
					$pdf->SetFont('Arial','',11);
					$pdf->MultiCell(140,5,'You have a robust and a well functioning sales process which is serving purpose of your company very well. Most of the things are working and there is no real need to change it a lot. Small improvements are good enough at this stage.');
					$pdf->Ln(10);
					
					$pdf->SetFont('Arial','BU',15);
					$pdf->SetTextColor(0, 0, 0);
					$pdf->Cell(0,10,'Recommendations: ');
					$pdf->Ln(5);
					
					$pdf->SetFont('Arial','',13);
					$pdf->Cell(10,20,'# Sales Cures All');
					$pdf->Ln(4);
					$pdf->Cell(70);
					$pdf->Cell(40,10,'# Romancing with Sales');
					$pdf->Ln(4);
					
					$pdf->SetFont('Arial','',13);
					$pdf->Cell(10,20,'# Customised Sales Training');
					$pdf->Ln(4);
					$pdf->Cell(70);
					$pdf->Cell(40,10,'# Sales Outsourcing');
					$pdf->Ln(25);
					
					
					/* $pdf->SetFont('Arial','',12);
					$pdf->Write(5,"To go back to website, click ");
					$pdf->SetFont('','U');
					 */
					//$pdf->Write(5,'here','http://localhost/demo-fpdf/demo/');
					//$pdf->Write(5,'here','http://www.yashallay.com/');
					//$pdf->SetLink($link);
					
					//$pdf->Line(10, 30, 200, 30); // 50mm from each edge
					
					
					$pdf->output();
	//return $company;				
	//return $product;
	// return $years;
	// return $person;
	// return $phone;
	// return $email;
	// return $cnt;
	
	//echo $cnt;
}
else
{
	echo'fail';
} 	
?>