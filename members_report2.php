<?php



require('fpdf/fpdf.php');
include_once("objects/functions.php");
include_once("objects/fund.php");
include_once("config/database.php");

$insertdata=new DB_con();

$database=new database();
$db=$database->getConnection();
$fund=new fund($db);

$page_title="Savings";
//include_once("header.php");

if(isset($_POST['send'])){

$name2=$_POST['m_name'];

//include_once("footer.php");
class PDF extends FPDF
{
// Page header
function Header()
{
// Logo
	$this->Image('Print/model.png',10,6,17);
	// Arial bold 15
	$this->SetFont('Arial','B',15);
	// Move to the right
	$this->Cell(80);
	// Title
	$this->Cell(30,8,'KAWA SELF HELP GROUP',0,1,'C');
	// Line break
	$this->SetFont('Arial','B',9);
	$this->Cell(180,6,'P.O. BOX 1478-00217, LIMURU .TEL:020 2699768',0,1,'C');
	$this->Cell(180,6,'Email:bibirioni@yahoo.com',0,1,'C');
	$this->Ln();
}

// Page footer
function Footer()
{
	// Position at 1.5 cm from bottom
	$this->SetY(-15);
	// Arial italic 8
	$this->SetFont('Arial','I',8);
	// Page number
	$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',12);

$dar=" Members Contributions";

$pdf->Cell(40,10,"$dar");
$pdf->Ln();
$pdf->Cell(10,10,'NO',1);
$pdf->Cell(18,10,'M_NO',1);
//$pdf->Cell(18,10,'M_NO',1);
$pdf->Cell(55,10,'NAME',1);
$pdf->Cell(55,10,'DATE',1);
$pdf->Cell(55,10,'AMOUNT',1);

$pdf->Ln();
//$query=mysql_query("SELECT * FROM blocks ORDER BY Block_ID ASC");
$sql=$insertdata->selects();

//$sql2=$insertdata->countm();
//$row2=mysql_fetch_assoc($sql2);
//$total2=$row2['total'];

//$row=mysql_fetch_array($sql);
//$name= $row['m_name'];
$x=1;
//$pdf->Cell(18,6,"$name",1);
while($row=mysql_fetch_array($sql)){

$m_no= $row['m_no'];
$m_name= $row['m_name'];
$m_date= $row['s_date'];
$s_amount= $row['s_amount'];
$pdf->SetFont('Times','',10);
$pdf->Cell(10,6,"$x",1);
$pdf->Cell(18,6,"$m_no",1);
$pdf->Cell(55,6,"$m_name",1);
$pdf->Cell(55,6,"$m_date",1);
$pdf->Cell(55,6,"$s_amount",1);


$pdf->Ln();
$x++;
}
$pdf->Ln();
//$pdf->Cell(170,6,"$total2",0,1,'R');
//$this->Cell(30,8,'KAWA SELF HELP GROUP',0,1,'C');

$pdf->Output();
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>PCEA BIBIRIONI</title>
<link rel="stylesheet" href="../css/styles.css" />
<script src="../jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="../calendar/calendar.js"></script>
<script type="text/javascript" src="../calendar/calendar-setup.js"></script>
<script type="text/javascript" src="../calendar/lang/calendar-en.js"></script>
 <style type="text/css"> @import url("../calendar/calendar-win2k-cold-1.css"); </style>


</head>
<body bgcolor="#f5f5dc">
<fieldset><legend>Members Statements</legend><form method="POST" action="">
<table><tr><td>Block<br/><select name="m_name"><option value="all">All</option>
<?php
//$query=mysql_query("SELECT * FROM blocks ORDER BY Block_ID ASC")or die(mysql_error());
$sql4=$insertdata->mem_list();
while($rw=mysql_fetch_array($sql4)){
echo "<option value='".trim($rw['m_name'])."'>".$rw['m_name']."</option>";
}
echo "</select></td>
<td><br/><input type='submit' name='send' value='Print'></td>
";
?>

</tr></table>

</form></fieldset>
</body></html>


<?php
/*}else{
header("Location:index.php");
}*/
?>