<?php

namespace Sbcamp\Bundle\CustomFieldsBundle\ESRepository;

use Elasticsearch\Client;
use Sbcamp\Bundle\CustomFieldsBundle\ESDocument\ProfileInfoDocument;

class ProfileInfoDocumentRepository extends AbstractDocumentRepository {

  public function __construct(Client $client) {
    parent::__construct($client, new \ReflectionClass(ProfileInfoDocument::class));
  }
}