<?php
namespace App\Types;

use App\Core\Contracts\Fabrication\Consumable;

/**
 * Class Good
 *
 * Товар, произведенный в результате работы
 *
 * @package App\Types
 */
class Good implements Consumable
{
    private $name;

    /**
     * Good constructor.
     *
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}
