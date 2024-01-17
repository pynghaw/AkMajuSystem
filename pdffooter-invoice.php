<?php

class PDFFooter
{
    public function addFooter($pdf)
    {
        $pdf->SetY(-50); // Position the cursor 50mm from the bottom
        $pdf->SetX(-50); // Align to the right side
        $this->DottedLine($pdf, 40, 0);

        $pdf->SetY(-45); // Position the cursor 50mm from the bottom
        $pdf->SetX(-50); // Align to the right side
        $pdf->SetFont('Arial', 'B', 7); // Set font to bold and size 12
        $pdf->Cell(0, 5, 'PREPARED BY', 0, 0);

        $pdf->SetY(-50); // Position the cursor 50mm from the bottom
        $pdf->SetX(-100); // Align to the right side
        $this->DottedLine($pdf, 40, 0);

        $pdf->SetY(-45); // Position the cursor 50mm from the bottom
        $pdf->SetX(-100); // Align to the right side
        $pdf->SetFont('Arial', 'B', 7); // Set font to bold and size 12
        $pdf->Cell(0, 5, 'CHECKED BY', 0, 0);

        $pdf->SetY(-50); // Position the cursor 50mm from the bottom
        $pdf->SetX(-150); // Align to the right side
        $this->DottedLine($pdf, 40, 0);

        $pdf->SetY(-45); // Position the cursor 50mm from the bottom
        $pdf->SetX(-150); // Align to the right side
        $pdf->SetFont('Arial', 'B', 7); // Set font to bold and size 12
        $pdf->Cell(0, 5, 'APPROVED BY', 0, 0);

        $pdf->SetY(-50); // Position the cursor 50mm from the bottom
        $pdf->SetX(-200); // Align to the right side
        $this->DottedLine($pdf, 40, 0);

        $pdf->SetY(-45); // Position the cursor 50mm from the bottom
        $pdf->SetX(-200); // Align to the right side
        $pdf->SetFont('Arial', 'B', 7); // Set font to bold and size 12
        $pdf->Cell(0, 5, 'RECEIVED BY', 0, 0);


        // Add line across the PDF
        $pdf->SetY(-35);
        $pdf->Cell(190, 0, '', 'T');

        // Add "SIMPLIFIED BUSINESS SYSTEM" text on the bottom left
        $pdf->SetY(-28);
        $pdf->SetFont('Arial', 'I', 8);
        $pdf->Cell(0, 5, 'SIMPLIFIED BUSINESS SYSTEM', 0, 0, 'L');

        // Add date and time on the bottom right
        $pdf->SetY(-28);
        $pdf->SetFont('Arial', 'I', 8);
        $pdf->Cell(0, 5, 'Date: ' . date('Y-m-d H:i:s'), 0, 0, 'R');
    }

    private function DottedLine($pdf, $length, $height)
    {
        for ($i = 0; $i < $length; $i += 4) {
            $pdf->Line($pdf->GetX(), $pdf->GetY(), $pdf->GetX() + 2, $pdf->GetY() + $height);
            $pdf->SetX($pdf->GetX() + 4);
        }
    }
}


?>
