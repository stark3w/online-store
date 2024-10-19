<?php

namespace Tests;

use App\Models\Catalog;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

abstract class BaseTestCase extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $catalog;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->catalog = Catalog::factory()->create();
    }
}
