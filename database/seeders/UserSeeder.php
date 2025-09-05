<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'photo' => 'https://ui-avatars.com/api/?name=Andi+Al',
            'username' => 'AndiAl98',
            'name' => 'Andi Alfirdaus',
            'email' => 'andisr131117@gmail.com',
            'tagline' => 'Fullstack Developer | Back end specialist | Software Developer with JavaScript, PHP, Node JS, AWS Knowledge (RDS, S3, EC2, etc.), SQL (PostgreSQL & MySQL), NoSQL (MongoDB & Firebase)',
            'description' => 'Have a great interest in Information Technology, experience working part-time as a Fullstack web developer for less than 1 year, full-time internship for less than 3 months, full-time work as a back end developer for more than 1 year, and has high proficiency in using the Laravel Framework and Express JS to improve operational efficiency, as well as eager to learn frameworks like React JS etc. and other programming languages like Golang etc.',
            'password' => Hash::make('andisr98'),
            'district' => 'Kec. Wuluhan',
            'regency' => 'Kab. Jember',
            'province' => 'Jawa Timur',
            'country' => 'Indonesia',
        ]);
    }
}
