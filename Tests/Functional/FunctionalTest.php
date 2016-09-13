<?php

namespace Aescarcha\OauthServerBundle\Tests\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase;

class FunctionalTest extends WebTestCase
{
    protected $manager;
    protected $client;

    public function setUp()
    {
        $this->loadFixtures(array());
        $this->client = static::createClient();
        $this->manager = $this->client->getContainer()->get('doctrine.orm.entity_manager');
    }

    public function testCreate()
    {
        $clientManager = $this->client->getContainer()->get('fos_oauth_server.client_manager.default');
        $client = $clientManager->createClient();
        $client->setRedirectUris(array('http://www.example.com'));
        $client->setAllowedGrantTypes(array('token', 'authorization_code'));
        $clientManager->updateClient($client);

        // $crawler = $this->client->request(
        //                  'POST',
        //                  '/businesses',
        //                  array(),
        //                  array(),
        //                  array('CONTENT_TYPE' => 'application/json'),
        //                  '{"name":"my unit test"}'
        //                  );
        // $this->assertEquals(201, $this->client->getResponse()->getStatusCode());
        // $response = json_decode($this->client->getResponse()->getContent(), true);
        // $this->assertEquals( 'my unit test', $response['data']['name'] );
        // $this->assertContains( '/businesses/', $response['data']['links']['self']['uri'] );
    }


}
