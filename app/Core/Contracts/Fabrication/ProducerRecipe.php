<?php

namespace App\Core\Contracts\Fabrication;

use App\Core\Contracts\Behavioural\Durationable;
use App\Core\Contracts\Behavioural\Nameable;

/**
 * Interface ProducerRecipe
 *
 * @package App\Core\Contracts\Fabrication
 */
interface ProducerRecipe extends Recipe, Durationable, Nameable
{
    /**
     * Recipe should belong to a producer
     *
     * @return mixed
     */
    public function getProducer();
}

