<?php
/**
 * Created by PhpStorm.
 * User: a1
 * Date: 18/10/24
 * Time: 16:09
 */

// src/AppBundle/Controller/SecurityController.php

// ...
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

class SecurityController extends Controller
{

    private $tokenManager;

    public function __construct(CsrfTokenManagerInterface $tokenManager = null)
    {
        $this->tokenManager = $tokenManager;
    }

    /**
     * @Route("/login", name="login")
     * @param Request $request
     * @return Response
     */
    public function loginAction(Request $request)
    {
//        $authenticationUtils = $this->get('security.authentication_utils');
//
//        // get the login error if there is one / 获取可能存在的登录错误信息
//        $error = $authenticationUtils->getLastAuthenticationError();
//
//        // last username entered by the user / 获取用户输入的username（用户名）
//        $lastUsername = $authenticationUtils->getLastUsername();

        /** @var $session Session */
        $session = $request->getSession();

        $authErrorKey = Security::AUTHENTICATION_ERROR;
        $lastUsernameKey = Security::LAST_USERNAME;

        // get the error if any (works with forward and redirect -- see below)
        if ($request->attributes->has($authErrorKey)) {
            $error = $request->attributes->get($authErrorKey);
        } elseif (null !== $session && $session->has($authErrorKey)) {
            $error = $session->get($authErrorKey);
            $session->remove($authErrorKey);
        } else {
            $error = null;
        }

        if (!$error instanceof AuthenticationException) {
            $error = null; // The value does not come from the security component.
        }

        // last username entered by the user
        $lastUsername = (null === $session) ? '' : $session->get($lastUsernameKey);
//
//        $csrfToken = $this->tokenManager
//            ? $this->tokenManager->getToken('authenticate')->getValue()
//            : null;

        return $this->render(
            'security/login.html.twig',
            array(
                // last username entered by the user
                'last_username' => $lastUsername,
                'error'         => $error,
            )
        );
    }

    /**
     * @Route("/login_check", name="login_check")
     */
    public function checkAction()
    {

    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction()
    {
        return new Response('<html><body>Admin logout!</body></html>');
    }

}