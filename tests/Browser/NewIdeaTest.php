<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class NewIdeaTest extends DuskTestCase {


    public function testLogin() {
        $this->browse(function (Browser $first, $second) {
            $first->visit('/login')
                  ->assertSee('What is your name?')
                  ->type('username', 'Dusk')
                  ->click('button.login-btn')
                  ->waitForLocation('/')
                  ->assertSee('What do you want to do');
        });
    }


    public function testViewNewIdeaPage() {
        
        $loginFirst = $this->testLogin();
        
        $this->browse(function (Browser $browser) use ($loginFirst) {
            $browser->visit('/new-idea')
                    ->assertSee('New Idea');
        });
    }

    public function testSubmitBlankIdea() {

        $loginFirst = $this->testLogin();

        $this->browse(function (Browser $first, $second) use ($loginFirst) {
            $first->visit('/new-idea')
                  ->assertSee('New Idea')
                  ->click('#submit')
                  ->assertSee('No idea submitted');
        });
    }

    public function testSubmitValidIdea() {

        $loginFirst = $this->testLogin();

        $this->browse(function (Browser $browser) use ($loginFirst) {
            $browser->visit('/new-idea')
                    ->assertSee('New Idea')
                    ->type('idea', 'Test idea')
                    ->click('#submit')
                    ->waitForText('Your idea')
                    ->assertSee('Your idea has been submitted.(Test idea)');
        });
    }
}
