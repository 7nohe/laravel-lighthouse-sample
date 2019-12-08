<?php

namespace Tests;

use Nuwave\Lighthouse\Testing\MakesGraphQLRequests; // 追加
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use MakesGraphQLRequests; // 追加
}
