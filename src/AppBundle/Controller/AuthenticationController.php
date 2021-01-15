<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use AppBundle\Entity\User;



class AuthenticationController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request, AuthenticationUtils $utils)
    {
        $error = $utils->getLastAuthenticationError();
        $lastUsername = $utils->getLastUsername();

        return $this->render('authentication/login.html.twig',[ 
            'Error' => $error ,
            'LastUsername' => $lastUsername
        ]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction(Request $request, AuthenticationUtils $utils)
    {
        $error = $utils->getLastAuthenticationError();
        $lastUsername = $utils->getLastUsername();

        return $this->render('authentication/login.html.twig',[ 
            'Error' => $error ,
            'LastUsername' => $lastUsername
        ]);
    }

    /**
     * @Route("/register", name="register", methods={"GET","POST"})
     */
    public function registerAction(Request $request, EntityManagerInterface $em, UserPasswordEncoderInterface $encoder)
    {
        $form = $this->createFormBuilder()
            ->add('_username',TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('email',TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('fullname',TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('_password',PasswordType::class, ['attr' =>['class' => 'form-control']])
            ->add('confirmpassword',PasswordType::class, ['attr' =>['class' => 'form-control']])
            ->getForm()
        ;

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $client = $this->getDoctrine()->getRepository('AppBundle:User')->findOneBy(array('username'=>$data['_username']));
            if ($client){
                $error = 'The username is already used !';
                return $this->render('Authentication/register.html.twig',[ 'myform' => $form->createView() , 'Error'=>$error ]);
            } else {
                $client = $this->getDoctrine()->getRepository('AppBundle:User')->findOneBy(array('email'=>$data['email']));
                if ($client){
                    $error = 'The email is already used !';
                    return $this->render('Authentication/register.html.twig',[ 'myform' => $form->createView() , 'Error'=>$error ]);
                } else {
                    if ($data['_password'] != $data['confirmpassword']){
                        $error = 'Password mismatch !';
                        return $this->render('Authentication/register.html.twig',[ 'myform' => $form->createView() , 'Error'=>$error ]);
                    } else {
                        $user = new User;
                        $user->setUsername($data['_username']);
                        $user->setEmail($data['email']);
                        $user->setFullname($data['fullname']);
                        $user->setPicture('fairytail.jpg');
                        $user->setPassword(
                            $encoder->encodePassword($user, $data['_password'])
                        );
                        $em->persist($user);
                        $em->flush();
                        return $this->render('Authentication/register.html.twig',[ 'myform' => $form->createView() , 'Success'=>'Registered' ]);
                    }
                }
            }       

        }
        return $this->render('authentication/register.html.twig',[ 'myform' => $form->createView() ]);
    }

}