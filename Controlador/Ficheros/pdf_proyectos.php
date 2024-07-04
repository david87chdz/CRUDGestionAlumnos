<?php
    session_start();


if(!isset($_SESSION['usuario'])){
    header("Location: ../index.php?loginEnIndex=true");
}
?>
<?php
require("fpdf/fpdf.php");
include("../Config/biblioteca.php");

ob_start();

class PDF extends FPDF {
    // Cabecera de página
    function Header() {
        $this->SetFillColor(200, 200, 255);
        $this->Rect(0, 0, 210, 40, 'F'); 

        $this->Image('../../Vista/img/lucille.jpg', 5, 5, 60);
        $this->SetFont('Arial', 'B', 15);
        

        $this->Cell(120);
        $this->Cell(70, 15, utf8_decode('David Cerezo Hernández'), 1, 0, 'C');

        $this->Ln();
        $this->Cell(130);
        $this->Cell(15, 10,  utf8_decode('Ir a mi página'), 0, 1, 'C', false, 'https://www.guitarristas.info/usuarios/david87chdz');
        $this->SetY(70); 
        $this->SetFont('Arial', 'I', 12);
        
        $this->Ln(10); 
    }
    

    // Pie de página
    function Footer() {

        $this->SetFillColor(200, 200, 255);

        $this->Rect(0, $this->GetPageHeight() - 15, $this->GetPageWidth(), 15, 'F');
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }

    function ImprimirArchivo($datos) {
        foreach ($datos as $persona) {
            $this->AddPage(); 
            $this->SetFont('Arial', 'B', 14);
            $this->MultiCell(0, 8, utf8_decode('PROYECTO:'));
            $this->SetFont('Arial', '', 12);
            $this->MultiCell(0, 8, utf8_decode("Id_proyecto: {$persona['id_ptoyecto']}"));
            $this->MultiCell(0, 8, utf8_decode("Título: {$persona['titulo']}"));
            $this->MultiCell(0, 8, utf8_decode("Descripción: {$persona['titulo']}"));
            $this->MultiCell(0, 8, utf8_decode("Ciclo: {$persona['ciclo']}"));
            $this->MultiCell(0, 8, utf8_decode("Modulo1: {$persona['modulo1']}"));
            $this->MultiCell(0, 8, utf8_decode("Modulo2: {$persona['modulo2']}"));
            $this->MultiCell(0, 8, utf8_decode("Modulo3: {$persona['modulo3']}"));
            $this->MultiCell(0, 8, utf8_decode("Convocatoria: {$persona['convocatoria']}"));
            $this->MultiCell(0, 8, utf8_decode("Fecha expoxición: {$persona['fecha_exposición']}"));
            $this->MultiCell(0, 8, utf8_decode("Nota: {$persona['nota']}"));
            $this->MultiCell(0, 8, utf8_decode("Alumno: {$persona['nombre_alumno']} {$persona['apellido1_alumno']} {$persona['apellido2_alumno']}"));
            $this->MultiCell(0, 8, utf8_decode("Tutor: {$persona['nombre_tutor']} {$persona['apellido1_tutor']} {$persona['apellido2_tutor']}"));
            $this->Ln();
        }
    }
}

$conexion = conexion(); 


$consulta = "select p.*, a.nombre as nombre_alumno, a.apellido1 as apellido1_alumno,
a.apellido2 as apellido2_alumno, t.nombre as nombre_tutor, t.apellido1 as apellido1_tutor,
t.apellido2 as apellido2_tutor from proyectos p left outer join alumnos a on p.alumno=a.id_alumno 
LEFT OUTER JOIN tutores t ON p.tutor = t.id_tutor;";
$sentencia = $conexion->prepare($consulta);
$sentencia->execute();


$listaPersonas = $sentencia->fetchAll(PDO::FETCH_ASSOC);

$pdf = new PDF();
$pdf->ImprimirArchivo($listaPersonas);


$sentencia = null;
desconexion($conexion);
ob_end_clean();

$pdf->Output("basico.pdf", "D");
?>
