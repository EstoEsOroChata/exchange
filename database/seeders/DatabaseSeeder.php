<?php

namespace Database\Seeders;

use App\Models\Historial;
use App\Models\Inventario;
use App\Models\Producto;
use App\Models\Subasta;
use App\Models\User;
use App\Models\Usuario;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            //UsuarioSeeder::class,
            SubastaSeeder::class,
            ProductoSeeder::class,
            HistorialSeeder::class,
            InventarioSeeder::class,
        ]);
        
        User::factory(10)->create();
        Subasta::factory(50)->create();
        Historial::factory(10)->create();
        Inventario::factory(50)->create();
        //Usuario::factory(50)->create();
        Producto::factory(50)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        
    }
}
