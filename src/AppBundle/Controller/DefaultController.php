<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;



class DefaultController extends Controller
{

    public function __construct()
    {
    }

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ));
    }

    /**
     * @Route("/admin")
     */
    public function adminAction()
    {
        return new Response('<html><body>Admin page!</body></html>');
    }

    /**
     * @Route("/adm/index")
     */
    public function admAction()
    {
        return new Response('<html><body>Adm index page!</body></html>');

    }



    /**
     * @Route("/addUser")
     */
    public function addUserAction()
    {

        $user = new User();
        $user->setUsername('admin');
        $plainPassword = 'admin123';
        $encoder = $this->container->get('security.password_encoder');
        $encoded = $encoder->encodePassword($user, $plainPassword);

        $user->setPassword($encoded);
        $user->setEmail('admin@example.com');
        $user->setActive(true);

        $manager = $this->getDoctrine()->getEntityManager();
        $manager->persist($user);
        $manager->flush();
    }
}
