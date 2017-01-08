<?php

use Elasticsearch\ClientBuilder;

if (! function_exists('elastic')) {

    /**
     * Elasticsearch Client
     *
     * @return \Elasticsearch\Client
     */
    function elastic()
    {
        return ClientBuilder::create()->setHosts([
            config('elasticsearch.host')
        ])->build();
    }
}
