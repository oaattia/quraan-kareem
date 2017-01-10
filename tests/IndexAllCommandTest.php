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
        $this->removeIndex('dump_table');
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
        $this->removeIndex('dump_table');
    }

    /** @test */
    public function it_should_index_with_the_right_types()
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

        $this->assertEquals(array_get($response, 'dump_table.mappings.dump_table.properties'), [
            "bool"       => ["type" => "integer"],
            "created_at" => ["type" => "date", "format" => "strict_date_optional_time||epoch_millis"],
            "id"         => ["type" => "integer"],
            "ip"         => ["type" => "string"],
            "name"       => ["type" => "string"],
            "number"     => ["type" => "integer"],
            "updated_at" => ["type" => "date", "format" => "strict_date_optional_time||epoch_millis"]
        ]);
    }

    private function removeIndex($indexName)
    {
        $params = ['index' => $indexName];

        if (! client()->indices()->exists($params)) {
            return false;
        }

        $response = client()->indices()->delete($params);

        return $response['acknowledged'];
    }
}

class DumpTableModel extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'dump_table';
    protected $guarded = [];
    protected $dates = [];
}
