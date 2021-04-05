<?php
namespace App\Contracts;

interface Warehouse extends \Stringable
{
    public function add(StockableItem $item);
    public function grab(WorkshopRecipe $recipe);
}
