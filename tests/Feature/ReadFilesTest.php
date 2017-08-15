<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ReadFilesTest extends TestCase
{
	use DatabaseMigrations;

	public function setUp()
	{
		parent::setUp();

		$this->file = factory('App\File')->create();
	}

    /** @test */
    public function a_user_can_view_all_files()
    {
        $this->get('/api')->assertSee($this->file->filename);
    }

     /** @test */
    public function a_user_can_view_a_single_file()
    {
    	$this->get('/api/' . $this->file->id)
    		->assertSee($this->file->filename);
    }
}
