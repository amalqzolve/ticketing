<?php


use Illuminate\Database\Seeder;

class BoqTableSeeder extends Seeder
{
    public function run()
    {
        $shops = [
            [
                'category_name' => 'Books',
                    'children' => [
                        [    
                            'category_name' => 'Comic Book',
                            'children' => [
                                    ['category_name' => 'Marvel Comic Book'],
                                    ['category_name' => 'DC Comic Book'],
                                    ['category_name' => 'Action comics'],
                            ],
                        ],
                        [    
                            'category_name' => 'Textbooks',
                                'children' => [
                                    ['category_name' => 'Business'],
                                    ['category_name' => 'Finance'],
                                    ['category_name' => 'Computer Science'],
                            ],
                        ],
                    ],
                ],
                [
                    'category_name' => 'Electronics',
                        'children' => [
                        [
                            'category_name' => 'TV',
                            'children' => [
                                ['category_name' => 'LED'],
                                ['category_name' => 'Blu-ray'],
                            ],
                        ],
                        [
                            'category_name' => 'Mobile',
                            'children' => [
                                ['category_name' => 'Samsung'],
                                ['category_name' => 'iPhone'],
                                ['category_name' => 'Xiomi'],
                            ],
                        ],
                    ],
                ],
        ];
        foreach($shops as $shop)
        {
            \App\Boq::create($shop);
        }
    }
}
