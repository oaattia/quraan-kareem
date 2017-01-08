<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ImportCommandTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    public function testIfWeImportedDataSuccessfully()
    {
        Artisan::call('quraan:import');

        $this->seeInDatabase('soraahs', [
            'id' => '114'
        ]);

        $this->seeInDatabase('ayaats', [
            'soraah_id' => '114'
        ]);

        // we should add more tests but later not now
    }
}
