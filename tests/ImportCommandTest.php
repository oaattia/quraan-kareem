<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ImportCommandTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /** @test */
    public function it_should_import_data_successfully()
    {
        Artisan::call('quraan:import');

        $this->seeInDatabase('soraahs', [
            'id' => '114'
        ]);
        $this->seeInDatabase('ayaats', [
            'soraah_id' => '114'
        ]);
    }
}
