<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $user = new User();
        $user->name = 'Admin';
        $user->email = 'admin@gmail.com';
        $user->password = bcrypt('12345678');
        $user->is_admin = 1;
        $user->save();

        $ingrediente = new Ingredient();
        $ingrediente->nombre = 'Pepperoni';
        $ingrediente->descripcion = 'Pepperoni';
        $ingrediente->precio = 10;
        $ingrediente->save();
        
        $ingrediente = new Ingredient();
        $ingrediente->nombre = 'Mozzarella';
        $ingrediente->descripcion = 'La mejor muzza';
        $ingrediente->precio = 5;
        $ingrediente->save();
        
        $ingrediente = new Ingredient();
        $ingrediente->nombre = 'Hongos';
        $ingrediente->descripcion = 'Hongos de pino';
        $ingrediente->precio = 15;
        $ingrediente->save();
        
        $ingrediente = new Ingredient();
        $ingrediente->nombre = 'Cebolla morada';
        $ingrediente->descripcion = 'Cebolla morada de la huerta';
        $ingrediente->precio = 3;
        $ingrediente->save();
        $ingrediente->save();
        
        $ingrediente = new Ingredient();
        $ingrediente->nombre = 'Tomates cherry';
        $ingrediente->descripcion = 'Tomates cherry de la huerta';
        $ingrediente->precio = 4;
        $ingrediente->save();
        
        $ingrediente = new Ingredient();
        $ingrediente->nombre = 'Berenjena';
        $ingrediente->descripcion = 'Berenjenasa de la huerta';
        $ingrediente->precio = 3;
        $ingrediente->save();
        $ingrediente->save();
        
        $ingrediente = new Ingredient();
        $ingrediente->nombre = 'Queso provolone';
        $ingrediente->descripcion = 'El mejor provolone';
        $ingrediente->precio = 12;
        $ingrediente->save();

        $ingrediente = new Ingredient();
        $ingrediente->nombre = 'Mortadela';
        $ingrediente->descripcion = 'La mejor mortadela';
        $ingrediente->precio = 11;
        $ingrediente->save();

        $ingrediente = new Ingredient();
        $ingrediente->nombre = 'Jamon';
        $ingrediente->descripcion = 'El mejor jamon';
        $ingrediente->precio = 9;
        $ingrediente->save();
    }
}
