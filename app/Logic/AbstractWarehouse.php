<?php
namespace App\Logic;

use App\Contracts\StockableItem;

abstract class AbstractWarehouse implements \App\Contracts\Warehouse
{
    /**
     * @var StockableItem[]
     */
    private $items;

    protected function getById($id)
    {
        return isset($this->items[$id]) ? $this->items[$id] : null;
    }

    protected function setById($id, $item)
    {
        $this->items[$id] = $item;
    }

    public function add(StockableItem $item)
    {
        $id = $item->getUniqueId();

        if ($existing = $this->getById($id)) {
            $existing->increaseStock($item->getStock());
        } else {
            $this->setById($id, $item);
        }
    }
}
