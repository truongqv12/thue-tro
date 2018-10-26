<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        if (\App\Models\User::count() == 0) {
//            \App\Models\User::create([
//                'use_email'     => 'truongqv13@gmail.com',
//                'use_password'  => bcrypt('123456'),
//                'use_name'      => 'Trần Trọng Trường',
//                'use_phone'     => '01679573155',
//                'use_birthdays' => '1996-22-01',
//                'use_address'   => 'Ngõ 53 Lê Văn Hiến, Đức Thắng, Bắc Từ Liêm, Hà Nội',
//                'use_status'    => '1'
//            ]);
//        }

        factory(App\Models\User::class, 10)->create([
            'use_address'   => 'Ngõ 53 Lê Văn Hiến, Đức Thắng, Bắc Từ Liêm, Hà Nội',
        ]);
    }
}
