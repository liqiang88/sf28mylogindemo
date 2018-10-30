<?php

// src/AppBundle/Security/User/WebserviceUserProvider.php
namespace AppBundle\Security\User;


//use AppBundle\Security\User\WebserviceUser;
use AppBundle\Entity\WebserviceUser;
use AppBundle\Entity\User;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\DependencyInjection\ContainerInterface;

class WebserviceUserProvider implements UserProviderInterface
{

    protected $container = null;

    public function __construct(ContainerInterface $container)
    {

        $this->container = $container;
    }

    public function loadUserByUsername($username)
    {
        return $this->fetchUser($username);
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }

        $username = $user->getUsername();

        return $this->fetchUser($username);
    }

    public function supportsClass($class)
    {
        return User::class === $class;
    }

    private function fetchUser($username)
    {


        try{
            $db = $this->container->get('doctrine');

            $userData = $db->getRepository(User::class)
                ->loadUserByUsername($username);

        }catch (\Exception $exception){
            $logger = $this->container->get('logger');
            $logger->debug($exception->getMessage());

        }



        // make a call to your webservice here
//        $userData =  $this->userRepository->loadUserByUsername($username);
        // pretend it returns an array on success, false if there is no user

        if ($userData) {
//            $password = '...';

            // ...

            return $userData;

//            return new WebserviceUser($username, $password, $salt, $roles);
        }

        throw new UsernameNotFoundException(
            sprintf('Username "%s" does not exist.', $username)
        );
    }
}