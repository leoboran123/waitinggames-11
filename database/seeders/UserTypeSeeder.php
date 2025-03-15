<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserTypes;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        UserTypes::create([
         "user_type" => "guest"   
        ]);
        
        UserTypes::create([
            "user_type" => "business"   
        ]);
        
        UserTypes::create([
        "user_type" => "admin"   
        ]);

    }
}
