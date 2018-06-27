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

  /**
   * @var string
   */
  private $type;

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

  /**
   * @param ESMappingFieldInterface[] $fields
   */
  public function addNewMappingFields(array $fields) {

    /**
     * Converting the fields into format understood by ElasticSearch API
     */
    $properties = [];
    foreach($fields as $item){
      $properties[$item->getFieldName()] = [
        'type' => $item->getDatatype()
      ];
    }

    $params = [
      'index' => $this->index,
      'type'  => $this->type,
      'body'  => [
        $this->type => [
          'properties' => $properties,
        ],
      ],
    ];
    return $this->client->indices()->putMapping($params);
  }

  /**
   * @param ESMappingFieldInterface $field
   *
   * @return mixed|void
   */
  public function addNewMappingField(ESMappingFieldInterface $field) {
    $params = [
      'index' => $this->index,
      'type'  => $this->type,
      'body'  => [
        $this->type => [
          'properties' => [
              $field->getFieldName() => [
                'type' => $field->getDatatype(),
              ]
          ],
        ],
      ],
    ];
    return $this->client->indices()->putMapping($params);
  }

  public function addSettings(array $settings) {
    // TODO: Implement addSettings() method.
  }

  public function getSettings():array {
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