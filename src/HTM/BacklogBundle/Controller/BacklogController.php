<?php

namespace HTM\BacklogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use HTM\BacklogBundle\Entity\Backlog;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BacklogController extends Controller
{


     public function affichAction()
    {
    	
    	$em = $this->getDoctrine()->getManager();
    	$backlog=$em->getRepository('HTMBacklogBundle:Backlog')->findAll();

        return $this->render('HTMBacklogBundle:backlog:affich.html.twig',array('back'=>$backlog));
    }

     public function addAction(Request $request)
    {
        
        $b = new Backlog();
        $form=$this->createFormBuilder($b)
            ->add("id","integer")
          ->add("descriptionUS","textarea")
          ->add("priorite","integer")
          ->add("difficulte","integer")

          ->getForm();
          $form->handleRequest($request);
          if($form->isValid()){

            $em=$this->getDoctrine()->getManager();
            $em->persist($b);
            $em->flush();
              return new Response('Us added succesfully');
          }
        return $this->render('HTMBacklogBundle:backlog:add.html.twig', array(
            'f' => $form->createView(),
        ));
    }
    public function editAction($id, Request $request) {

        $em = $this->getDoctrine()->getManager();
        $backlog = $em->getRepository('HTMBacklogBundle:Backlog')->find($id);
        if (!$backlog) {
            throw $this->createNotFoundException(
                'No news found for id ' . $id
            );
        }

        $form = $this->createFormBuilder($backlog)
            ->add("id","integer")
            ->add("descriptionUS","textarea")
            ->add("priorite","integer")
            ->add("difficulte","integer")

            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->flush();
            return new Response('Us updated successfully');
        }

        return $this->render('HTMBacklogBundle:backlog:edit.html.twig', array(
            'f' => $form->createView(),
            ));
    }
    public function deleteAction($id, Request $request) {

        $em = $this->getDoctrine()->getManager();
        $backlog = $em->getRepository('HTMBacklogBundle:Backlog')->find($id);
        if (!$backlog) {
            throw $this->createNotFoundException(
                'No us found for id ' . $id
            );
        }

        $form = $this->createFormBuilder($backlog)

            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->remove($backlog);
            $em->flush();
            return new Response('us deleted successfully');

        }

        return $this->render('HTMBacklogBundle:backlog:delete.html.twig', array(
            'f' => $form->createView(),
        ));
    }

}

