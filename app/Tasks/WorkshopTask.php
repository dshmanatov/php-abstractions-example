<?php

namespace App\Tasks;


use App\Contracts\PrettyDescription;
use App\Core\Contracts\Fabrication\Producer;
use App\Core\Contracts\Fabrication\ProducerRecipe;
use App\Core\Logic\Task\AbstractTask;
use App\Types\Good;

/**
 * Class WorkshopTask
 *
 * @package App\Tasks
 */
class WorkshopTask extends AbstractTask implements PrettyDescription
{
    /**
     * @var ProducerRecipe
     */
    private $recipe;

    /**
     * WorkshopTask constructor.
     *
     * @param ProducerRecipe $recipe
     */
    public function __construct(ProducerRecipe $recipe)
    {
        $this->recipe = $recipe;
    }

    /**
     * @return Producer
     */
    public function getProducer()
    {
        return $this->recipe->getProducer();
    }

    /**
     * @return mixed
     */
    public function getDuration()
    {
        return $this->recipe->getDuration();
    }

    /**
     * Return CONCRETE good
     *
     * @return Good
     */
    public function getResult()
    {
        return new Good($this->recipe->getName());
    }

    /**
     * @return string
     */
    public function getPrettyDescription()
    {
        return $this->recipe->getName() . ', длительность: ' . $this->recipe->getDuration();
    }
}
