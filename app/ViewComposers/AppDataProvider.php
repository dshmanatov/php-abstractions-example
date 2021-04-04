<?php

namespace App\ViewComposers;

use Illuminate\View\View;

class AppDataProvider
{
    public function compose(View $view)
    {
        $view->with('appData', [
            'API_URL' => config('api.url'),
        ]);
    }
}
