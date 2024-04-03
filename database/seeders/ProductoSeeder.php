<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $producto = new Producto();

        $producto->name = "Espada";
        $producto->save();


        $producto2 = new Producto();

        $producto2->name = "Casco";
        $producto2->save();

        $producto3 = new Producto();

        $producto3->name = "Poción";
        $producto3->save();

        $producto4 = new Producto();

        $producto4->name = "Daga";
        $producto4->save();

        $producto5 = new Producto();

        $producto5->name = "Bastón";
        $producto5->save();

        $producto6 = new Producto();

        $producto6->name = "Hacha";
        $producto6->save();

        $producto7 = new Producto();

        $producto7->name = "Maza";
        $producto7->save();

        $producto8 = new Producto();

        $producto8->name = "Pecho";
        $producto8->save();

        $producto9 = new Producto();

        $producto9->name = "Pantalones";
        $producto9->save();

        $producto10 = new Producto();

        $producto10->name = "Botas";
        $producto10->save();
    }
}
