<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Электроника',
            'Одежда',
            'Дом и сад',
            'Спорт и отдых',
            'Красота и здоровье',
            'Книги',
            'Игрушки',
            'Автомобили',
            'Еда и напитки',
            'Мебель',
        ];

        foreach ($categories as $categoryName) {
            Category::create([
                'name' => $categoryName,
            ]);
        }
    }
}
