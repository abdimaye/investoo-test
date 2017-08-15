<?php

namespace Tests\Feature;

use Tests\TestCase;
// use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
// use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostCsvStringTest extends TestCase
{
	use DatabaseMigrations;
 
 	/** @test */
    public function a_user_can_successfully_submit_a_csv_string()
    {
    	$response = $this->post('api', ['csv' => '1,2,3,d,4,5,5']);

        $response->assertStatus(201);
    }

    /** @test */
    public function a_user_cannot_submit_an_csv_invalid_string()
    {
    	$response = $this->post('api', ['csv' => ',,3,4']);

    	$response->assertSee('csv field missing or invalid');
    }
}
