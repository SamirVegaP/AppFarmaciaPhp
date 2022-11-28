<?php
include_once '../../../../Php/SessionFunctions/user.php';
include_once '../../../../Php/SessionFunctions/user_session.php';

$userSession = new UserSession();
$user = new User();

if(isset($_SESSION['user'])){
    $user->setUser($userSession->getCurrentUser());
}else{
    echo "No hay";
}
require('../LibraryPDF/fpdf.php');
$idsea = $userSession->getCurrentSeal();
$mdid = md5($idsea);
class PDF extends FPDF
{
// Cabecera de página
function Header()
{
	$this->SetFont('Arial','B',15);
	// Movernos a la derecha
	$this->Cell(120);
	// Título
	$this->Cell(60,10,'Boleta de Ventas',1,0,'C');
	// Salto de línea
	$this->Ln(20);
}

// Pie de página
function Footer()
{
	// Posición: a 1,5 cm del final
	$this->SetY(-15);
	// Arial italic 8
	$this->SetFont('Arial','I',8);
	// Número de página
	$this->Cell(0,10,utf8_decode('Página N° ').$this->PageNo().'/{nb}',0,0,'C');
}
}
//recuperamos datos de la venta
$con= new mysqli("localhost","root","","bd_farm");
$sql = "SELECT seal.seaId, seal.seaDate, client.cliName FROM seal INNER JOIN client ON client.cliId = seal.cliId WHERE seal.seaId = '$idsea'";
$datos=$con->query($sql);
$fila=$datos->fetch_assoc();
$n_filas=$datos->num_rows;
if ($n_filas>0){
    $resultado = mysqli_query($con, $sql);
    while($fill = mysqli_fetch_array($resultado)){
        $seal = $fill['cliName'];
    }
}
else{
    $seal=$sentencia;
}



$datos=$con->query($sql);
$n_filas=$datos->num_rows;
$i=1;
$total = 0;

// Creaci�n del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage('L', array(350,300));
$pdf->SetFont('Times','',12);
$pdf->Ln(0);
$pdf->Cell(10,10,"Sr:",0,0);
$pdf->Cell(120,10,utf8_decode($seal),0,0,'L');
$pdf->Cell(80,10,utf8_decode($fila['seaDate']),0,0,'L');
$pdf->Cell(15,10,"Boleta:",0,0);
$pdf->Cell(120,10,utf8_decode($mdid),0,0,'L');
$pdf->Ln(20);
$pdf->Cell(80,10,utf8_decode("Nombre"),1,0,'C');
$pdf->Cell(60,10,utf8_decode("Concentración"),1,0,'C');
$pdf->Cell(50,10,utf8_decode("Presentación"),1,0,'C');
$pdf->Cell(70,10,utf8_decode("Costo Unitario"),1,0,'C');
$pdf->Cell(30,10,utf8_decode("Cantidad"),1,0,'C');
$pdf->Cell(35,10,utf8_decode("Costo Total"),1,0,'C');
$pdf->Ln(10);

if ($n_filas>0) {
    while ($fila=$datos->fetch_assoc()) {
        $con2= new mysqli("localhost","root","","bd_farm");
        $sql2 = "SELECT * FROM detailseal WHERE seaId = '$idsea'";
        $resultado2 = mysqli_query($con2, $sql2);
        while ($fill = mysqli_fetch_array($resultado2)) {
            $proID = $fill['proId'];
            $procdt = $fill['proQuantity'];
            $proCost = $fill['proImport'];
            $sql3 = "SELECT * FROM product WHERE proId = '$proID'";
            $resultado3 = mysqli_query($con2, $sql3);
            if ($fill = mysqli_fetch_array($resultado3)) {
                $proName = $fill['proName'];
                $proConcentration = $fill['proConcentracion'];
                $proPres = $fill['proPresentation'];
                $proCostT = $procdt * $proCost;
            }
            $total = $total + $proCostT;
            $pdf->Cell(80,10,utf8_decode("$proName"),1,0,'C');
        $pdf->Cell(60,10,utf8_decode("$proConcentration"),1,0,'C');
        $pdf->Cell(50,10,utf8_decode("$proPres"),1,0,'C');
        $pdf->Cell(70,10,utf8_decode("$proCost"),1,0,'C');
        $pdf->Cell(30,10,utf8_decode("$procdt"),1,0,'C');
        $pdf->Cell(35,10,utf8_decode("$proCostT"),1,0,'C');
        $pdf->Ln(10);
        }
    }
}
$pdf->Ln(10);
$pdf->Cell(70,10,utf8_decode("Total a Pagar:"),1,0,'C');
$pdf->Cell(50,10,utf8_decode("$total"),1,0,'C');
/*if ($n_filas>0){
    while($fila=$datos->fetch_assoc()){
        $con= new mysqli("localhost","root","","bd_farm");
        $sql2 = "SELECT * FROM employee";
        $resultado = mysqli_query($con, $sql2);
        while($fill = mysqli_fetch_array($resultado)){
            $empDNI = $fila['empDNI'];
            $empName = $fila['empName'];
            $empLastName = $fila['empLastName'];
            $empRol = $fila['empRol'];
            $empGender = $fila['empGender'];
            $empPhone = $fila['empPhone'];
            $empAddress = $fila['empAddress'];
            $empEntryTime = $fila['empEntryTime'];
            $empDepartureTime = $fila['empDepartureTime'];
            $empSalary = $fila['empSalary'];
        }
        $pdf->Cell(20,10,utf8_decode($empDNI),1,0,'C');
        $pdf->Cell(40,10,utf8_decode($empName),1,0,'C');
        $pdf->Cell(70,10,utf8_decode($empLastName),1,0,'L');
        $pdf->Cell(30,10,utf8_decode($empRol),1,0,'C');
        $pdf->Cell(20,10,utf8_decode($empGender),1,0,'C');
        $pdf->Cell(30,10,utf8_decode($empPhone),1,0,'C');
        $pdf->Cell(35,10,utf8_decode($empAddress),1,0,'C');
        $pdf->Cell(30,10,utf8_decode($empEntryTime),1,0,'C');
        $pdf->Cell(30,10,utf8_decode($empDepartureTime),1,0,'C');
        $pdf->Cell(30,10,utf8_decode("S/.".$empSalary),1,0,'C');
        $pdf->Ln(10);
        $i++;
    }
}*/
$pdf->Output();
?>  