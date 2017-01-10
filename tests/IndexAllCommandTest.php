<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class IndexAllCommandTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->app['db']->connection()
                        ->getSchemaBuilder()
                        ->create('dump_table', function (Blueprint $table) {
                            $table->increments('id');
                            $table->string('name');
                            $table->integer('number');
                            $table->ipAddress('ip');
                            $table->boolean('bool');
                            $table->timestamps();
                        });
    }

    public function tearDown()
    {
        parent::tearDown();
        $this->removeIndex();
    }

    /** @test */
    public function it_should_index_withmedium_integer_right_types()
    {
        $this->app['db']->connection()->table('dump_table')->insert(
            [
                'name'       => 'any name',
                'number'     => 12,
                'ip'         => '192.12.23.32',
                'bool'       => false,
                'created_at' => '2017-01-08 15:39:36',
                'updated_at' => '2017-01-08 15:39:36',
            ]
        );

        Artisan::call('elastic:create.all_indexes', ['models' => [DumpTableModel::class]]);

        $response = client()->indices()->getMapping();

        $this->assertEquals($response['dump_table']['mappings']['dump_table']['properties'], [
            "bool"       => [
                "type" => "string",
            ],
            "created_at" => [
                "type"   => "date",
                "format" => "strict_date_optional_time||epoch_millis",
            ],
            "id"         => [
                "type" => "integer",
            ],
            "ip"         => [
                "type" => "string",
            ],
            "name"       => [
                "type" => "string",
            ],
            "number"     => [
                "type" => "string",
            ],
            "updated_at" => [
                "type"   => "date",
                "format" => "strict_date_optional_time||epoch_millis",
            ],
        ]);
    }

    public function removeIndex()
    {
        $params   = ['index' => 'dump_table'];
        $response = client()->indices()->delete($params);

        return $response['acknowledged'];
    }
}

class DumpTableModel extends \Illuminate\Database\Eloquent\Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'dump_table';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];

}