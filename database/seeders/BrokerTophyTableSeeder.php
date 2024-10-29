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
                'name'=>'Baby',
                'slug'=>'baby',
                'threshold'=> 1
            ],
            [
                'id'=>2,
                'name'=>'Level 2',
                'slug'=>'level-2',
                'threshold'=> 3
            ],
            [
                'id'=>3,
                'name'=>'Level 3',
                'slug'=>'level-3',
                'threshold'=> 5
            ],
            [
                'id'=>4,
                'name'=>'Level 4',
                'slug'=>'level-5',
                'threshold'=> 10
            ],
            [
                'id'=>5,
                'name'=>'Supreme',
                'slug'=>'supreme',
                'threshold'=> 100
            ],
        ];

        BrokerTrophy::insert($items);
    }
}
