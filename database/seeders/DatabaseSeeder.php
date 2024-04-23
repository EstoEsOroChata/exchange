<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Subasta;
use App\Models\User;
use App\Models\UsersProductos;
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
            UsersProductosSeeder::class,
        ]);
        
        UsersProductos::factory(10)->create();
        

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        
    }
}
