<?php

namespace App\Controller;

use Elasticsearch\ClientBuilder;
use Sbcamp\Bundle\CustomFieldsBundle\CustomField;
use Sbcamp\Bundle\CustomFieldsBundle\CustomProfileFieldsManagerService;
use Sbcamp\Bundle\CustomFieldsBundle\ESProfileInfoIndexManager;
use Sbcamp\Bundle\CustomFieldsBundle\Field;
use Sbcamp\Bundle\CustomFieldsBundle\ProfileInfo;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;


class TestController extends Controller {

  /**
   * @Route("/test", name="test")
   */
  public function index() {
    //      $test = $this->container->get('sbcamp.bundle.custom_fields_records_repo');
    //      var_dump($test);
    //      /**
    //       * @var CustomProfileFieldsManagerService $service
    //       */
    $service = $this->container->get("sbcamp.bundle.custom_profile_fields_manager");

    $newField = new CustomField("1", "First Name", "first_name_342", "date");
    $service->addCustomField($newField);

    return $this->render('test/index.html.twig', [
      'controller_name' => 'TestController',
    ]);
  }

  /**
   * @Route("/add", name="add")
   */
  public function adddoc() {
    //      $test = $this->container->get('sbcamp.bundle.custom_fields_records_repo');
    //      var_dump($test);
          /**
           * @var CustomProfileFieldsManagerService $service
           */
    $service = $this->container->get("sbcamp.bundle.custom_profile_fields_manager");

    $newprofile = new ProfileInfo("1",'g8gSSmQBLcWFHkTXPAmB');
    $newFiel  = new Field("First Name", "first_name","Mohittt","keyword");
    //$newFiel2  = new Field("First Name 3", "first_name_3","Guptaaa","keyword");

    $newprofile->addField($newFiel);
    //$newprofile->addField($newFiel2);
    var_dump($service->reindexProfileInfo($newprofile));
    echo '\n\n\n';
    return new Response($service->reindexProfileInfo($newprofile));
  }

  /**
   * @Route("/get", name="add")
   */
  public function getDoc(){

    $encoders = array(new XmlEncoder(), new JsonEncoder());
    $normalizers = array(new ObjectNormalizer());
    /**
     * @var CustomProfileFieldsManagerService $service
     */
    $service = $this->container->get("sbcamp.bundle.custom_profile_fields_manager");


    $serializer = new Serializer($normalizers, $encoders);

    $json = $serializer->serialize($service->getProfileInfo("1","g8gSSmQBLcWFHkTXPAmB"),'json');
    return new Response($json);
  }

  /**
   * @Route("/getFields",name="getfields")
   */
  public function getfields(){
    $service = $this->container->get("sbcamp.bundle.custom_profile_fields_manager");


//    $encoders = array(new XmlEncoder(), new JsonEncoder());
//    $normalizers = array(new ObjectNormalizer());
//
//    $serializer = new Serializer($normalizers, $encoders);
//
//    $json = $serializer->serialize($service->getCustomFields("1"),'json');
      $response = $service->getCustomFields("1");
      print_r($response);


    return new Response('');
  }

  /**
   * @Route("/createIndex", name="index")
   */
  public function createIndex() {
    //      $test = $this->container->get('sbcamp.bundle.custom_fields_records_repo');
    //      var_dump($test);
    //      /**
    //       * @var CustomProfileFieldsManagerService $service
    //       */
//    $service = $this->container->get("sbcamp.bundle.custom_profile_fields_manager");
//    $newField = new CustomField("1", "First Name", "first_name_6", "boolean");
//    $service->addCustomField($newField);

    $client = $this->createConnection();

    $params = [
      'index' => 'profile_info_index',
      'body' => [
        'settings' => [
          'number_of_shards' => 3,
          'number_of_replicas' => 2
        ],
        'mappings' => [
          '_doc' => [
            'dynamic' => 'false',
            '_source' => [
              'enabled' => true
            ],
            'properties' => [

            ]
          ]
        ]
      ]
    ];

    $response = $client->indices()->create($params);

    return $this->render('test/index.html.twig', [
      'controller_name' => 'TestController'
    ]);
  }

  /**
   * @Route("/getMapping", name="mapping")
   */
  public function getMapp() {
    /**
     * @var ESProfileInfoIndexManager $var
     */
    $var = $this->container->get(
      'sbcamp.bundle.es_profine_info_index_manager');
    print_r($var->getMappings());
    return $this->render('test/index.html.twig', [
      'controller_name' => 'TestController'
    ]);
  }

  public function createConnection()
  {
      $host = ['127.0.0.1:9200'];

      $clientBuidler = ClientBuilder::create();
      $clientBuidler->setHosts($host);

      return $clientBuidler->build();
  }
}
