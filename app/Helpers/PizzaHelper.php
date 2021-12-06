<?php
namespace App\Helpers;

use App\Models\Pizza;

class PizzaHelper{

    /**
     * Recibe los ingredientes y calcula el precio
     * 
     * @return int
     */
    public static function calcularPrecio($ingredientes){
        $precio = 0;
        // dd($request->ingredientes);
        foreach ($ingredientes as $ingrediente) {
            $precio += $ingrediente;
        }
        
        $precio = $precio * 1.5;
        return $precio;
    }

}

?>