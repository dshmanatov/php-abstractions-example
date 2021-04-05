<?php
namespace App\Contracts;

interface WorkshopRecipe
{
    public function getName();
    public function getResources();
    public function getDuration();
    public function getWorkshop();
}
