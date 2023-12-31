<?php
include('./libreria/tcpdf.php');
include('./../../assets/js/bd.php');
date_default_timezone_set('America/Montevideo');

ob_clean();

class MYPDF extends TCPDF {
    public function Header() {
        $this->SetAutoPageBreak(false, 0);

        // Obtener las dimensiones de la imagen
        $img_file = dirname(__FILE__) . './../../assets/icons/logopdf.jpg';
        $imgWidth = 50; // Ancho deseado para la imagen
        $imgHeight = 20; // Alto deseado para la imagen

        // Imprimir la imagen centrada en el encabezado
        $this->Image($img_file, ($this->getPageWidth() - $imgWidth) / 2, $this->getHeaderMargin(), $imgWidth, $imgHeight, '', '', '', false, 300, '', false, false, 0);

        $this->SetAutoPageBreak(true, 20);
    }
}


if (strlen($_GET['pdf_fact']) > 0 ) {
        $pdf = new MYPDF('P', 'mm', array(80, 327), true, 'UTF-8');
        $pdf->SetCreator('Rodrigo Javier Barreda Machado');
        $pdf->SetAuthor('Administrador');
        $pdf->SetTitle('Factura');
        $pdf->SetMargins(0, 25, 0);
        $pdf->SetHeaderMargin(1);
        $pdf->setPrintFooter(false);
        $pdf->setPrintHeader(true);
        $pdf->SetAutoPageBreak(true, 1);

        $pdf->AddPage();
        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->Cell(0, 6, 'Rodrigo Javier Barreda Machado', 0, 1, 'C');
        $pdf->Cell(0, 6, 'RUT ' . RUT, 0, 1, 'C');
        $pdf->Cell(0, 6, DIRECCION, 0, 1, 'C');

        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->Cell(0, 6, '¡Todo lo que necesitas!', 0, 1, 'C');

        $pdf->Ln(1);

        $sql = "CALL `ver_factura`(".$_GET['pdf_fact'].")";
        $result = mysqli_query($conexion, $sql);

        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->SetFillColor(220, 220, 220);

        // Definir los anchos de las columnas en relación al ancho máximo de la impresión POS-80
        $columnWidths = array(12, 33, 16, 16);
        $columnHeaders = array('Cant', 'Nombre', 'PrecioU', 'SubTotal');

        // Obtener el ancho disponible para las columnas
        $availableWidth = $pdf->getPageWidth() - $pdf->getMargins()['left'] - $pdf->getMargins()['right'];

        // Calcular el factor de escala para ajustar las columnas al ancho máximo
        $scaleFactor = $availableWidth / array_sum($columnWidths);

        // Ajustar los anchos de las columnas
        foreach ($columnWidths as &$width) {
            $width *= $scaleFactor;
        }

        // Imprimir los encabezados de las columnas
        foreach ($columnHeaders as $key => $header) {
            $pdf->Cell($columnWidths[$key], 7, $header, 1, 0, 'C', true);
        }

        $pdf->Ln();

        $total = 0;
        while ($row = mysqli_fetch_array($result)) {
            $pdf->SetFont('helvetica', '', 10);
            $cantidad = $row['cantidad'];
            $nombre = $row['articulo'];
            $precioUnitario = $row['precioUnitario'];
            $precioFinal = $row['precioFinal'];

            $pdf->Cell($columnWidths[0], 7, $cantidad, 1, 0, 'C');
            $pdf->Cell($columnWidths[1], 7, $nombre, 1, 0, 'C');
            $pdf->Cell($columnWidths[2], 7, '$' . $precioUnitario, 1, 0, 'C');
            $pdf->Cell($columnWidths[3], 7, '$' . $precioFinal, 1, 1, 'C');

            $total += $precioFinal;
        }

        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->Cell(array_sum($columnWidths) - $columnWidths[3], 7, 'Total:', 1, 0, 'R');
        $pdf->Cell($columnWidths[3], 7, '$' . $total, 1, 1, 'C');

        $pdf->Ln(5);
        $pdf->SetFont('helvetica', '', 10);
        $pdf->Cell(0, 2, 'WHATSAPP: ' . CEL, 0, 1, 'C');
        $pdf->Cell(0, 2, 'INSTAGRAM: ' . INSTAGRAM, 0, 1, 'C');

        $pdf->Ln(2);
        $pdf->SetFont('helvetica', 'b', 10);
        $pdf->Cell(0, 2, 'Aceptamos todas las tarjetas,', 0, 1, 'C');
        $pdf->Cell(0, 2, 'MercadoPago y transferencia bancaria.', 0, 1, 'C');

        include("./servel.php");
        
        $pdf->Output('factura.pdf', 'I');
}


?>

