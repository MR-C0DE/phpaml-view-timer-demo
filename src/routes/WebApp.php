<?php

declare(strict_types=1);

namespace App\Routes;

use App\Controllers\HomeController;
use PHPAML\Routing\Route;

final class WebApp extends Route
{
    protected function routes(): void
    {
        $this->get('/api/health', [HomeController::class, 'index']);
    }
}
