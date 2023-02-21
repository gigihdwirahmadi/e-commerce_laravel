<?php

namespace Tests;

use App\Http\Middleware\VerifyCsrfToken;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use SebastianBergmann\Type\VoidType;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    protected $user;
    public function setUp():void
    {
        parent::setUp();
        $this->withoutMiddleware(VerifyCsrfToken::class);
        $this->user = User::factory()->create();
      
    }
}