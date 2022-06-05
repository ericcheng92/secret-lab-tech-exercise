<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Carbon\Carbon;

class VersionControlTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed');
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_post_a_version_control()
    {
        $response = $this->postJson('/api/version_control/add', ['mykey' => 'value5']);
 
        $response
            ->assertStatus(200);
    }

    public function test_get_a_version_control_by_key_with_correct_key()
    {
        $response = $this->getJson('/api/version_control/mykey');
 
        $response
            ->assertStatus(200);
    }

    public function test_get_a_version_control_by_key_with_wrong_key()
    {

        $response = $this->getJson('/api/version_control/mykey2');
 
        $response
            ->assertStatus(422);
    }

    public function test_get_a_version_control_by_key_with_correct_key_and_correct_timestamp()
    {
        $current_timestamp = Carbon::now()->timestamp;
        $response = $this->getJson('/api/version_control/mykey?timestamp='.$current_timestamp);
 
        $response
            ->assertStatus(200);
    }

    public function test_get_a_version_control_by_key_with_correct_key_and_invalid_timestamp()
    {
        $invalid_timestamp = 123123;
        $response = $this->getJson('/api/version_control/mykey?timestamp='.$invalid_timestamp);
 
        $response
            ->assertStatus(422);
    }

    public function test_list_all_version_control()
    {
        $response = $this->getJson('/api/version_control');
 
        $response
            ->assertStatus(200);
    }
}
