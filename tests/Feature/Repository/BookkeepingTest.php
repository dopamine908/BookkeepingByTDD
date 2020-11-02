<?php

namespace Tests\Feature\Repository;

use App\Repositories\Bookkeeping as BookkeepingRepo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookkeepingTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function createNewBookkeeping_Increase()
    {
        //Arrange
        $BookkeepingRepo = $this->app->make(BookkeepingRepo::class);
        $title = 'title123';
        $type = 'increase';
        $amount = 12345;

        //Actual
        $actual = $BookkeepingRepo->create($title, $type, $amount);

        //Assert
        $this->assertTrue($actual);
        $this->assertDatabaseHas(
            'Bookkeeping',
            [
                'title' => $title,
                'type' => $type,
                'amount' => $amount,
            ]
        );
    }
}
