<?php
/**
 * Created by PhpStorm.
 * User: Jaskaran Singh
 * Date: 29-06-2018
 * Time: 18:57
 */

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProfileInfoController extends Controller
{
    /**
     * @Route("profileInfo/{ownerId}/new", name="add_new_lead")
     * @Method({"GET", "POST"})
     */

    public function addNewLead(Request $request,string $ownerId) {
        $service = $this->container->get("sbcamp.bundle.custom_profile_fields_manager");
        $result = $service->getCustomFields($ownerId);

        $form = $this->createFormBuilder();

        foreach($result as $field){
            $type = $field->getType();

            if($type == "keyword") {
                $form->add($field->getMachineName(), TextType::class ,array('attr'=> array('class' => 'form-control')));
            }
            if($type == "date") {
                $form->add($field->getMachineName(), DateType::class ,array('attr'=> array('class' => 'form-control')));
            }
            if($type == "boolean") {
                $form->add($field->getMachineName(), CheckboxType::class ,array('attr'=> array('class' => 'form-control')));
            }
            if($type == "integer") {
                $form->add($field->getMachineName(), IntegerType::class ,array('attr'=> array('class' => 'form-control')));
            }
        }
        $form = $form->add('Add', SubmitType::class ,array('attr'=> array('class' => 'form-control btn btn-primary')))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ) {
            print_r($form->getData());
            return new Response("");
        }
        return $this->render('ESField/new.html.twig',
            array('form' => $form->createView())
        );
    }
}