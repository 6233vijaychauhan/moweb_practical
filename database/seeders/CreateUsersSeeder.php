<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CreateUsersSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $check = User::where('email', "admin@admin.com")->count();

        if ($check == 0) {
            DB::table('users')->insert([                
                'name' => "admin",
                'email' => "admin@admin.com",
                'password' => bcrypt('password'),
                'status' => 1,
                'created_at' => Carbon::now(),
            ]);
        }
    }

}
