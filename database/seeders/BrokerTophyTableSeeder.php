<?php

namespace Database\Seeders;

use App\Models\BrokerTrophy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrokerTophyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'id'=>1,
                'name'=>'Silver',
                'slug'=>'silver',
                'threshold'=> 1
            ],
            [
                'id'=>2,
                'name'=>'Bronze',
                'slug'=>'bronze',
                'threshold'=> 2
            ],
            [
                'id'=>3,
                'name'=>'Gold',
                'slug'=>'gold',
                'threshold'=> 3
            ],
            [
                'id'=>4,
                'name'=>'Diamond',
                'slug'=>'diamond',
                'threshold'=> 4
            ],
        ];

        BrokerTrophy::insert($items);
    }
}
