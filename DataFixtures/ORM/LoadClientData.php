<?php 
namespace Aescarcha\OauthServerBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Aescarcha\OauthServerBundle\Entity\Client;

class LoadClientData implements FixtureInterface
{
    protected $data = [
        [
            'id' => '1',
            'random_id' => "3bcbxd9e24g0gk4swg0kagcw98o8k8g4g888kwc44gcc0gwwk4",
            'redirect_uris' => 'a:0:{}',
            'secret' => '4ok2x70rqfokc8g0w1s8c8kwcokw80k44sg48gocsok4w0so0k',
            'allowed_grant_types' => 'a:1:{i:0;s:8:"password";}',
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach ($this->data as $key => $data) {
            $entity = new Client();
            $entity->setRandomId($data['random_id']);
            $entity->setRedirectUris(json_decode($data['redirect_uris']), true);
            $entity->setSecret($data['secret']);
            $entity->setAllowedGrantTypes(json_decode($data['allowed_grant_types']), true);
            $manager->persist($entity);
        }

        $manager->flush();
    }
}