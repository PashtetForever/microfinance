<?php
namespace Tests\Feature\Generators\API;

use App\Services\Exchange1C\API;
use Tests\Feature\Generators\ApiGenerator;
use GuzzleHttp\Psr7\Response;

class CreateLoanGenerator extends ApiGenerator
{
    public function mockSuccessResponseOnCreateLoan($guid, $num)
    {
        $this->mockApiFunction('requestCreateLoan', [
            'status' => 'ok',
            'GUID' => $guid,
            'Num' => $num,
        ]);

        /*$this->mockApiFunction('getFileList', [
            ['Description' => 'file-name', 'FileName' => 'path-to-file'],
            ['Description' => 'file-name2', 'FileName' => 'path-to-file2'],
            ['Description' => 'file-name3', 'FileName' => 'path-to-file3'],
        ]);*/
    }
    public static function mockBadResponseOnCreateLoan()
    {
        $mock = \Mockery::mock(API::class);
        $mock->shouldReceive('requestCreateLoan')
            ->andReturn(new Response(500, ['Content-Type' => 'application/json'], json_encode([
                'status' => 'error',
                'message' => 'Произошла ошибка'
            ])));

        app()->instance(API::class, $mock);
    }
}
