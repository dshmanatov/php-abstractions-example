<?php

namespace Database\Seeders;

use App\Models\Recipe;
use App\Models\RecipeResource;
use App\Models\Resource;
use App\Models\Workshop;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        Workshop::truncate();
        RecipeResource::truncate();
        Resource::truncate();
        Recipe::truncate();

        Resource::insert([
            ['name' => 'Вода', 'stock' => 100],
            ['name' => 'Камень', 'stock' => 50],
            ['name' => 'Глина', 'stock' => 30],
        ]);

        Workshop::insert([
            ['name' => 'Фабрика №1'],
            ['name' => 'Фабрика №2'],
        ]);

        Recipe::insert([
            ['name' => 'Р1'],
            ['name' => 'Р2'],
            ['name' => 'Р3'],
            ['name' => 'Р4'],
        ]);

        RecipeResource::insert([
            ['recipe_id' => 1, 'resource_id' => 1, 'quantity' => 2],
            ['recipe_id' => 1, 'resource_id' => 2, 'quantity' => 1],
            ['recipe_id' => 2, 'resource_id' => 2, 'quantity' => 1],
            ['recipe_id' => 2, 'resource_id' => 3, 'quantity' => 1],
            ['recipe_id' => 3, 'resource_id' => 1, 'quantity' => 3],
            ['recipe_id' => 3, 'resource_id' => 3, 'quantity' => 1],
            ['recipe_id' => 4, 'resource_id' => 2, 'quantity' => 2],
            ['recipe_id' => 4, 'resource_id' => 3, 'quantity' => 1],
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
