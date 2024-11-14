<?php
require('fpdf/fpdf.php'); // Inclure la bibliothèque FPDF

// Création d'une instance de FPDF
$pdf = new FPDF();
$pdf->AddPage(); // Ajouter une page au document PDF
$pdf->SetFont('Arial', 'B', 16); // Définir la police

// Ajouter du texte au PDF
$pdf->Cell(40, 10, 'Hello World!');
$pdf->Ln(); // Saut de ligne

// Générer le fichier PDF et le télécharger
$pdf->Output('D', 'visa_request.pdf'); // 'D' pour forcer le téléchargement
?>
