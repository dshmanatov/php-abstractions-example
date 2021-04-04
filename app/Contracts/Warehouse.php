<?php
namespace App\Contracts;

interface Warehouse
{
    public function add(StockableItem $item);
    public function grab(WorkshopRecipe $recipe);
}
