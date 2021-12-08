<?php

namespace App\Http\Controllers;

use App\Helpers\PizzaHelper;
use App\Http\Requests\PizzaStoreRequest;
use App\Http\Requests\PizzaUpdateRequest;
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

        foreach ($pizzas as $pizza) {
            # code...
            $pizza->ingredientes = PizzaIngredients::where('pizza_id', $pizza->id)->get();
        }
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

        $precio = PizzaHelper::calcularPrecio($request->ingredientes);
        $pizza = Pizza::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'imagen' => $path
        ]);

        foreach ($request->ingredientes as $ingredient_id) {
            $ingrediente = Ingredient::find($ingredient_id);
            PizzaIngredients::create([
                'pizza_id' => $pizza->id,
                'ingredient_id' => $ingredient_id,
                'ingrediente_nombre' => $ingrediente->nombre
            ]);
        }

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
        $pizza_ingredients = PizzaIngredients::select('ingredient_id as id')->where('pizza_id', $id)->orderBy('ingredient_id')
            ->get();
        $pizza_ingredients_aux = array();
        foreach ($pizza_ingredients as $pizza_ingredient) {
            # code...
            array_push($pizza_ingredients_aux, array('id' => $pizza_ingredient['id'], 'selected' => 'true'));
        }
        $all_ingredients = Ingredient::all()->toArray();
        // $ingredients_merge = array_merge($pizza_ingredients_aux, $all_ingredients);
        // $ingredients_merge = array_unique(array_merge($pizza_ingredients_aux, $all_ingredients), SORT_REGULAR);

        $i = 0;
        $pizza_ingredients_aux_2 = array();
        foreach ($all_ingredients as $ingredient) {
            # code...
            // dd($ingredient);
            // if ($i < count($all_ingredients)) {
                foreach ($pizza_ingredients_aux as $ingrediente_aux) {
                    # code...
                    if ($ingredient['id'] == $ingrediente_aux['id']) {
                        $ingredient['selected'] = true;
                        array_push($pizza_ingredients_aux_2, $ingredient);
                        unset($all_ingredients[$i]);
                    }
                }
            // }
            // if($x < count($pizza_ingredients_aux)){
            // }
            $i++;
        }

        $ingredients = array_merge($pizza_ingredients_aux_2, $all_ingredients);
        return view('pizza.edit', compact('pizza', 'ingredients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PizzaUpdateRequest $request, $id)
    {
        //
        $pizza = Pizza::find($id);
        if($request->has('imagen')){
            $path = $request->imagen->store('public/pizza');
        }else{
           $path =  $pizza->imagen;
        }
        // $pizza = new Pizza(); 
        $pizza->nombre = $request->nombre;
        $pizza->descripcion = $request->descripcion;
        $pizza->precio = $request->precio;
        $pizza->imagen = $path;
        $pizza->update();

        $pizza_ingredients = PizzaIngredients::where('pizza_id', $pizza->id)->delete();
        // $pizza_ingredients->delete();
        // $pizza_ingredients->ingredients = $request->ingredientes;
        // $pizza_ingredients->update();

        foreach ($request->ingredientes as $ingredient_id) {
            // $ingrediente = Ingredient::find($ingredient_id);
            // $pizza_ingredients->update()
            $ingrediente = Ingredient::find($ingredient_id);
            PizzaIngredients::create([
                'pizza_id' => $pizza->id,
                'ingredient_id' => $ingrediente->id,
                'ingrediente_nombre' => $ingrediente->nombre
            ]);
        }

        return redirect()->route('pizza.index')->with('message','La pizza fue actualizada!');
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
        Pizza::find($id)->delete();
        PizzaIngredients::where('pizza_id', $id)->delete();
        return redirect()->route('pizza.index')->with('message_delete','La pizza fue eliminada!');
    }
}
