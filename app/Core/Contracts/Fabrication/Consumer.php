<?php

namespace App\Core\Contracts\Fabrication;

/**
 * Interface Consumer
 *
 * @package App\Core\Contracts\Fabrication
 */
interface Consumer
{
    /**
     * Feed a consumer with consumable
     *
     * @param Consumable $consumable
     * @return void
     */
    public function add(Consumable $consumable);
}
