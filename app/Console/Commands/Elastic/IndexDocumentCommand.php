<?php

namespace App\Console\Commands\Elastic;

use Illuminate\Console\Command;
use Illuminate\Console\ConfirmableTrait;

class IndexDocumentCommand extends Command
{

    use ConfirmableTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'elasticsearch:index {index} {type} {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Index document elasticsearch';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // check before going to production
        if ( ! $this->confirmToProceed()) {
            return;
        }

        $params = [
            'index' => $this->argument('index'),
            'type'  => $this->argument('type'),
            'id'    => $this->argument('id'),
            'body'  => ['testField' => 'abc']
        ];
        
        return elastic()->index($params);
    }
}
