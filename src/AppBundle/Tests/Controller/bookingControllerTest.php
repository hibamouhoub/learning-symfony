<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class bookingControllerTest extends WebTestCase
{
    public function testBook()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/book');
    }

}
