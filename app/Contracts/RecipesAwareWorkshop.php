<?php
namespace App\Contracts;

use Illuminate\Support\Collection;

interface RecipesAwareWorkshop {
	/**
	 * @return Collection
	 */
	public function getRecipes();
}
