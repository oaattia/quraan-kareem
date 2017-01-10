<?php

namespace App\Console\Commands;

use App\Ayaat;
use App\Soraah;
use Illuminate\Console\Command;

class CreateIndexesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'elasticsearch:create.all_indexes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create all the indexes of the application';

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
        $modelsList = [
            new Soraah(),
            new Ayaat(),
        ];

        foreach ($modelsList as $model) {

            $columns = array_keys($columnsArray = $model->all()->first()->toArray());
            $arguments['index'] = $model->getTable();

            foreach (array_values($columnsArray) as $key => $column) {
                $types[$columns[$key]]['type'] = $this->fetchRightType($columns[$key]);
            }

            $arguments['mappings'] = [
                $arguments['index'] => [
                    '_all' => [
                        'enabled' => false
                    ],
                ],
            ];

            if(isset($types)) {
                $arguments['mappings'][$model->getTable()] = array_add($arguments['mappings'][$model->getTable()], 'properties', $types);
            }

            $this->call('elastic:create.index', $arguments);

        }

    }

    /**
     * We change the type of specific columns name
     *
     * @param string $column
     *
     * @return string $type
     */
    private function fetchRightType($column)
    {
        switch ($column) {
            case 'created_at':
            case 'updated_at':
                $type = 'date';
                break;
            default:
                $type = gettype($column);
                break;
        }

        return $type;
    }
}
