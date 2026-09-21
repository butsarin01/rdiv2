<?php

namespace Tests\Feature;

use App\Http\Controllers\FrontendController;
use Tests\TestCase;

class FrontendPersonnelRouteTest extends TestCase
{
    public function test_personnel_route_uses_frontend_controller_without_duplicate_name(): void
    {
        $route = app('router')->getRoutes()->getByName('index.board');

        $this->assertNotNull($route);
        $this->assertSame('Personnel={id?}', $route->uri());
        $this->assertSame(FrontendController::class.'@board', $route->getActionName());
        $this->assertCount(1, array_filter(
            iterator_to_array(app('router')->getRoutes()),
            fn ($registeredRoute) => $registeredRoute->getName() === 'index.board'
        ));
    }
}
