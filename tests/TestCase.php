<?php

declare(strict_types=1);

namespace Misaf\VendraFaq\Tests;

use Illuminate\Support\Facades\Http;
use Misaf\VendraFaq\FaqServiceProvider;
use Orchestra\Testbench\TestCase as TestbenchTestCase;
use Override;

abstract class TestCase extends TestbenchTestCase
{
    #[Override]
    protected function setUp(): void
    {
        parent::setUp();

        Http::preventStrayRequests();
    }

    protected function getPackageProviders($app): array
    {
        return [
            FaqServiceProvider::class,
        ];
    }
}
