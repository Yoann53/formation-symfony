<?php

namespace BlogBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MenuControllerTest extends WebTestCase
{
    public function testDisplay()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/display');
    }

}
