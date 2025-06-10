<?php

namespace App\Services\Pdf;

use Dompdf\Dompdf;
use Dompdf\Options;

class PdfService {

    public function generateProof($venda, $produtos) : bool {
        try{
            $path = __DIR__ . '/../../Resources/Pdf/venda.php';

            ob_start();
                extract((array)$venda);
                extract((array)$produtos);
                
                include $path;
            $pdf = ob_get_clean();

            $options = new Options();
            $options->set('isRemoteEnabled', true);

            $dompdf = new Dompdf($options);
            $dompdf->loadHtml($pdf);
            $dompdf->setPaper([0, 0, 165, 600], 'portrait');
            $dompdf->render();
            $dompdf->stream('Venda.pdf', ['Attachment' => false]);

            return true;
        }catch(\Throwable $th){
            return false;
        }
    }

}