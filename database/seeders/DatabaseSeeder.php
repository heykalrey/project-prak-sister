<?php

namespace Database\Seeders;

use App\Models\TagsModel;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $datas = [
            [
                'name' => 'Personal',
                'color' => '#FF0000',
                'description' => 'Personal task',
                'category' => 'Personal'
            ],
            [
                'name' => 'Work',
                'color' => '#00FF00',
                'description' => 'Work task',
                'category' => 'Work'
            ],
            [
                'name' => 'Shopping',
                'color' => '#0000FF',
                'description' => 'Shopping task',
                'category' => 'Shopping'
            ],
            [
                'name' => 'Study',
                'color' => '#FFFF00',
                'description' => 'Study task',
                'category' => 'Study'
            ],
            [
                'name' => 'Meeting',
                'color' => '#00FFFF',
                'description' => 'Meeting task',
                'category' => 'Meeting'
            ],
        ];
        foreach ($datas as $data) {
            TagsModel::create($data);
        }
    }
}
