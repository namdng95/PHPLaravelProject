<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
            [
                'admin_email' => 'admin@gmail.com',
                'admin_password' => Hash::make('123456'),
            ]
        ];
        DB::table('admin')->insert($data);
    }
}
