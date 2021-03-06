<?php

namespace Tests\Feature\API;

use App\Models\Bookkeeping;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Arr;
use Tests\TestCase;

class PUT_BookkeepingTest extends TestCase
{
    use RefreshDatabase;

    const URL = 'api/Bookkeeping';

    /**
     * @test
     */
    public function updateBookkeeping_success_204()
    {
        //Arrange
        $original_data = Bookkeeping::factory()->create();
        $arrange_data = [
            'title' => 'new_title',
            'type' => 'decrease',
            'amount' => 12345
        ];

        //Actual
        $response = $this->put(self::URL . '/' . $original_data->id, $arrange_data);

        //Assert
        $response->assertStatus(204);
        $this->assertDatabaseHas('Bookkeeping', $arrange_data);
        $this->assertDatabaseMissing('Bookkeeping', $original_data->toArray());
    }

    /**
     * @test
     */
    public function updateBookkeeping_title_empty_422()
    {
        //Arrange
        $original_data = Bookkeeping::factory()->create();
        $arrange_data = [
            'type' => 'decrease',
            'amount' => 12345
        ];

        //Actual
        $response = $this->put(self::URL . '/' . $original_data->id, $arrange_data);

        //Assert
        $response->assertStatus(422);
        $response->assertJson(
            [
                'status' => 'fail',
                'message' => 'input invalid'
            ]
        );
        $this->assertDatabaseMissing('Bookkeeping', $arrange_data);
        $this->assertDatabaseHas('Bookkeeping', Arr::except($original_data->toArray(), ['updated_at', 'created_at']));
    }

    /**
     * @test
     */
    public function updateBookkeeping_type_empty_422()
    {
        //Arrange
        $original_data = Bookkeeping::factory()->create();
        $arrange_data = [
            'title' => 'new_title',
            'amount' => 12345
        ];

        //Actual
        $response = $this->put(self::URL . '/' . $original_data->id, $arrange_data);

        //Assert
        $response->assertStatus(422);
        $response->assertJson(
            [
                'status' => 'fail',
                'message' => 'input invalid'
            ]
        );
        $this->assertDatabaseMissing('Bookkeeping', $arrange_data);
        $this->assertDatabaseHas('Bookkeeping', Arr::except($original_data->toArray(), ['updated_at', 'created_at']));
    }

    /**
     * @test
     */
    public function updateBookkeeping_type_not_increase_or_drease_422()
    {
        //Arrange
        $original_data = Bookkeeping::factory()->create();
        $arrange_data = [
            'title' => 'new_title',
            'type' => 'not_increase_or_decrease',
            'amount' => 12345
        ];

        //Actual
        $response = $this->put(self::URL . '/' . $original_data->id, $arrange_data);

        //Assert
        $response->assertStatus(422);
        $response->assertJson(
            [
                'status' => 'fail',
                'message' => 'input invalid'
            ]
        );
        $this->assertDatabaseMissing('Bookkeeping', $arrange_data);
        $this->assertDatabaseHas('Bookkeeping', Arr::except($original_data->toArray(), ['updated_at', 'created_at']));
    }

    /**
     * @test
     */
    public function updateBookkeeping_amount_empty_422()
    {
        //Arrange
        $original_data = Bookkeeping::factory()->create();
        $arrange_data = [
            'title' => 'new_title',
            'type' => 'increase',
        ];

        //Actual
        $response = $this->put(self::URL . '/' . $original_data->id, $arrange_data);

        //Assert
        $response->assertStatus(422);
        $response->assertJson(
            [
                'status' => 'fail',
                'message' => 'input invalid'
            ]
        );
        $this->assertDatabaseMissing('Bookkeeping', $arrange_data);
        $this->assertDatabaseHas('Bookkeeping', Arr::except($original_data->toArray(), ['updated_at', 'created_at']));
    }

    /**
     * @test
     */
    public function updateBookkeeping_amount_string_422()
    {
        //Arrange
        $original_data = Bookkeeping::factory()->create();
        $arrange_data = [
            'title' => 'new_title',
            'type' => 'increase',
            'amount' => 'string'
        ];

        //Actual
        $response = $this->put(self::URL . '/' . $original_data->id, $arrange_data);

        //Assert
        $response->assertStatus(422);
        $response->assertJson(
            [
                'status' => 'fail',
                'message' => 'input invalid'
            ]
        );
        $this->assertDatabaseMissing('Bookkeeping', $arrange_data);
        $this->assertDatabaseHas('Bookkeeping', Arr::except($original_data->toArray(), ['updated_at', 'created_at']));
    }

    /**
     * @test
     */
    public function updateBookkeeping_id_empty_422()
    {
        //Arrange
        $original_data = Bookkeeping::factory()->create();
        $arrange_data = [
            'title' => 'new_title',
            'type' => 'increase',
            'amount' => 123456
        ];

        //Actual
        $response = $this->put(self::URL, $arrange_data);

        //Assert
        $response->assertStatus(405);
        $this->assertDatabaseMissing('Bookkeeping', $arrange_data);
        $this->assertDatabaseHas('Bookkeeping', Arr::except($original_data->toArray(), ['updated_at', 'created_at']));
    }

    /**
     * @test
     */
    public function updateBookkeeping_id_string_422()
    {
        //Arrange
        $original_data = Bookkeeping::factory()->create();
        $arrange_data = [
            'title' => 'new_title',
            'type' => 'increase',
            'amount' => 123456
        ];

        //Actual
        $response = $this->put(self::URL . '/string', $arrange_data);

        //Assert
        $response->assertStatus(422);
        $response->assertJson(
            [
                'status' => 'fail',
                'message' => 'input invalid'
            ]
        );
        $this->assertDatabaseMissing('Bookkeeping', $arrange_data);
        $this->assertDatabaseHas('Bookkeeping', Arr::except($original_data->toArray(), ['updated_at', 'created_at']));
    }


    /**
     * @test
     */
    public function updateBookkeeping_id_resource_not_exist_404()
    {
        //Arrange
        $original_data = Bookkeeping::factory()->create();
        $not_exist_id = $original_data->id + 99999;
        $arrange_data = [
            'title' => 'new_title',
            'type' => 'decrease',
            'amount' => 12345
        ];

        //Actual
        $response = $this->put(self::URL . '/' . $not_exist_id, $arrange_data);

        //Assert
        $response->assertStatus(404);
        $response->assertJson(
            [
                'status' => 'fail',
                'message' => 'resource not found'
            ]
        );
        $this->assertDatabaseMissing('Bookkeeping', $arrange_data);
        $this->assertDatabaseHas('Bookkeeping', Arr::except($original_data->toArray(), ['updated_at', 'created_at']));
    }
}
