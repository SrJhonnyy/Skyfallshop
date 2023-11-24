<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compra; // Asegúrate de importar el modelo Compra

// CompraController.php

use PDF;

class CompraController extends Controller
{
    public function mostrarCompra($idCompra)
    {
        // Lógica para obtener los datos de la compra basada en $idCompra
        $compra = Compra::find($idCompra);

        // Retorna la vista con los datos de la compra y el ID
        return view('compra', compact('compra', 'idCompra'));
    }

    public function generarPDF($idCompra)
    {
        // Lógica para obtener los datos de la compra basada en $idCompra
        $compra = Compra::find($idCompra);

        // Genera el PDF directamente desde la vista de compra
        $pdf = PDF::loadView('Compra', compact('compra'));
        
        if ($pdf->count() > 0) {
            return $pdf->download('factura_compra.pdf');
        } else {
            // Manejar el caso en el que el PDF está vacío
            return response()->json(['error' => 'El PDF está vacío'], 500);
        }
    }
}
