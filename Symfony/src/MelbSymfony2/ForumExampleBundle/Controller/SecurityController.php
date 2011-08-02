<?php
/*
 * 
 * User: camm
 */
 
namespace MelbSymfony2\ForumExampleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Security\Core\SecurityContext;

/**
 *
 * @author camm
 */
class SecurityController extends Controller
{
    /**
     * @Route("/", name="user_bar")
     * @Template("MelbSymfony2ForumExampleBundle:Security:user-bar.html.twig")
     */
    public function userBarAction() {

        return array('user' => $this->get('security.context')->getToken()->getUser());
    }

    /**
     * @Route("/session/login", name="login")
     * @Template("MelbSymfony2ForumExampleBundle:Security:session-login.html.twig")
     *
     */
    public function loginAction()
    {
        // get the login error if there is one
        if ($this->get('request')->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $this->get('request')->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $this->get('request')->getSession()->get(SecurityContext::AUTHENTICATION_ERROR);
        }

        return array(
            // last username entered by the user
            'last_username' => $this->get('request')->getSession()->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
        );
    }

    /**
     * @Route("/session/logout", name="logout")
     */
    public function logoutAction()
    {

    }

    /**
     * @Route("/session/login/check", name="login_check")
     */
    public function loginCheckAction()
    {

    }
}
