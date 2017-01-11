<?php

namespace App\Console\Commands\Elastic;

use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;


class CreateIndexesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'elastic:create.all_indexes {models*}';

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
        $modelsList = $this->argument('models');

        foreach ($modelsList as $modelName) {
            if ( ! $this->isClassExtendsEloquent($modelName)) {
                $this->error("{$modelName} class not extending Eloquent model, please check the model name");
                return;
            }

            $model = new $modelName();

            if (is_null($model->all()->first())) {
                $this->info("{$modelName} no data to contain for the model");
                return;
            }

            $columns            = array_keys($columnsArray = $model->all()->first()->toArray());
            $arguments['index'] = $model->getTable();

            foreach (array_values($columnsArray) as $key => $value) {
                $types[$columns[$key]]['type'] = $this->fetchRightType($columns[$key], $value);
            }

            $arguments['mappings'] = [
                $arguments['index'] => [
                    '_all' => [
                        'enabled' => false,
                    ],
                ],
            ];

            if (isset($types)) {
                $arguments['mappings'][$model->getTable()] = array_add($arguments['mappings'][$model->getTable()],
                    'properties', $types);
            }

            $this->call('elastic:create.index', $arguments);
        }
    }

    /**
     * change the type of specific column
     *
     * @param string $column
     * @param mixed $value
     *
     * @return string $type
     */
    protected function fetchRightType($column, $value)
    {
        if (is_bool($value)) {
            $value = (bool)$value;
        } elseif (is_numeric($value) && $column !== 'id') {
            $value = (int)$value;
        }

        switch ($column) {
            case 'created_at':
            case 'updated_at':
                $type = 'date';
                break;
            default:
                $type = gettype($value);
                break;
        }

        return $type;
    }

    /**
     * Check if the class passed extends Laravel Eloquent
     *
     * @param string $class
     *
     * @return bool
     */
    protected function isClassExtendsEloquent($class)
    {
        if ( ! is_subclass_of($class, Model::class)) {
            return false;
        }

        return true;
    }
}
