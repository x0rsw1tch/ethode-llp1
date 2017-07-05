<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CorTests extends TestCase {
    /**
     * @return void
     */
    public function testStatusPage() {
        $response = $this->get('/status');
        $response->assertSee('HTTP/AJAX Tests');
        $response->assertStatus(200);
    }

    public function testDatabaseOps() {
    	$this->assertDatabaseHas('test_data', ['name' => 'Geoffrey Paul']);
    }
}
