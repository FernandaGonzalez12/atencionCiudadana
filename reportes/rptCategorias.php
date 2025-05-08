<?php
require('fpdf.php');
require_once("../Modelo/Categorias.php"); // Usa el modelo correcto que tiene el método Consultar

class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial', '', 12);
        $this->SetTextColor(0, 0, 0); 
        $this->Cell(0, 10, 'Fecha: ' . date('d/m/Y'), 0, 0, 'R');
        $this->Ln(10);
        $this->Image('../Imagenes/logo1.png', 10, 6, 30);
        $this->SetFont('Arial', 'B', 18);
        $this->SetTextColor(255, 69, 0);
        $this->Cell(60);
        $this->Cell(90, 10, 'Reportes - Falta de Luz (Atencion Ciudadana)', 0, 0, 'C');
        $this->Ln(20);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    function FancyTable($header)
    {
        $this->SetFillColor(0, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(.3);
        $this->SetFont('', 'B');
        $w = array(55, 138);

        // Encabezado
        for ($i = 0; $i < count($header); $i++) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
        }
        $this->Ln();

        // Restaurar colores y fuente
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');

        // Consulta solo la categoría con ID 2 (Falta de Luz)
        $obj = new Categoria();
        $categorias = $obj->Consultar(); // Trae todas, filtramos manualmente
        $fill = false;

        foreach ($categorias as $cat) {
            if ($cat['id_categoria'] == 2) {
                $this->Cell($w[0], 20, $cat['nombre'], 'LR', 0, 'L', $fill);
                $this->Cell($w[1], 20, $cat['descripcion'], 'LR', 0, 'L', $fill);
                $this->Ln();
                $fill = !$fill;
            }
        }

        $this->Cell(array_sum($w), 0, '', 'T');
    }
}

$pdf = new PDF();
$pdf->AliasNbPages();
$header = array('Nombre Categoria', 'Descripcion');
$pdf->SetFont('Arial', '', 14);
$pdf->AddPage();
$pdf->FancyTable($header);
$pdf->Output();

?>


