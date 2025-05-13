<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BanksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banks = [
            ['name' => 'Amana Bank', 'short_name' => 'ABL', 'sort_code' => '0000'],
            ['name' => 'Bank of Ceylon', 'short_name' => 'BOC', 'sort_code' => '0001'],
            ['name' => 'Cargills Bank', 'short_name' => 'Cargills', 'sort_code' => '0002'],
            ['name' => 'Commercial Bank of Ceylon PLC', 'short_name' => 'Commercial', 'sort_code' => '0003'],
            ['name' => 'DFCC Bank PLC', 'short_name' => 'DFCC', 'sort_code' => '0004'],
            ['name' => 'Habib Bank Ltd', 'short_name' => 'HBL', 'sort_code' => '0005'],
            ['name' => 'Hatton National Bank PLC', 'short_name' => 'HNB', 'sort_code' => '0006'],
            ['name' => 'HSBC', 'short_name' => 'HSBC', 'sort_code' => '0007'],
            ['name' => 'Indian Bank', 'short_name' => 'IB', 'sort_code' => '0008'],
            ['name' => 'Indian Overseas Bank', 'short_name' => 'IOB', 'sort_code' => '0009'],
            ['name' => 'MCB Bank', 'short_name' => 'MCB', 'sort_code' => '0010'],
            ['name' => 'National Development Bank PLC', 'short_name' => 'NDB', 'sort_code' => '0011'],
            ['name' => 'Nations Trust Bank PLC', 'short_name' => 'NTB', 'sort_code' => '0012'],
            ['name' => 'Pan Asia Banking Corporation PLC', 'short_name' => 'PAN Asia', 'sort_code' => '0013'],
            ['name' => 'Peoples Bank', 'short_name' => 'Peoples', 'sort_code' => '0014'],
            ['name' => 'Sampath Bank PLC', 'short_name' => 'Sampath', 'sort_code' => '0015'],
            ['name' => 'Seylan Bank PLC', 'short_name' => 'Seylan', 'sort_code' => '0016'],
            ['name' => 'State Bank of India', 'short_name' => 'SBI', 'sort_code' => '0017'],
            ['name' => 'Union Bank of Colombo PLC', 'short_name' => 'UBC', 'sort_code' => '0018'],
        ];

        DB::table('banks')->insert($banks);
    }
}
