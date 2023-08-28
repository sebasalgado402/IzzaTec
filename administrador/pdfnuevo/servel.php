<?php 
// ...
$pdf->ln();
// Agregar línea
$pdf->SetLineWidth(0.5);
$pdf->Line($pdf->getMargins()['left'], $pdf->GetY(), $pdf->getPageWidth() - $pdf->getMargins()['right'], $pdf->GetY());

// ...

// Agregar imagen
$image_file = dirname(__FILE__) . './servel.jpeg';
$imageWidth = 50; // Ancho deseado para la imagen
$imageHeight = 40; // Alto deseado para la imagen
$imageMarginTop = 1; // Margen superior de la imagen

$pdf->Image($image_file, ($pdf->getPageWidth() - $imageWidth) / 2, $pdf->GetY() + $imageMarginTop, $imageWidth, $imageHeight, '', '', '', false, 300, '', false, false, 0);

// Establecer posición vertical para el texto debajo de la imagen
$textMarginBottom = 2; // Margen inferior del texto
$pdf->SetY($pdf->GetY() + $imageHeight + $textMarginBottom);

// Agregar texto debajo de la imagen
$text = 'Nuestros productos están disponibles en Provisión SerVel, Rep. Argentina 804';
$pdf->MultiCell(0, 10, $text, 0, 'C');


