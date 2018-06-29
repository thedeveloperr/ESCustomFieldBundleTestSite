<?php
/**
 * Created by PhpStorm.
 * User: Jaskaran Singh
 * Date: 29-06-2018
 * Time: 18:49
 */

namespace App\Controller;

use Sbcamp\Bundle\CustomFieldsBundle\CustomField;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class CustomFieldController extends Controller
{
    /**
     * @Route("/customField/{ownerId}/new",name="es_new_route")
     * @Method({"GET", "POST"})
     */
    public function newESField(Request $request, string $ownerId){
        $customeField = new CustomField('','','','');

        $form = $this->createFormBuilder($customeField)
            ->add('name',TextType::class, array('attr'=> array('class' => 'form-control')))
            ->add('machineName',TextType::class, array('attr'=> array('class' => 'form-control')))
            ->add('type',TextType::class, array('attr'=> array('class' => 'form-control')))
            ->add('Add', SubmitType::class, array('attr'=> array('class' => 'form-control brn btn-primary')))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $service = $this->container->get("sbcamp.bundle.custom_profile_fields_manager");

            $newField = $form->getData();
            $newField->setOwnerId($ownerId);
            $service->addCustomField($newField);
            return $this->redirectToRoute('get_ESFields_route',array('ownerId' => $ownerId));
        }

        return $this->render('ESField/new.html.twig',
            array('form' => $form->createView()));
    }

    /**
     * @Route("/customField/{ownerId}",name="get_ESFields_route")
     */
    public function getCustomFields($ownerId){
        $service = $this->container->get("sbcamp.bundle.custom_profile_fields_manager");
        $result = $service->getCustomFields($ownerId);
        return $this->render('ESField/getAllFields.html.twig', array('result' => $result, 'ownerId'=> $ownerId));

    }

    /**
     * @Route("/customField/{ownerId}/{machineFieldName}/edit",name="edit_ESFields_route")
     */
    public function editCustomFields(string $ownerId,string $machineFieldName){
        $service = $this->container->get("sbcamp.bundle.custom_profile_fields_manager");

        $customField = $service->fetchESFieldName($ownerId,$machineFieldName);

        print_r($customField);
        return new Response('');
        //return $this->render('ESField/getAllFields.html.twig', array('result' => $result, 'ownerId'=> $ownerId));
    }
}