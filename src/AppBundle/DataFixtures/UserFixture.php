<?php

namespace AppBundle\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture
{
	private $encoder;
	public function __construct(UserPasswordEncoderInterface $encoder)
	{
		$this->encoder = $encoder;
	}

	public function load(ObjectManager $manager)
	{
		$user = new User;
		$user->setUsername('powerios');
		$user->setEmail('hibamouhoub0@gmail.com');
		$user->setPicture('powerios.jpg');
		$user->setFullname('Hiba Mouhoub');
		$user->setPassword(
			$this->encoder->encodePassword($user, "hihi")
		);

		$manager->persist($user);
		$manager->flush();
	}

}