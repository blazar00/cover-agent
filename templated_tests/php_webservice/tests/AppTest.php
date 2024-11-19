<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Slim\Factory\AppFactory;
use Slim\Psr7\Factory\ServerRequestFactory;

class AppTest extends TestCase
{
    protected $app;

    protected function setUp(): void
    {
        $this->app = AppFactory::create();
        $app = $this->app; // Ensure $app is defined for routes.php
        require __DIR__ . '/../src/public/routes.php';
    }

    public function testHomePage()
    {
        $request = $this->createRequest('GET', '/');
        $response = $this->app->handle($request);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('Welcome to the Slim application!', (string)$response->getBody());
    }

    public function testCurrentDate()
    {
        $request = $this->createRequest('GET', '/current-date');
        $response = $this->app->handle($request);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString(date('Y-m-d'), (string)$response->getBody());
    }

    // Add other tests here...

    protected function createRequest($method, $uri)
    {
        $requestFactory = new ServerRequestFactory();
        return $requestFactory->createServerRequest($method, $uri);
    }
}
