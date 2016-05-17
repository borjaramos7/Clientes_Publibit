<?php
/**
 * Libreria con las funciones de PDF que extiende de tcpdf
 */
defined('BASEPATH') OR exit('No direct script access allowed');
//require_once Base_url().'tcpdf/tcpdf.php';
//echo file_get_contents(Base_url().'tcpdf/tcpdf.php');
class Pdf extends FPDF {
        
        
        /**
         * Recibe un array con los datos del pedido otro con las lineas de dicho pedido y un booleano que le 
         * indica si el pdf es para mostrar o para enviar por correo y se encarga de rellenar el pdf con los datos recibidos
         * @param type $pedido
         * @param type $lineas
         * @param type $enviar
         */
        public function ExportaPdf($orden) {
             
            $pdf= new FPDF();
                $pdf->AddPage();
                $pdf->SetFont('helvetica','B',26);
                $pdf->SetTextColor(248,128,0);
                $pdf->Cell(0,7,"Orden ".$orden['idtrabajo'],0,0,'C');
                $pdf->Ln();$pdf->Ln();
                $pdf->SetFont('helvetica','B',12);
                $pdf->SetTextColor(70,70,70);
                $pdf->Image('asset/img/LOGO-PUBLIBIT-.png', 60, 222, 90, 20);
                $pdf->Cell(40,7,"Cliente: ".$orden['nomempresa'],0);
                $pdf->Ln();$pdf->Ln();
                $pdf->Cell(70,7,"Estado: ".$orden['estado'],0);
                $pdf->Ln();$pdf->Ln();
                $pdf->Cell(70,7,"Redactada por: ".$orden['redactor'],0);                
                $pdf->Ln();$pdf->Ln();
                $pdf->Cell(70,7,"Fecha inicio: ".$orden['fecha_inicio'],0);
                $pdf->Ln();$pdf->Ln();
                /*$pdf->writeHTML("<hr size='8px' color='black' />");
                $pdf->writeHTML("<pre> Denominación <br>".$orden['denominacion']."</pre><br>");
                $pdf->writeHTML("<pre> Descripción <br>".$orden['descripcion']."</pre>");*/

                //$pdf->Output();
                $pdf->Output($orden['nomempresa'].'_'.$orden['idtrabajo'].'.pdf','D');
        }
        
 
}