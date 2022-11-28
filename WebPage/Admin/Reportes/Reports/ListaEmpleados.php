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
class PDF extends FPDF
{
// Cabecera de página
function Header()
{
	$this->SetFont('Arial','B',15);
	// Movernos a la derecha
	$this->Cell(160);
	// Título
	$this->Cell(60,10,'Reporte de Empleados',1,0,'C');
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
$sql = "SELECT * FROM employee";
$datos=$con->query($sql);
$fila=$datos->fetch_assoc();
$n_filas=$datos->num_rows;
if ($n_filas>0){
    $resultado = mysqli_query($con, $sql);
    while($fill = mysqli_fetch_array($resultado)){
        $employee = $fill['empName'];
    }
}
else{
    $employee=$sentencia;
}



$datos=$con->query($sql);
$n_filas=$datos->num_rows;
$i=1;

// Creaci�n del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage('L', array(350,300));
$pdf->SetFont('Times','',12);
$pdf->Cell(20,10,utf8_decode("DNI"),1,0,'C');
$pdf->Cell(40,10,utf8_decode("Nombre"),1,0,'C');
$pdf->Cell(70,10,utf8_decode("Apellidos"),1,0,'C');
$pdf->Cell(30,10,utf8_decode("Rol"),1,0,'C');
$pdf->Cell(20,10,utf8_decode("Género"),1,0,'C');
$pdf->Cell(30,10,utf8_decode("Celular"),1,0,'C');
$pdf->Cell(35,10,utf8_decode("Direccion"),1,0,'C');
$pdf->Cell(30,10,utf8_decode("Entrada"),1,0,'C');
$pdf->Cell(30,10,utf8_decode("Salida"),1,0,'C');
$pdf->Cell(30,10,utf8_decode("Salario"),1,0,'C');
$pdf->Ln(10);
if ($n_filas>0){
    while($fila=$datos->fetch_assoc()){
        $con= new mysqli("localhost","root","","bd_farm");
        $sql = "SELECT * FROM employee";
        $resultado = mysqli_query($con, $sql);
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
}
$pdf->Output();
?>  