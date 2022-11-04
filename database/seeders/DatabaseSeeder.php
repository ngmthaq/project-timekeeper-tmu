<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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

        User::truncate();
        DB::table('users')->insert([
            'name' => 'Nguyen Manh Thang',
            'birthday' => '2000-12-01',
            'username' => 'thangnm',
            'email' => 'thangnm@gmail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role' => "1",
        ]);
        DB::table('users')->insert([
            'name' => 'Vu Ngoc Tien',
            'birthday' => '2000-12-01',
            'username' => 'tienvn',
            'email' => 'tienvn@gmail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role' => "1",
        ]);
    }
}
