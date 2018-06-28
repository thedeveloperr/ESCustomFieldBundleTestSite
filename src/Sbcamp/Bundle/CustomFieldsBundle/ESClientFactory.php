<?php

namespace Sbcamp\Bundle\CustomFieldsBundle;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;

abstract class ESClientFactory {

  /**
   * @var Client
   */
  private $client;

  public function __construct(Client $client) {

  }

  public static function create(){
    $clientBuilder = ClientBuilder::create();
    return $clientBuilder->build();
  }

}