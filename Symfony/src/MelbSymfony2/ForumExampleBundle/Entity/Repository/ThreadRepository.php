<?php
/*
 * 
 * User: camm
 */
 
namespace MelbSymfony2\ForumExampleBundle\Entity\Repository;

// Imports
use MelbSymfony2\ForumExampleBundle\Entity\Thread;

// Framework Imports
use Doctrine\ORM\EntityRepository;

/**
 *
 * @author camm
 */
class ThreadRepository extends EntityRepository
{
    public function findAll() {
        $em = $this->getEntityManager();
        $query = $em->createQuery('SELECT thread, COUNT(posts.id) AS postCount FROM MelbSymfony2\ForumExampleBundle\Entity\Thread AS thread LEFT JOIN thread.posts AS posts GROUP BY thread.id');
        $results = $query->getResult();

        $threads = array();
        foreach($results as $result) {
            $thread = current($result);
            $thread->setPostCount($result['postCount']);
            $threads[] = $thread;
        }

        return $threads;

    }
}
