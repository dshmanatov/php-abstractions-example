<?php
namespace App\Logic;

class Fabrication implements \App\Contracts\Fabrication
{
    public $workshops;

    public function __construct($workshops)
    {
        $this->workshops = $workshops;
    }
}
