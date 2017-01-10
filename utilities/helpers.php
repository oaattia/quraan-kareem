<?php

use Elasticsearch\ClientBuilder;

if (! function_exists('client')) {

    /**
     * Elasticsearch Client
     *
     * @return \Elasticsearch\Client
     */
    function client()
    {
        return ClientBuilder::create()->setHosts([
            config('elasticsearch.host')
        ])->build();
    }
}
