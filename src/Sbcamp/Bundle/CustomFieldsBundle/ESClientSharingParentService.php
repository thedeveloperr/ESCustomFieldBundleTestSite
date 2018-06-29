<?php

namespace Sbcamp\Bundle\CustomFieldsBundle;

use Elasticsearch\Client;

abstract class ESClientSharingParentService {
    public function __construct(Client $c) {
    }
}