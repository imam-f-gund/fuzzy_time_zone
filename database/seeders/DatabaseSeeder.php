<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        $user =
        [
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
            'created_at' => now(),
            'updated_at' => now(),
        ]; 
        
        $pendapatan =
    
        [
            [
                "Bulan"=> "Januari",
                "Tahun"=> "2021",
                "Pendapatan"=> "11520000"
            ],
            [
                "Bulan"=> "Febuari",
                "Tahun"=> "2021",
                "Pendapatan"=> "11290000"
            ],
            [
                "Bulan"=> "Maret",
                "Tahun"=> "2021",
                "Pendapatan"=> "20100000"
            ],
            [
                "Bulan"=> "April ",
                "Tahun"=> "2021",
                "Pendapatan"=> "12400000"
            ],
            [
                "Bulan"=> "Mei ",
                "Tahun"=> "2021",
                "Pendapatan"=> "26700000"
            ],
            [
                "Bulan"=> "Juni",
                "Tahun"=> "2021",
                "Pendapatan"=> "12860000"
            ],
            [
                "Bulan"=> "Juli",
                "Tahun"=> "2021",
                "Pendapatan"=> "18100000"
            ],
            [
                "Bulan"=> "Agustus",
                "Tahun"=> "2021",
                "Pendapatan"=> "10200000"
            ],
            [
                "Bulan"=> "September",
                "Tahun"=> "2021",
                "Pendapatan"=> "18650000"
            ],
            [
                "Bulan"=> "Oktober",
                "Tahun"=> "2021",
                "Pendapatan"=> "11670000"
            ],
            [
                "Bulan"=> "November ",
                "Tahun"=> "2021",
                "Pendapatan"=> "29000000"
            ],
            [
                "Bulan"=> "Desember",
                "Tahun"=> "2021",
                "Pendapatan"=> "27980000"
            ],
            [
                "Bulan"=> "Januari",
                "Tahun"=> "2022",
                "Pendapatan"=> "28400000"
            ],
            [
                "Bulan"=> "Febuari",
                "Tahun"=> "2022",
                "Pendapatan"=> "8160000"
            ],
            [
                "Bulan"=> "Maret",
                "Tahun"=> "2022",
                "Pendapatan"=> "22800000"
            ],
            [
                "Bulan"=> "April ",
                "Tahun"=> "2022",
                "Pendapatan"=> "15160000"
            ],
            [
                "Bulan"=> "Mei ",
                "Tahun"=> "2022",
                "Pendapatan"=> "13220000"
            ],
            [
                "Bulan"=> "Juni",
                "Tahun"=> "2022",
                "Pendapatan"=> "31000000"
            ],
            [
                "Bulan"=> "Juli",
                "Tahun"=> "2022",
                "Pendapatan"=> "26330000"
            ],
            [
                "Bulan"=> "Agustus",
                "Tahun"=> "2022",
                "Pendapatan"=> "13810000"
            ],
            [
                "Bulan"=> "September",
                "Tahun"=> "2022",
                "Pendapatan"=> "5560000"
            ],
            [
                "Bulan"=> "Oktober",
                "Tahun"=> "2022",
                "Pendapatan"=> "10920000"
            ],
            [
                "Bulan"=> "November ",
                "Tahun"=> "2022",
                "Pendapatan"=> "7500000"
            ],
            [
                "Bulan"=> "Desember",
                "Tahun"=> "2022",
                "Pendapatan"=> "25050000"
            ]
        
        ];

        DB::table('users')->insert($user);  
        DB::table('pendapatans')->insert($pendapatan);  
    

    }
}
