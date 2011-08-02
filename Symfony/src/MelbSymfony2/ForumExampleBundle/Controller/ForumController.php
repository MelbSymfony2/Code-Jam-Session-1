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
     * @Route("/thread/{threadId}/post/{postId}")
     */
    public function postViewAction($threadId, $postId)
    {
        return array();
    }
}