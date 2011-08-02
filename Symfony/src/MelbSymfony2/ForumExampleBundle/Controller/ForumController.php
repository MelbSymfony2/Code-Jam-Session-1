<?php

namespace MelbSymfony2\ForumExampleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MelbSymfony2\ForumExampleBundle\Entity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;

class ForumController extends Controller
{
    /**
     * Returns with the service container Doctrine ORM
     * @return Doctrine\ORM\EntityManager
     */
    protected function getEntityManager()
    {
        return $this->get('doctrine.orm.default_entity_manager');
    }
    /**
     * @Route("/", name="forum_default")
     * @Template
     */
    public function indexAction()
    {
        // Load threads

        $entityManager = $this->getEntityManager();
        $threads = $entityManager->getRepository('MelbSymfony2ForumExampleBundle:Thread')->findAll();
        //print_r($threads[0]); exit;

        return array('threads' => $threads);
    }

    /**
     * @Route("/thread/{id}", name="thread_view")
     * @Template("MelbSymfony2ForumExampleBundle:Forum:thread-view.html.twig")
     */
    public function threadViewAction(Entity\Thread $thread)
    {
        return array('thread' => $thread);
    }

    /**
     * @Route("/thread-create", name="thread_create")
     * @Template("MelbSymfony2ForumExampleBundle:Forum:thread-edit.html.twig")
     */
    public function threadCreateAction() {
        return $this->threadEdit();
    }

    /**
     * @Route("/thread/{id}/edit", name="thread_edit")
     * @Template("MelbSymfony2ForumExampleBundle:Forum:thread-edit.html.twig")
     */
    public function threadEditAction(Entity\Thread $thread = null)
    {
        return $this->threadEdit($thread);
    }

    private function threadEdit(Entity\Thread $thread = null)
    {
        if(empty($thread)) $thread = new Entity\Thread();
        $form = $this->createFormBuilder($thread)
                ->add('title', 'text')
                ->add('body', 'textarea')
                ->getForm();

        $request = $this->get('request');
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                // perform some action, such as save the object to the database

                $entityManager = $this->getEntityManager();
                $entityManager->persist($thread);
                $entityManager->flush();

                return $this->redirect($this->generateUrl('forum_default'));
            }
        }

        return array('form' => $form->createView());
    }

}