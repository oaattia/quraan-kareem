<?php

namespace App\Console\Commands\Elastic;

use Illuminate\Console\Command;
use Illuminate\Console\ConfirmableTrait;

class CreateIndexDocumentCommand extends Command
{

    use ConfirmableTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'elastic:create.index {index} {mappings?} {analysis?} {--shards=5} {--replicas=1}';

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

        $body['settings'] = [
            'number_of_shards'   => $this->option('shards'),
            'number_of_replicas' => $this->option('replicas'),
        ];

        if ( ! empty($this->argument('analysis'))) {
            $body = array_add($body['settings'], 'analysis', $this->argument('analysis'));
        }

        if ( ! empty($this->argument('mappings'))) {
            $body = array_add($body, 'mappings', $this->argument('mappings'));
        }

        $parameters = [
            'index' => $this->argument('index'),
            'body'  => $body,
        ];

        $created = client()->indices()->create($parameters);

        if (! $created['acknowledged']) {
            $this->error('Index ' . $this->argument('index') . ' not created');
        }

        $this->info('Index ' . $this->argument('index') . ' created successfully!!');
    }
}
