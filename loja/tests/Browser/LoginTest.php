<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {//metodo de navegar e fala para visitar a rota raiz
            $browser->visit('/')
                    ->assertSee('Olá Mundo');//afirma que enxerga isso
        });
    }
}
