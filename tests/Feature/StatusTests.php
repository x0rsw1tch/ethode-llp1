<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StatusTests extends TestCase {
    
    public function testStatusPage() {
        $response = $this->get('/status');
        $response->assertSee('HTTP/AJAX Tests');
        $response->assertStatus(200);
    }

    public function testDatabaseOps() {
    	$this->assertDatabaseHas('test_data', ['name' => 'Geoffrey Paul']);
    }
}
