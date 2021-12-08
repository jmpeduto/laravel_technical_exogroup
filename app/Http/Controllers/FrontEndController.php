<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pizza;
use App\Models\PizzaIngredients;

class FrontEndController extends Controller
{
    //
    public function index(Request $request)
    {
        $pizzas = Pizza::get();
        $pizzas_final = array();
        foreach ($pizzas as $pizza) {
            # code...
            $pizza_ingredientes = PizzaIngredients::select('*')->where('pizza_id', $pizza->id)->orderBy('ingredient_id')
            ->get();
            $pizza->ingredients = $pizza_ingredientes;
            array_push($pizzas_final, $pizza);
        }

        // dd($pizzas_final);
        return view('frontpage', compact('pizzas_final'));


    }
}
