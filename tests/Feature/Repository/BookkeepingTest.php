<?php

namespace Tests\Feature\Repository;

use App\Exceptions\BookkeepingResourceNotFoundException;
use App\Models\Bookkeeping as BookkeepingModel;
use App\Repositories\Bookkeeping;
use App\Repositories\Bookkeeping as BookkeepingRepo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Arr;
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

    /**
     * @test
     */
    public function updateBookkeeping_success()
    {
        //Arrange
        $original_data = BookkeepingModel::factory()->create();
        $BookkeepingRepo = $this->app->make(Bookkeeping::class);
        $title = 'new_title';
        $type = 'increase';
        $amount = 123456;

        //Actual
        $actual = $BookkeepingRepo->update($original_data->id, $title, $type, $amount);

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
        $this->assertDatabaseMissing('Bookkeeping', $original_data->toArray());
    }

    /**
     * @test
     */
    public function updateBookkeeping_fail()
    {
        //Arrange
        $original_data = BookkeepingModel::factory()->create();
        $BookkeepingRepo = $this->app->make(Bookkeeping::class);
        $not_exist_id = $original_data->id + 9999;
        $title = 'new_title';
        $type = 'increase';
        $amount = 123456;
        $this->expectException(BookkeepingResourceNotFoundException::class);

        //Actual
        $actual = $BookkeepingRepo->update($not_exist_id, $title, $type, $amount);

        //Assert
        $this->assertDatabaseMissing(
            'Bookkeeping',
            [
                'title' => $title,
                'type' => $type,
                'amount' => $amount,
            ]
        );
        $this->assertDatabaseHas('Bookkeeping', Arr::except($original_data->toArray(), ['updated_at', 'created_at']));
    }

    /**
     * @test
     */
    public function deleteBookkeeping_success()
    {
        //Arrange
        $original_data = BookkeepingModel::factory()->create();
        $BookkeepingRepo = $this->app->make(BookkeepingRepo::class);

        //Actual
        $actual = $BookkeepingRepo->delete($original_data->id);

        //Assert
        $this->assertTrue($actual);
        $this->assertDatabaseMissing(
            'Bookkeeping',
            Arr::except($original_data->toArray(), ['updated_at', 'created_at'])
        );
    }
}
