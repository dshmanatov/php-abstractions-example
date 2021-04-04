<?php
namespace App\Contracts;

interface Stockable
{
    public function getStock();
    public function increaseStock($quantity);
    public function decreaseStock($quantity);
}
