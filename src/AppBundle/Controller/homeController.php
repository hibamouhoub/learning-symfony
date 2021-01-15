<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Entity\Flight;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\ORM\EntityManagerInterface;

class homeController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function homeAction()
    {
    	$flights = $this->getDoctrine()->getRepository('AppBundle:Flight')->findAll();
    	$user = $this->getUser();
    	if ($user){
    		return $this->render('app/home.html.twig',['User'=>$user , 'Flights'=>$flights]);
    	} else {
    		return $this->render('app/home.html.twig',['Flights'=>$flights]);
    	}
    }

    /**
     * @Route("/{id}", name="flight")
     */
    public function show($id) {
      $flight = $this->getDoctrine()->getRepository('AppBundle:Flight')->find($id);
      $user = $this->getUser();
      $booked = $user->getFlights()->contains($flight);
      return $this->render('app/flight.html.twig', ['User'=>$user ,'flight' => $flight,'booked'=>$booked]);
    }

    

}
