<?php

namespace App\Console\Commands;

use App\Jobs\ImportQuraanJob;
use Illuminate\Console\Command;
use Illuminate\Console\ConfirmableTrait;
use Symfony\Component\DomCrawler\Crawler;

class ImportQuraanCommand extends Command
{
    use ConfirmableTrait;
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quraan:import';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is used to import the quraan';
    /**
     * @var Crawler
     */
    private $crawler;
    
    /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Import Quraan text from files
     *
     * @return mixed
     */
    public function handle()
    {
        if ( ! $this->confirmToProceed()) {
            return;
        }
        
        $this->info('Importing ...');
        dispatch(new ImportQuraanJob());
        $this->info('Done importing!!');
    }
    
}
