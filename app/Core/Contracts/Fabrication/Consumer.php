<?php
namespace App\Core\Contracts\Fabrication;

interface Consumer
{
    public function add(Consumable $consumable);
}
