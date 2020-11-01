<?php

namespace Tests\Feature\API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class POST_BookkeepingTest extends TestCase
{
    use RefreshDatabase;

    const URL = 'api/Bookkeeping';

    /**
     * @test
     */
    public function createBookkeeping_Increase_Success_200()
    {//Arrange
        $arrange_data = [
            'title' => 'test123',
            'type' => 'increase',
            'amount' => 1000,
        ];

        //Actual
        $response = $this->post(self::URL, $arrange_data);

        //Assert
        $response->assertStatus(201);
        $response->assertJson(
            [
                'status' => 'success'
            ]
        );
        $this->assertDatabaseHas('Bookkeeping', $arrange_data);
    }
}
