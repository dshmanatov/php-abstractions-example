<?php

namespace Tests\Unit;

use App\Core\Contracts\Fabrication\Consumer;
use App\Core\Contracts\Fabrication\Producer;
use App\Core\Contracts\Fabrication\Recipe;
use App\Core\Contracts\Fabrication\RecipeItem;
use App\Core\Contracts\Fabrication\StockableItem;
use App\Core\Contracts\Timeline\Timeline;
use App\Logic\Fabricator;
use App\Logic\Stock;
use App\Traits\WorkshopTrait;
use PHPUnit\Framework\TestCase;

class FabricatorTest extends TestCase
{
    private $stockItems = [
        [1, 100],
        [2, 50],
        [3, 30],
    ];

    private $producers = [
        [
            'recipes' => [
                [
                    'name'  => 'Р1',
                    'items' => [
                        [1, 2], // Вода(2)
                        [2, 1], // Камень(1)
                    ]
                ],
                [
                    'name'  => 'Р2',
                    'items' => [
                        [2, 1], // Камень(1)
                        [3, 1], // Глина(1)
                    ]
                ]
            ]
        ],
        [
            'recipes' => [
                [
                    'name'  => 'Р3',
                    'items' => [
                        [1, 3], // Вода(3)
                        [3, 1], // Глина(1)
                    ]
                ],
                [
                    'name'  => 'Р4',
                    'items' => [
                        [2, 2], // Камень(2)
                        [3, 1], // Глина(1)
                    ]
                ]
            ]
        ]
    ];

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testProduce()
    {
        $fabricator = $this->mockFabricator();
    }

    private function mockTimeline()
    {
        $timeline = $this->createMock(Timeline::class);

        return $timeline;
    }

    private function mockStockableItem($array)
    {
        $item = $this->createMock(StockableItem::class);

        $item->method('getUniqueId')
            ->willReturn($array[0]);

        $item->method('getStock')
            ->willReturn($array[1]);

        return $item;
    }

    private function mockStock()
    {
        $stock = new Stock();

        foreach ($this->stockItems as $stockItem) {
            $stock->add($this->mockStockableItem($stockItem));
        }

        return $stock;
    }

    private function mockProducers()
    {
        $producers = collect($this->producers)
            ->map(function ($fixture) {
                return $this->mockProducer($fixture);
            });

        return $producers;
    }

    private function mockProducer($fixture)
    {
        $producer = $this->getMockForTrait(WorkshopTrait::class);

        $producer->method('getRecipes')
            ->willReturn($this->mockRecipes($fixture['recipes']));

        return $producer;
    }

    private function mockRecipes($fixture)
    {
        $recipes = collect($fixture)
            ->map(function ($fixture) {
                return $this->mockRecipe($fixture);
            });

        return $recipes;
    }

    private function mockRecipe($fixture)
    {
        $recipe = $this->createMock(Recipe::class);
        $recipe->method('getItems')
            ->willReturn($this->mockRecipeItems($fixture['items']));

        return $recipe;
    }

    private function mockRecipeItems($fixture)
    {
        $items = collect($fixture)
            ->map(function ($fixture) {
                $item = $this->createMock(RecipeItem::class);

                $item->method('getUniqueId')
                    ->willReturn($fixture[0]);

                $item->method('getQuantity')
                    ->willReturn($fixture[1]);

                return $item;
            });

        return $items;
    }

    private function mockConsumer()
    {
        $consumer = $this->createMock(Consumer::class);

        return $consumer;
    }

    private function mockFabricator()
    {
        $fabricator = new Fabricator($this->mockTimeline());

        $fabricator->setStock($this->mockStock());
        $fabricator->setProducers($this->mockProducers());
        $fabricator->setConsumer($this->mockConsumer());

        return $fabricator;
    }
}
