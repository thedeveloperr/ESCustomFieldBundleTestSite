<?php

namespace Sbcamp\Bundle\CustomFieldsBundle;

use Elasticsearch\Client;

class ESIndexManager implements ESIndexManagerInterface {

  /**
   * @var Client
   */
  private $client;

  /**
   * @var string
   */
  private $index;

  public function __construct(Client $client, string $index, string $type) {
    $this->client = $client;
    $this->index = $index;
    $this->type = $type;
  }

  public function setIndex(string $indexName) {
    $this->index = $indexName;
    return $this;
  }

  public function getIndex(): string {
    return $this->index;
  }

  public function setType(string $type) {
    $this->type = $type;
    return $this;
  }

  public function getType(): string {
    return $this->type;
  }

  public function addNewMappingFields(array $fields) {
    $params = [
      'index' => $this->index,
      'type'  => $this->type,
      'body'  => [
        $this->type => [
          'properties' => $fields,
        ],
      ],
    ];
    $this->client->indices()->putMapping($params);
  }

  public function addSettings(array $settings) {
    // TODO: Implement addSettings() method.
  }

  public function getMappings(): array {
    $params = [
      'index' => $this->index,
      'type'  => $this->type,
    ];
    return $this->client->indices()->getMapping($params);
  }

}