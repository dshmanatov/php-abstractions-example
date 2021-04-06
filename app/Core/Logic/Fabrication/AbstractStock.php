<?php

namespace App\Core\Logic\Fabrication;

use App\Core\Contracts\Fabrication\Stock;
use App\Core\Contracts\Fabrication\StockableItem;

/**
 * Class AbstractStock
 *
 * @package App\Core\Logic\Fabrication
 */
abstract class AbstractStock implements Stock
{
    /**
     * @var StockableItem[]
     */
    protected $items;

    /**
     * Return item by id
     *
     * @param $id
     * @return StockableItem|null
     */
    protected function getById($id)
    {
        return isset($this->items[$id]) ? $this->items[$id] : null;
    }

    /**
     * Set item by id
     *
     * @param $id
     * @param $item
     */
    protected function setById($id, $item)
    {
        $this->items[$id] = $item;
    }

    /**
     * Add item to stock
     *
     * @param StockableItem $item
     */
    public function add(StockableItem $item)
    {
        $id = $item->getIdentity();

        if ($existing = $this->getById($id)) {
            $existing->increaseStock($item->getStock());
        } else {
            $this->setById($id, $item);
        }
    }
}
