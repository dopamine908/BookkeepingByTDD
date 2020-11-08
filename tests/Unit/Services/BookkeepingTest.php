<?php

namespace Tests\Unit\Services;

use App\Exceptions\BookkeepingResourceNotFoundException;
use App\Repositories\Bookkeeping;
use App\Repositories\Bookkeeping as BookkeepingRepo;
use App\Services\Bookkeeping as BookkeepingService;
use Mockery;
use Tests\TestCase;

class BookkeepingTest extends TestCase
{
    /**
     * @test
     */
    public function createBookkeeping_increase()
    {
        //Arrange
        $mock_bookkeeping_repo = Mockery::mock(BookkeepingRepo::class);
        $mock_bookkeeping_repo->shouldReceive('create')->once()->andReturn(true);
        $this->app->instance(BookkeepingRepo::class, $mock_bookkeeping_repo);
        $BookkeepingService = $this->app->make(BookkeepingService::class);
        $title = 'test_title';
        $type = 'increase';
        $amount = 1234;

        //Actual
        $actual = $BookkeepingService->create($title, $type, $amount);

        //Assert
        $this->assertTrue($actual);
    }

    /**
     * @test
     */
    public function updateBookkeeping_success()
    {
        //Arrange
        $mock_bookkeeping_repo = Mockery::mock(BookkeepingRepo::class);
        $mock_bookkeeping_repo->shouldReceive('update')->once()->andReturn(true);
        $this->app->instance(BookkeepingRepo::class, $mock_bookkeeping_repo);
        $BookkeepingService = $this->app->make(BookkeepingService::class);
        $id = 1;
        $title = 'new_title';
        $type = 'increase';
        $amount = 123456;

        //Actual
        $actual = $BookkeepingService->update($id, $title, $type, $amount);


        //Assert
        $this->assertTrue($actual);
    }

    /**
     * @test
     */
    public function updateBookkeeping_fail()
    {
        //Arrange
        $mock_bookkeeping_repo = Mockery::mock(BookkeepingRepo::class);
        $mock_bookkeeping_repo->shouldReceive('update')->once()->andReturn(new BookkeepingResourceNotFoundException());
        $this->app->instance(BookkeepingRepo::class, $mock_bookkeeping_repo);
        $BookkeepingService = $this->app->make(BookkeepingService::class);
        $id = 999999;
        $title = 'new_title';
        $type = 'increase';
        $amount = 123456;

        //Actual
        $actual = $BookkeepingService->update($id, $title, $type, $amount);
    }

    /**
     * @test
     */
    public function deleteBookkeeping_success()
    {
        //Arrange
        $mock_bookkeeping_repo = Mockery::mock(BookkeepingRepo::class);
        $mock_bookkeeping_repo->shouldReceive('delete')->once()->andReturn(true);
        $this->app->instance(BookkeepingRepo::class, $mock_bookkeeping_repo);
        $BookkeepingService = $this->app->make(BookkeepingService::class);
        $id = 1;

        //Actual
        $actual = $BookkeepingService->delete($id);

        //Assert
        $this->assertTrue($actual);
    }

    /**
     * @test
     */
    public function deleteBookkeeping_fail()
    {
        //Arrange
        $mock_bookkeeping_repo = Mockery::mock(BookkeepingRepo::class);
        $mock_bookkeeping_repo->shouldReceive('delete')->once()->andReturn(new BookkeepingResourceNotFoundException());
        $this->instance(BookkeepingRepo::class, $mock_bookkeeping_repo);
        $BookkeepingService = $this->app->make(BookkeepingService::class);

        //Actual
        $BookkeepingService->delete(1);
    }

    /**
     * @test
     */
    public function getBookkeeping()
    {
        //Arrange
        $mock_bookkeeping_repo = Mockery::mock(BookkeepingRepo::class);
        $mock_bookkeeping_repo->shouldReceive('get')->once();
        $this->instance(BookkeepingRepo::class, $mock_bookkeeping_repo);
        $BookkeepingService = $this->app->make(BookkeepingService::class);
        $arrange_title = 'test';
        $arrange_type = 'increase';
        $arrange_amount = 123;

        //Actual
        $BookkeepingService->get($arrange_title, $arrange_type, $arrange_amount);
    }
}
