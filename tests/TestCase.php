<?php

abstract class TestCase extends Illuminate\Foundation\Testing\TestCase
{

    public function setUp()
    {
        $directory = __DIR__ .'/dump/';

        if(file_exists($directory) ) {
            exec('rm -rf ' . $directory);
        }

        exec('mkdir ' . $directory);
        exec('touch ' . $directory .'database.sql');


        parent::setUp();
    }

    public function tearDown()
    {
        exec('rm -rf ' . __DIR__ .'/dump/');
        parent::tearDown();
    }

    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }
}
