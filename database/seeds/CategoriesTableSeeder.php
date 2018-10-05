<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$categories = [
			'Artigos',
			'Livros',
			'Resenhas',
			'Cartilhas',
			'Leis',
			'Outros',
		];
		foreach($categories as $category) {
			Category::create([
				'category' => $category,
			]);
		}
    }
}
