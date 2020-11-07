<?php

namespace Tests\Feature\API;

use App\Models\Bookkeeping;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GET_BookkeepingTest extends TestCase
{
    use RefreshDatabase;

    const URL = 'api/Bookkeeping';

    /**
     * @test
     */
    public function getBookkeeping_one_result_200()
    {
        //Arrange
        $original_data = Bookkeeping::factory()->count(10)->state(
            new Sequence(
                ['type' => 'increase'],
                ['type' => 'decrease'],
            )
        )->create();
        $search_target = $original_data->first();

        //Actual
        $response = $this->get(self::URL . '?title=' . $search_target->title);

        //Assert
        $response->assertStatus(200);
        $response->assertJson(
            [
                'status' => 'success',
                'data' => [
                    $search_target->toArray()
                ]
            ]
        );
    }
}
