<?php
/**
 * Created by PhpStorm.
 * User: rahul
 * Date: 25/06/18
 * Time: 2:34 PM
 */

namespace App\Tests\Controller;

use App\Controller\IndexController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

use Symfony\Component\HttpFoundation\Response;

class IndexControllerTest extends WebTestCase
{

    public function testIndexAction()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'jane_admin',
            'PHP_AUTH_PW' => 'kitten',
        ]);

        $crawler = $client->request('GET', '/');

        $form = $crawler->selectButton('label.get_difference_button')->form([
            'form[fromDate]' => '2003-02-24',
            'form[toDate]' => '2017-11-12',
        ]);

        $client->submit($form);

        $this->assertSame(Response::HTTP_OK, $client->getResponse()->getStatusCode());

    }
}
