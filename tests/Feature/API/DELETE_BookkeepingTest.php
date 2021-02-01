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
    public function deleteBookkeeping_success_204()
    {
        //Arrange
        $original_data = Bookkeeping::factory()->create();

        //Actual
        $response = $this->delete(self::URL . '/' . $original_data->id);

        $response->assertStatus(204);
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

    /**
     * @test
     */
    public function deleteBookkeeping_id_string_422()
    {
        //Arrange
        $original_data = Bookkeeping::factory()->create();

        //Actual
        $response = $this->delete(self::URL . '/string');

        //Assert
        $response->assertStatus(422);
        $response->assertJson(
            [
                'status' => 'fail',
                'message' => 'input invalid'
            ]
        );
        $this->assertDatabaseHas(
            'Bookkeeping',
            Arr::except($original_data->toArray(), ['updated_at', 'created_at'])
        );
    }

    /**
     * @test
     */
    public function deleteBookkeeping_id_resource_not_exist_404()
    {
        //Arrange
        $original_data = Bookkeeping::factory()->create();
        $not_exist_id = $original_data->id + 999999;

        //Actual
        $response = $this->delete(self::URL . '/' . $not_exist_id);

        //Assert
        $response->assertStatus(404);
        $response->assertJson(
            [
                'status' => 'fail',
                'message' => 'resource not found'
            ]
        );
        $this->assertDatabaseHas(
            'Bookkeeping',
            Arr::except($original_data->toArray(), ['updated_at', 'created_at'])
        );
    }
}
