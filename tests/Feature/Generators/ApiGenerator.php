<?php
namespace Tests\Feature\Generators;

use App\Services\Exchange1C\API;

abstract class ApiGenerator
{
    protected function mockApiFunction($functionName, array $willReturnData)
    {
        $mock = \Mockery::mock(API::class);
        $mock->shouldReceive($functionName)
            ->withAnyArgs()
            ->andReturn($willReturnData);

        app()->instance(API::class, $mock);
    }
}
