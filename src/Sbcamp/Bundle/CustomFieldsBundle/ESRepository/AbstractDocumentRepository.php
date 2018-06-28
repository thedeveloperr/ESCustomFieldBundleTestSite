<?php

namespace Sbcamp\Bundle\CustomFieldsBundle\ESRepository;

use Elasticsearch\Client;
use ONGR\ElasticsearchDSL\Search;
use Sbcamp\Bundle\CustomFieldsBundle\ESDocument\ESDocumentInterface;
use Sbcamp\Bundle\CustomFieldsBundle\ESDocument\ProfileInfoDocument;

class AbstractDocumentRepository {

  /**
   * @var string
   */
  private $index;

  /**
   * @var string
   */
  private $type;

  /**
   * @var Client
   */
  private $client;

  /**
   * @var \ReflectionClass
   */
  private $reflectionClass;

  /**
   * AbstractDocumentRepository constructor.
   *
   * @param Client $client
   * @param        $eSDocumentReflectionClass
   *
   * @throws \Exception
   */
  public function __construct(Client $client, \ReflectionClass $eSDocumentReflectionClass) {
    $this->client = $client;
    $this->reflectionClass = $eSDocumentReflectionClass;
    $this->index = $eSDocumentReflectionClass->getStaticPropertyValue('index');
    if(is_null($this->index)){
      throw new \Exception("An Index for the repositiory must set");
    }

    $this->type = $eSDocumentReflectionClass->getStaticPropertyValue('type');
    if(is_null($this->type)){
      throw new \Exception("A type for the repositiory must set");
    }
  }

  public function getIndex():string{
    return $this->index;
  }

  public function getType():string{
    return $this->type;
  }

  /**
   * @param ESDocumentInterface $doc
   *
   * @return string Elasticsearch Document automated generated id
   */
  public function index(ESDocumentInterface $doc):string{
    $params = [
      'index' => $this->index,
      'type' => $this->type,

    ];
    if(!is_null($doc->getESId())){
      $params['id'] = $doc->getESId();
    }
    $params['body'] = $doc->getESFields();
    $repsonse =  $this->client->index($params);
    return $repsonse['_id'];

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

    $instanceToBefilled->setESFields($response['_source']);
    $instanceToBefilled->setESId($response['_id']);

    return $instanceToBefilled;

  }


}