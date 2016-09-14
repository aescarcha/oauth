<?php

namespace Aescarcha\OauthServerBundle\Tests\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase;

class FunctionalTest extends WebTestCase
{
    protected $manager;
    protected $client;

    public function setUp()
    {
        $this->loadFixtures(array(
            'Aescarcha\UserBundle\DataFixtures\ORM\LoadUserData',
                                  ));
        $this->client = static::createClient();
        $this->manager = $this->client->getContainer()->get('doctrine.orm.entity_manager');
    }

    public function testCreate()
    {
        $clientManager = $this->client->getContainer()->get('fos_oauth_server.client_manager.default');
        $client = $clientManager->createClient();
        $client->setRedirectUris(array('http://www.example.com'));
        $client->setAllowedGrantTypes(array('token', 'authorization_code', 'password'));
        $clientManager->updateClient($client);
        $crawler = $this->client->request(
                         'POST',
                         '/oauth/v2/token',
                         array(),
                         array(),
                         array('CONTENT_TYPE' => 'application/json'),
                         '{
                           "grant_type":"password",
                           "client_id":"' . $client->getId() . '_' . $client->getRandomId() . '",
                           "client_secret":"' . $client->getSecret() . '",
                           "username": "Alvaro",
                           "password": "1231251265"
                          }'
                         );
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $response = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertTrue( strlen($response['access_token']) > 10 );
        $this->assertEquals( 'bearer', $response['token_type'] );
        $this->assertTrue( strlen($response['refresh_token']) > 10 );
        $this->assertEquals( 3600, $response['expires_in'] );
    }


}
