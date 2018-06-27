<?php

namespace Sbcamp\Bundle\CustomFieldsBundle\ESRepository;

use Elasticsearch\Client;
use ONGR\ElasticsearchDSL\Search;
use Sbcamp\Bundle\CustomFieldsBundle\ESDocument\ESDocumentInterface;
use Sbcamp\Bundle\CustomFieldsBundle\ESDocument\ProfileInfoDocument;

class AbstractDocumentRepository {

  private $index;

  private $type;

  private $client;

  /**
   * AbstractDocumentRepository constructor.
   *
   * @param Client $client
   * @param \ReflectionClass $eSDocumentReflectionClass Class to access static functions
   */
  public function __construct(Client $client,$eSDocumentReflectionClass) {
    $this->client = $client;
    $this->reflectionClass = $eSDocumentReflectionClass;
    $this->index = $eSDocumentReflectionClass->getStaticPropertyValue('index');
    if(is_null($this->index)){
      throw \Exception("An Index for the repositiory must set");
    }

    $this->type = $eSDocumentReflectionClass->getStaticPropertyValue('type');
    if(is_null($this->type)){
      throw \Exception("A type for the repositiory must set");
    }
  }

  public function index(ESDocumentInterface $doc){
    $params = [
      'index' => $this->index,
      'type' => $this->type,

    ];
    if(!is_null($doc->getId())){
      $params['id'] = $doc->getId();
    }
    $params['body'] = $doc->getFields();
    $repsonse =  $this->client->index($params);
    return $repsonse;

  }


  public function findById(string $id){
    $params = [
      'index' => $this->index,
      'type' => $this->type,
      'id' => $id
    ];
    $response = $this->client->get($params);

    /**
     * @var ESDocumentInterface $instanceToBefilled
     */
    $instanceToBefilled = $this->reflectionClass->newInstance();

    $instanceToBefilled->setFields($response['_source']);

    return $instanceToBefilled;

  }


}