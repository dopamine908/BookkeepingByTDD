<?php

namespace Tests\Feature\API;

use App\Models\Bookkeeping;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PUT_BookkeepingTest extends TestCase
{
    use RefreshDatabase;

    const URL = 'api/Bookkeeping';

    /**
     * @test
     */
    public function updateBookkeeping_success_201()
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
        $response->assertStatus(201);
        $response->assertJson(
            [
                'status' => 'success'
            ]
        );
        $this->assertDatabaseHas('Bookkeeping', $arrange_data);
        $this->assertDatabaseMissing('Bookkeeping', $original_data->toArray());
    }
}
