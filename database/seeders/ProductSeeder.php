<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('ru_RU');

        $categories = Category::all()->keyBy('name');

        if ($categories->isEmpty()) {
            $this->command->error('Сначала выполните CategorySeeder!');
            return;
        }

        // Массивы для генерации названий товаров по категориям
        $productTemplates = [
            'Электроника' => [
                'brands' => ['Samsung', 'Apple', 'Xiaomi', 'Huawei', 'Sony', 'LG', 'Lenovo', 'Asus', 'Acer', 'HP'],
                'models' => ['Galaxy', 'iPhone', 'Mi', 'Mate', 'Xperia', 'V30', 'ThinkPad', 'ZenBook', 'Aspire', 'Pavilion'],
                'suffixes' => ['Pro', 'Max', 'Plus', 'Ultra', 'Lite', 'SE', 'Mini', 'Air', 'Studio'],
                'types' => ['Смартфон', 'Ноутбук', 'Планшет', 'Наушники', 'Телевизор', 'Монитор', 'Клавиатура', 'Мышь'],
            ],
            'Одежда' => [
                'brands' => ['Nike', 'Adidas', 'Puma', 'Reebok', 'Zara', 'H&M', 'Levi\'s', 'Calvin Klein', 'Tommy Hilfiger', 'Lacoste'],
                'models' => ['Classic', 'Sport', 'Premium', 'Comfort', 'Style', 'Elite', 'Basic', 'Pro'],
                'suffixes' => ['Original', 'Limited', 'Edition', 'Collection', 'Series'],
                'types' => ['Футболка', 'Джинсы', 'Кроссовки', 'Куртка', 'Брюки', 'Рубашка', 'Платье', 'Свитер'],
            ],
            'Дом и сад' => [
                'brands' => ['IKEA', 'Leroy Merlin', 'OBI', 'Bosch', 'Philips', 'Tefal', 'Braun', 'KitchenAid'],
                'models' => ['Classic', 'Premium', 'Comfort', 'Pro', 'Elite', 'Standard', 'Deluxe'],
                'suffixes' => ['Plus', 'Max', 'Ultra', 'Edition', 'Collection'],
                'types' => ['Диван', 'Стол', 'Стул', 'Кровать', 'Шкаф', 'Пылесос', 'Микроволновка', 'Холодильник'],
            ],
            'Спорт и отдых' => [
                'brands' => ['Nike', 'Adidas', 'Puma', 'Reebok', 'Under Armour', 'Columbia', 'The North Face'],
                'models' => ['Sport', 'Pro', 'Elite', 'Active', 'Performance', 'Training', 'Outdoor'],
                'suffixes' => ['Max', 'Plus', 'Ultra', 'Pro', 'Edition'],
                'types' => ['Мяч', 'Гантели', 'Велосипед', 'Рюкзак', 'Кроссовки', 'Спортивный костюм', 'Тренажер'],
            ],
            'Красота и здоровье' => [
                'brands' => ['L\'Oreal', 'Nivea', 'Garnier', 'Maybelline', 'Clinique', 'Estee Lauder', 'MAC'],
                'models' => ['Classic', 'Premium', 'Natural', 'Sensitive', 'Pro', 'Elite'],
                'suffixes' => ['Plus', 'Max', 'Ultra', 'Collection', 'Series'],
                'types' => ['Крем', 'Шампунь', 'Помада', 'Тушь', 'Тональный крем', 'Сыворотка', 'Маска'],
            ],
            'Книги' => [
                'brands' => ['АСТ', 'Эксмо', 'Манн, Иванов и Фербер', 'Альпина', 'Питер', 'МИФ'],
                'models' => ['Классика', 'Современная', 'Бестселлер', 'Популярная', 'Редкая'],
                'suffixes' => ['Издание', 'Переиздание', 'Сборник', 'Полное издание'],
                'types' => ['Роман', 'Детектив', 'Фантастика', 'Учебник', 'Справочник', 'Энциклопедия'],
            ],
            'Игрушки' => [
                'brands' => ['LEGO', 'Hasbro', 'Mattel', 'Fisher-Price', 'Playmobil', 'Hot Wheels'],
                'models' => ['Classic', 'Deluxe', 'Premium', 'Pro', 'Elite', 'Standard'],
                'suffixes' => ['Edition', 'Collection', 'Series', 'Limited'],
                'types' => ['Конструктор', 'Кукла', 'Машинка', 'Пазл', 'Набор', 'Фигурка', 'Мягкая игрушка'],
            ],
            'Автомобили' => [
                'brands' => ['Toyota', 'BMW', 'Mercedes-Benz', 'Audi', 'Volkswagen', 'Ford', 'Hyundai'],
                'models' => ['Camry', 'X5', 'C-Class', 'A4', 'Golf', 'Focus', 'Elantra'],
                'suffixes' => ['Sport', 'Premium', 'Luxury', 'Edition', 'Limited'],
                'types' => ['Седан', 'Кроссовер', 'Хэтчбек', 'Внедорожник', 'Купе'],
            ],
            'Еда и напитки' => [
                'brands' => ['Coca-Cola', 'Pepsi', 'Nestle', 'Danone', 'Ferrero', 'Mars', 'Kinder'],
                'models' => ['Classic', 'Original', 'Premium', 'Light', 'Zero', 'Max'],
                'suffixes' => ['Plus', 'Max', 'Ultra', 'Collection', 'Edition'],
                'types' => ['Шоколад', 'Сок', 'Вода', 'Йогурт', 'Печенье', 'Чипсы', 'Напиток'],
            ],
            'Мебель' => [
                'brands' => ['IKEA', 'Леруа Мерлен', 'Askona', 'Hoff', 'Мебель России'],
                'models' => ['Classic', 'Premium', 'Comfort', 'Pro', 'Elite', 'Standard'],
                'suffixes' => ['Plus', 'Max', 'Ultra', 'Collection', 'Edition'],
                'types' => ['Диван', 'Кресло', 'Стол', 'Стул', 'Кровать', 'Шкаф', 'Комод', 'Тумба'],
            ],
        ];

        // Создаем 100 товаров
        for ($i = 0; $i < 100; $i++) {
            $category = $faker->randomElement($categories);
            $categoryName = $category->name;

            // Генерируем название товара
            $name = $this->generateProductName($categoryName, $productTemplates, $faker);

            Product::create([
                'name' => $name,
                'price' => $faker->randomFloat(2, 100, 50000),
                'category_id' => $category->id,
                'in_stock' => $faker->boolean(80), // 80% вероятность наличия
                'rating' => $faker->randomFloat(2, 0, 5),
            ]);
        }
    }

    /**
     * Генерирует название товара на основе категории и шаблонов
     */
    private function generateProductName(string $categoryName, array $templates, $faker): string
    {
        if (!isset($templates[$categoryName])) {
            // Если категории нет в шаблонах, используем простой вариант
            return $faker->words(rand(2, 4), true);
        }

        $template = $templates[$categoryName];
        $parts = [];

        // С вероятностью 70% добавляем бренд
        if ($faker->boolean(70)) {
            $parts[] = $faker->randomElement($template['brands']);
        }

        // Добавляем тип товара (всегда)
        $parts[] = $faker->randomElement($template['types']);

        // С вероятностью 50% добавляем модель
        if ($faker->boolean(50)) {
            $parts[] = $faker->randomElement($template['models']);
        }

        // С вероятностью 30% добавляем суффикс
        if ($faker->boolean(30)) {
            $parts[] = $faker->randomElement($template['suffixes']);
        }

        return implode(' ', $parts);
    }
}
