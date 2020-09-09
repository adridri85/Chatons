<?php

namespace App\Controller;

use App\Entity\Account;
use App\Form\AccountType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AccountController extends AbstractController
{

    private $roles = "ROLE_USER";

    /**
     * @Route("/", name="login")
     */
    public function loginAction(AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUserName = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig' , array(
            'last_username' =>$lastUserName,
            'error' =>$error,
        ));
    }

    /**
     * @Route("/register", name="register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $userPasswordEncoderInterface, TokenStorageInterface $tokenStorageInterface, SessionInterface $sessionInterface, EntityManagerInterface $em){


        $account = new Account();
        $account->setAccountRoles($this->roles);

        $accountForm = $this->createForm(AccountType::class,$account);
        $accountForm->handleRequest($request);

        if($accountForm->isSubmitted() && $accountForm->isValid()){

            $pass = $userPasswordEncoderInterface->encodePassword($account,$account->getPass());
            $account->setPass($pass);

            $em->persist($account);
            $em->flush();

            $token = new UsernamePasswordToken($account,$pass,'main',$account->getRoles());

            $tokenStorageInterface->setToken($token);

            $sessionInterface->set('_security_main', serialize($token));

            $this->addFlash("succes","bien inscrie !");

            return $this->redirectToRoute("Pages");

        }

        return $this->render('account/account.html.twig', [
            'title' => 'ce crée un compte',
            'form_ins' => $accountForm->createView(),
        ]);

    }

    /**
     * @Route("/logout" , name="logOut")
     */
    public function logOut(){

    }
}
