<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ProductoSeeder::class,
            UserSeeder::class,
            SubastaSeeder::class, 
            ProfileSeeder::class,
            AdminSeeder::class,
        ]);
        
         Profile::factory(10)->create();
        // Producto::factory(50)->create();
        // Subasta::factory(50)->create();
        // Historial::factory(10)->create();
        

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        
    }
}
