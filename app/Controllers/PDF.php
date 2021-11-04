<?php
namespace App\Controllers;

use App\Models\ProductoModel;
use CodeIgniter\Controller;
use TCPDF;

class PDF extends Controller
{
    public function __construct()
    {
        $this->db = db_connect();
    }

    public function productosPDF()
    {
        $pdf = new TCPDF();
        $productos = new ProductoModel();

        $pdf->setHeaderMargin(10);
        $pdf->setHeaderData(PDF_HEADER_LOGO, 60, 'Reporte', 'productos');
        $pdf->SetMargins(20, 35, 20);
        // Consulta a bd
        $sucursal = $productos->listarProductos();
        helper('number');
        //var_dump($sucursal);
        $html = '<table border="1" cellpadding="1">
            <tr style="background-color: black; color: white; text-align:center;">
            <td>Código</td>
            <td>Nombre</td>
            <td>Código de la marca</td>
            <td>Marca</td>
            <td>Precio</td>
            <td>Estado Actual</td>
            </tr>';
            $html .= '<tbody>';

        foreach ($sucursal as $value) {
                $estado = $value->estado = 1 ? 'Disponible' : 'No Disponible';
                $deco = $value->estado = 1 ? 'none' : 'underline';
            $html .= '<tr>
                <td style="background-color: lightgrey; text-align:center;">' . $value->codigo . '</td>
                        <td>' . $value->nombre . '</td>
                        <td>' . $value->marca . '</td>
                        <td>' . $value->marca_nombre . '</td>
                        <td>' . number_to_currency($value->precio, 'USD', 'en_US', 2) . '</td>
                        <td style="text-decoration: '.$deco.'">' .  $estado . '</td>
                </tr>';
        }

        $html .= '</tbody>';
        $html .= '</table>';
        $pdf->AddPage();
        $pdf->writeHTML($html);

// ---------------------------------------------------------

//Close and output PDF document
        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output('listado-de-productos.pdf', 'I');
    }
}
