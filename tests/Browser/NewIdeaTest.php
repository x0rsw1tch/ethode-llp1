<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class NewIdeaTest extends DuskTestCase {


    public function testViewNewIdeaPage() {
        $this->browse(function (Browser $browser) {
            $browser->visit('/new-idea')
                    ->assertSee('New Idea');
        });
    }

    public function testSubmitBlankIdea() {
        $this->browse(function (Browser $first, $second) {
            $first->visit('/new-idea')
                  ->assertSee('New Idea');

            $second->visit('/new-idea')
                   ->assertSee('New Idea')
                   ->click('input[type=submit]')
                   ->assertSee('No idea submitted');
        });
    }

    public function testSubmitValidIdea() {
        $this->browse(function (Browser $browser) {
            $browser->visit('/new-idea')
                    ->assertSee('New Idea')
                    ->type('idea', 'Test idea')
                    ->click('input[type=submit]')
                    ->waitForText('Your idea')
                    ->assertSee('Your idea has been submitted.(Test idea)');
        });
    }
}
