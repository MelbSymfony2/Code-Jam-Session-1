<?php

namespace MelbSymfony2\ForumExampleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MelbSymfony2\ForumExampleBundle\Entity;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\FormError;
use Symfony\Component\Security\Core\Authentication;

class UserController extends Controller
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
     * @Route("/user/register")
     * @Template
     */
    public function registerAction()
    {
        if(empty($user))
        {
            $user = new Entity\User();
        }

        $form = $this->createFormBuilder($user)
                ->add('name', 'text')
                ->add('emailAddress', 'text')
                ->add('passwordNew', 'password')
                ->add('passwordConfirm', 'password')
                ->getForm();

        $request = $this->get('request');
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            $entityManager = $this->getEntityManager();
            $userValidate = $entityManager->getRepository('MelbSymfony2ForumExampleBundle:User')->findOneByEmailAddress($user->getEmailAddress());
            if(!empty($userValidate)) {
                $form->addError(new FormError('Username/email {emailAddress} dataEmailAddress not unique', array('{emailAddress}' => $user->getEmailAddress())));
            }

            if ($form->isValid()) {
                // perform some action, such as save the object to the database

                $factory = $this->get('security.encoder_factory');

                $encoder = $factory->getEncoder($user);
                $password = $encoder->encodePassword($user->getPasswordNew(), $user->getSalt());
                $user->setPassword($password);

                if(empty($user)) {
                    $user = $entityManager->getRepository('MelbSymfony2ForumExampleBundle:User')->findOneByName('user: 0');
                }

                $entityManager->persist($user);
                $entityManager->flush();

                // create the authentication token
                $token = new Authentication\Token\UsernamePasswordToken($user, null, 'default', $user->getRoles());
                // give it to the security context
                $this->container->get('security.context')->setToken($token);

                return $this->redirect($this->generateUrl('forum_default'));
            }
        }

        return array('form' => $form->createView());
    }
}