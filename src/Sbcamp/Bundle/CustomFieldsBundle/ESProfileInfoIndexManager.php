<?php

namespace Sbcamp\Bundle\CustomFieldsBundle;

use Elasticsearch\Client;
use Sbcamp\Bundle\CustomFieldsBundle\ESDocument\ProfileInfoDocument;

class ESProfileInfoIndexManager extends ESIndexManager {

  /**
   * ESProfileInfoIndexManager constructor.
   *
   * @param Client $client
   *
   * @throws \ReflectionException
   */
  public function __construct(Client $client) {
    parent::__construct($client, ProfileInfoDocument::$index,  ProfileInfoDocument::$type);
  }
}