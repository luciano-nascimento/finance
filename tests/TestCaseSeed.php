<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;

abstract class TestCaseSeed extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;
}