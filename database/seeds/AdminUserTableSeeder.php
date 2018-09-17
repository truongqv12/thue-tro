<?php

use Illuminate\Database\Seeder;

class AdminUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (\App\Models\Admin::count() == 0) {
            \App\Models\Admin::create([
                'adm_login_name' => 'admin',
                'adm_email'      => 'admin@gmail.com',
                'adm_name'       => 'Trần Trọng Trường',
                'adm_phone'      => '01679573155',
                'adm_password'   => bcrypt('admin'),
            ]);
        }
    }
}
