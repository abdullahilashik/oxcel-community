<?php

namespace Database\Seeders;

use App\Models\PostCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items= [
            [
                'id' => 1,
                'title' => 'PAYG Asset & PL',
                'slug' => 'payg-asset-pl'
            ],
            [
                'id' => 2,
                'title' => 'Commercial asset',
                'slug' => 'commercial-asset'
            ],
            [
                'id' => 3,
                'title' => 'Working capitals',
                'slug' => 'working-capitals'
            ],
            [
                'id' => 4,
                'title' => 'PAYG Residential',
                'slug' => 'payg-residential'
            ],
            [
                'id' => 5,
                'title' => 'Commercial mortgage',
                'slug' => 'commercial-mortgage'
            ],
            [
                'id' => 6,
                'title' => 'Insurance',
                'slug' => 'insurance'
            ],
            [
                'id' => 7,
                'title' => 'Industry partners',
                'slug' => 'industry-partners'
            ],
            [
                'id' => 8,
                'title' => 'Compliance',
                'slug' => 'compliance'
            ],
            [
                'id' => 9,
                'title' => 'Other',
                'slug' => 'other'
            ],
        ];

        PostCategory::insert($items);
    }
}
