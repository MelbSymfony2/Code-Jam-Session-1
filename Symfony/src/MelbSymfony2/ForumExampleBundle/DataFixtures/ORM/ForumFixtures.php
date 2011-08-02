<?php

namespace MelbSymfony2\ForumExampleBundle\DataFixtures\ORM;

use MelbSymfony2\ForumExampleBundle\Entity;
use Doctrine\Common\DataFixtures\FixtureInterface;

class ForumFixtures implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param object $manager
     */
    public function load($manager)
    {
        // TODO: Implement load() method.
        for($userIndex = 0; $userIndex < 5; ++$userIndex)
        {
            $user = new Entity\User();
            $user->setName('user: ' . $userIndex);
            $user->setPassword('jarrodhardcoded-salt');
            $user->setEmailAddress('jarrod@flintinteractive.com.au');

            for($index = 0; $index < 20; ++$index)
            {
                $thread = new Entity\Thread();
                $thread->setTitle('thread: ' . $userIndex . ' - ' . $index);
                $thread->setBody('body: ' . $userIndex . ' - ' . $index);
                $thread->setUser($user);

                for($postIndex = 0; $postIndex < 50; ++$postIndex)
                {
                    $post = new Entity\Post();
                    $post->setThread($thread);
                    $post->setTitle('title: ' . $userIndex . ' - ' . $index . ' - ' . $postIndex);
                    $post->setBody('body: ' . $userIndex . ' - ' . $index . ' - ' . $postIndex);
                    $manager->persist($post);
                    $post->setUser($user);
                }

                $manager->persist($thread);
            }
            $manager->persist($user);
        }
        $manager->flush();
    }
}