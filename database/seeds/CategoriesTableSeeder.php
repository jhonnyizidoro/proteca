<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'category' => 'Artigos'
        ]);
        Category::create([
            'category' => 'Livros'
        ]);
        Category::create([
            'category' => 'Resenhas'
        ]);
        Category::create([
            'category' => 'Cartilhas'
        ]);
        Category::create([
            'category' => 'Leis'
        ]);
        Category::create([
            'category' => 'Outros'
        ]);
    }
}
