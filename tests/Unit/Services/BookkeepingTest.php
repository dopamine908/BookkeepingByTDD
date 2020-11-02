<?php

namespace Tests\Unit\Services;

use App\Repositories\Bookkeeping as BookkeepingRepo;
use App\Services\Bookkeeping as BookkeepingService;
use Tests\TestCase;

class BookkeepingTest extends TestCase
{
    /**
     * @test
     */
    public function createBookkeeping_increase(){
        //Arrange
        $mock_bookkeeping_repo=\Mockery::mock(BookkeepingRepo::class);
        $mock_bookkeeping_repo->shouldReceive('create')->once()->andReturn(true);
        $this->app->instance(BookkeepingRepo::class,$mock_bookkeeping_repo);
        $BookkeepingService=$this->app->make(BookkeepingService::class);
        $title = 'test_title';
        $type = 'increase';
        $amount = 1234;

        //Actual
        $actual = $BookkeepingService->create($title, $type, $amount);

        //Assert
        $this->assertTrue($actual);
    }
}
