<?php

namespace App\Console\Commands;

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
        $soraah = new Soraah();

        $columns = array_keys($columnsArray = $soraah->all()->first()->toArray());

        $arguments['index'] = $soraah->getTable();

        foreach (array_values($columnsArray) as $key => $column) {
            $types[$columns[$key]]['type'] = gettype($column);
        }

        $arguments['mappings'] = [
            $arguments['index'] => [
                '_all' => [
                    'enabled' => false
                ],
            ],
        ];

        if(isset($types)) {
            $arguments['mappings'][$soraah->getTable()] = array_add($arguments['mappings'][$soraah->getTable()], 'properties', $types);
        }



        // May be ..
        //        $arguments['analysis'] = [
//        'filter' => [
//            'shingle' => [
//                'type' => 'shingle'
//            ]
//        ],
//        'char_filter' => [
//            'pre_negs' => [
//                'type' => 'pattern_replace',
//                'pattern' => '(\\w+)\\s+((?i:never|no|nothing|nowhere|noone|none|not|havent|hasnt|hadnt|cant|couldnt|shouldnt|wont|wouldnt|dont|doesnt|didnt|isnt|arent|aint))\\b',
//                'replacement' => '~$1 $2'
//            ],
//        ],
//        'analyzer' => [
//            'reuters' => [
//                'type' => 'custom',
//                'tokenizer' => 'standard',
//                'filter' => ['lowercase', 'stop', 'kstem']
//            ]
//        ]
//    ];

        $this->call('elastic:create.index', $arguments);
    }
}
