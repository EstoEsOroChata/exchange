<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();

        $user-> name = "Jesús";
        $user-> email = "i3sus.maggie@gmail.com";
        $user-> password = bcrypt('1234');
        $user-> es_admin = true;
        $user-> oro = 1000;
        
        $user->save();

        $user2 = new User();

        $user2-> name = "Celeste";
        $user2-> email = "celeste@gmail.com";
        $user2-> password = bcrypt('1234');
        $user2-> es_admin = false;
        $user2-> oro = 1000;
        
        $user2->save();
    }
}
