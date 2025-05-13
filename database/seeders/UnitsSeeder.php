<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('units')->insert([
            [
                'name' => 'Kilogram',
                'symbol' => 'kg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gram',
                'symbol' => 'g',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Metric Ton',
                'symbol' => 't',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Liter',
                'symbol' => 'L',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Milliliter',
                'symbol' => 'mL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Piece',
                'symbol' => 'pc',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dozen',
                'symbol' => 'dz',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Box',
                'symbol' => 'box',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pack',
                'symbol' => 'pk',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Centimeter',
                'symbol' => 'cm',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Square Meter',
                'symbol' => 'm²',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Square Foot',
                'symbol' => 'ft²',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Millimeter',
                'symbol' => 'mm',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
