<?php

namespace App\Http\Controllers;

use App\Helpers\PizzaHelper;
use App\Http\Requests\PizzaStoreRequest;
use App\Models\Ingredient;
use App\Models\Pizza;
use App\Models\PizzaIngredients;
use Illuminate\Http\Request;

class PizzaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pizzas = Pizza::paginate(5);
        return view('pizza.index', compact('pizzas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $ingredientes = Ingredient::all();
        return view("pizza.create", compact('ingredientes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PizzaStoreRequest $request)
    {
        $path = $request->imagen->store('public/pizza');
        // dd($precio);
        foreach ($request->ingredientes as $ingredient_id) {
            $ingrediente = Ingredient::find($ingredient_id);
            PizzaIngredients::create([
                'pizza_id' => $id,
                'ingredient_id' => $ingredient_id,
                'ingrediente_nombre' => $ingrediente->nombre
            ]);
        }

        $precio = PizzaHelper::calcularPrecio($request->ingredientes);
        $pizza = Pizza::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $precio,
            'imagen' => $path
        ]);
        // dd($pizza);
        //genera los ingredientes de la pizza
        PizzaIngredients::create([
            'pizza_id' => $pizza->id,
            'ingredient_id' => $ingredient_id,
            'ingrediente_nombre' => $ingrediente->nombre
        ]);

        return redirect()->route('pizza.index')->with('message', 'La pizza fue creada correctamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pizza = Pizza::find($id);
        $pizza_ingredients = PizzaIngredients::where('pizza_id', $id)->orderBy('ingredient_id')
            ->take(10)->get();
        $ingredients = array();
        foreach ($pizza_ingredients as $ingredient) {
            # code...
            array_push($ingredients, $ingredient);
        }
        return view('pizza.edit', compact('pizza', 'ingredients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
