<?php

namespace Tests\Feature\API;

use App\Models\Bookkeeping;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Arr;
use Tests\TestCase;

class DELETE_BookkeepingTest extends TestCase
{
    use RefreshDatabase;

    const URL = 'api/Bookkeeping';

    /**
     * @test
     */
    public function deleteBookkeeping_success_201()
    {
        //Arrange
        $original_data = Bookkeeping::factory()->create();

        //Actual
        $response = $this->delete(self::URL . '/' . $original_data->id);

        //Assert
        $response->assertStatus(201);
        $response->assertJson(
            [
                'status' => 'success'
            ]
        );
        $this->assertDatabaseMissing(
            'Bookkeeping',
            Arr::except($original_data->toArray(), ['updated_at', 'created_at'])
        );
    }

    /**
     * @test
     */
    public function deleteBookkeeping_id_empty_405()
    {
        //Arrange
        $original_data = Bookkeeping::factory()->create();

        //Actual
        $response = $this->delete(self::URL);

        //Assert
        $response->assertStatus(405);
        $this->assertDatabaseHas(
            'Bookkeeping',
            Arr::except($original_data->toArray(), ['updated_at', 'created_at'])
        );
    }
}
