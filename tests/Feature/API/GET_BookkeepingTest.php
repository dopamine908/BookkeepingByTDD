<?php

namespace Tests\Feature\API;

use App\Models\Bookkeeping;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
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

    /**
     * @test
     */
    public function getBookkeeping_many_result_200()
    {
        //Arrange
        $original_data = Bookkeeping::factory()->count(10)->state(
            new Sequence(
                ['type' => 'increase'],
                ['type' => 'decrease'],
            )
        )->create();
        $search_target = 'increase';
        $expected_data = $original_data->where('type', '=', $search_target);

        //Actual
        $response = $this->get(self::URL . '?type=' . $search_target);

        //Assert
        $response->assertStatus(200);
        $response->assertJson(
            [
                'status' => 'success',
                'data' =>
                    $expected_data->values()->toArray(),
            ]
        );
    }

    /**
     * @test
     */
    public function getBookkeeping_title_200()
    {
        //Arrange
        $original_data = Bookkeeping::factory()->count(10)->create();
        $search_keywords = Str::limit($original_data->first()->title, 10, '');
        $expected_data = $original_data->first();

        //Actual
        $response = $this->get(self::URL . '?title=' . $search_keywords);

        //Assert
        $response->assertStatus(200);
        $response->assertJson(
            [
                'status' => 'success',
                'data' => [$expected_data->toArray()]
            ]
        );
    }

    /**
     * @test
     */
    public function getBookkeeping_type_200()
    {
        //Arrange
        $original_data = Bookkeeping::factory()->count(10)->state(
            new Sequence(
                ['type' => 'increase'],
                ['type' => 'decrease'],
            )
        )->create();
        $search_target = 'decrease';
        $expected_data = $original_data->where('type', '=', $search_target);

        //Actual
        $response = $this->get(self::URL . '?type=' . $search_target);

        //Assert
        $response->assertStatus(200);
        $response->assertJson(
            [
                'status' => 'success',
                'data' =>
                    $expected_data->values()->toArray(),
            ]
        );
    }

    /**
     * @test
     */
    public function getBookkeeping_amount_200()
    {
        //Arrange
        $original_data = Bookkeeping::factory()->count(10)->state(
            new Sequence(
                ['amount' => 123],
                ['amount' => 456],
            )
        )->create();
        $search_target = 123;
        $expected_data = $original_data->where('amount', '=', $search_target);

        //Actual
        $response = $this->get(self::URL . '?amount=' . $search_target);

        //Assert
        $response->assertStatus(200);
        $response->assertJson(
            [
                'status' => 'success',
                'data' =>
                    $expected_data->values()->toArray(),
            ]
        );
    }

    /**
     * @test
     */
    public function getBookkeeping_many_condition_200()
    {
        //Arrange
        $original_data = Bookkeeping::factory()->count(4)->state(
            new Sequence(
                [
                    'title' => 'title1',
                    'type' => 'increase',
                    'amount' => 123
                ],
                [
                    'title' => 'title2',
                    'type' => 'increase',
                    'amount' => 456
                ],
                [
                    'title' => 'title3',
                    'type' => 'decrease',
                    'amount' => 123
                ],
                [
                    'title' => 'title4',
                    'type' => 'decrease',
                    'amount' => 456
                ]
            )
        )->create();
        $search_title = 'title';
        $search_type = 'decrease';
        $search_amount = 456;
        $expected_result = [
            'title' => 'title4',
            'type' => 'decrease',
            'amount' => 456
        ];

        //Actual
        $response = $this->get(
            self::URL . '?' . 'title=' . $search_title . '&type=' . $search_type . '&amount=' . $search_amount
        );

        //Assert
        $response->assertStatus(200);
        $response->assertJson(
            [
                'status' => 'success',
                'data' => [$expected_result]
            ]
        );
    }

    /**
     * @test
     */
    public function getBookkeeping_empty_result_200()
    {
        //Arrange
        $original_data = Bookkeeping::factory()->count(10)->state(
            new Sequence(
                ['amount' => 123],
                ['amount' => 456],
            )
        )->create();
        $search_target = $original_data->first()->title . '1';

        //Actual
        $response = $this->get(self::URL . '?title=' . $search_target);

        //Assert
        $response->assertStatus(200);
        $response->assertJson(
            [
                'status' => 'success',
                'data' => []
            ]
        );
    }

    /**
     * @test
     */
    public function getBookkeeping_type_type_not_increase_or_decrease_422()
    {
        //Arrange
        $search_target = 'not_increase_or_decrease';

        //Actual
        $response = $this->get(self::URL . '?type=' . $search_target);

        //Assert
        $response->assertStatus(422);
        $response->assertJson(
            [
                'status' => 'fail',
                'message' => 'input invalid'
            ]
        );
    }
}
