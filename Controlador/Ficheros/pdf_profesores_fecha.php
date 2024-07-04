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
        //Si lo creamos en la cabecera no funciona
        //$this->Link(130, 5, 60, 15, 'https://www.guitarristas.info/usuarios/david87chdz');
        // Establecer color de fondo para el footer
        $this->SetFillColor(200, 200, 255);

        // Ajusta el tamaño según tus necesidades
        //-15 para subir haci arriba
        $this->Rect(0, $this->GetPageHeight() - 15, $this->GetPageWidth(), 15, 'F');
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }

    function ImprimirArchivo($datos) {
        foreach ($datos as $persona) {
            $this->AddPage(); // Nueva página para el primer registro
            $this->SetFont('Arial', 'B', 14);
            $this->MultiCell(0, 8, utf8_decode('TUTOR:'));
            $this->SetFont('Arial', '', 12);
            $this->MultiCell(0, 8, utf8_decode("Id_alumno: {$persona['id_tutor']}"));
            $this->MultiCell(0, 8, utf8_decode("DNI: {$persona['dni']}"));
            $this->MultiCell(0, 8, utf8_decode("Apellido1: {$persona['apellido1']}"));
            $this->MultiCell(0, 8, utf8_decode("Apellido2: {$persona['apellido2']}"));
            $this->MultiCell(0, 8, utf8_decode("Apellido2: {$persona['apellido2']}"));
            $this->MultiCell(0, 8, utf8_decode("Email: {$persona['email']}"));
            $this->MultiCell(0, 8, utf8_decode("Telefono: {$persona['telefono']}"));
            $this->MultiCell(0, 8, utf8_decode("Título proyecto: {$persona['titulo']}"));
            $this->MultiCell(0, 8, utf8_decode("Descripción proyecto: {$persona['descripcion']}"));
            $this->Ln();
        }
    }
}

$conexion = conexion(); 
$fechaActual = date("Y-m-d");

$consulta = "select * from tutores t left outer join proyectos p on t.id_tutor=p.tutor 
where p.fecha_exposicion > $fechaActual OR p.fecha_exposicion is null";
$sentencia = $conexion->prepare($consulta);
$sentencia->execute();

// Obtener resultados
$listaPersonas = $sentencia->fetchAll(PDO::FETCH_ASSOC);

$pdf = new PDF();
$pdf->ImprimirArchivo($listaPersonas);


$sentencia = null;
desconexion($conexion);
ob_end_clean();

$pdf->Output("basico.pdf", "D");
?>
