<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Entity\Flight;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\ORM\EntityManagerInterface;

class bookingController extends Controller
{
    /**
     * @Route("book/{id}", name="book")
     */
    public function bookAction($id, EntityManagerInterface $em) {
      $user = $this->getUser();
      $flight = $this->getDoctrine()->getRepository('AppBundle:Flight')->find($id);
      $user->addFlight($flight);
      $em->persist($user);
      $em->flush();
      $booked = $user->getFlights()->contains($flight);
      return $this->render('app/flight.html.twig', [
      	'User'=>$user ,
      	'flight' => $flight,
      	'SuccessNotification'=> 'Your booking was successfully added to the database',
      	'booked'=>$booked]
      );
    }

    /**
     * @Route("/bookings", name="bookings")
     */
    public function bookingsAction() {
      $user = $this->getUser();
      $empty = count($user->getFlights());
      dump($empty);
      return $this->render('app/bookings.html.twig', [
      	'User'=>$user,
      	'empty'=> $empty
      ]);
    }

    /**
     * @Route("/cancel/{id}", name="cancel")
     */
    public function cancelAction($id, EntityManagerInterface $em) {
      $user = $this->getUser();
      $flight = $this->getDoctrine()->getRepository('AppBundle:Flight')->find($id);
      $user->removeFlight($flight);
      $em->persist($user);
      $em->flush();
      $empty = count($user->getFlights());
      dump($empty);
      return $this->render('app/bookings.html.twig', [
      	'User'=>$user,
      	'SuccessNotification'=> 'Your booking was successfully removed from the database',
      	'empty'=> $empty
      ]);
    }

}
