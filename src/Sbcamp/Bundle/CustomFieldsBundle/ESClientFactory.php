<?php

namespace Sbcamp\Bundle\CustomFieldsBundle;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;

class ESClientFactory {

  /**
   * @return Client
   */
  public static function create(): Client {

    $clientBuilder = ClientBuilder::create();
    return $clientBuilder->setHosts(['127.0.0.1:9200'])->build();
    //return $clientBuilder->build();
  }

}