<?php
namespace App\Contracts;

interface WorkshopRecipe
{
    public function getResources();
    public function getDuration();
}
