<?php

namespace App\Core\Contracts\Behavioural;

/**
 * Interface Identifiable
 *
 * @package App\Core\Contracts\Behavioural
 */
interface Identifiable
{
    /**
     * @return int|string
     */
    public function getIdentity();
}
