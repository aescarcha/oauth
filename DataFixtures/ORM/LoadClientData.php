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
            'redirect_uris' => [],
            'secret' => '4ok2x70rqfokc8g0w1s8c8kwcokw80k44sg48gocsok4w0so0k',
            'allowed_grant_types' => ['password'],
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach ($this->data as $key => $data) {
            $entity = new Client();
            $entity->setRandomId($data['random_id']);
            $entity->setRedirectUris($data['redirect_uris']);
            $entity->setSecret($data['secret']);
            $entity->setAllowedGrantTypes($data['allowed_grant_types']);
            $manager->persist($entity);
        }

        $manager->flush();
    }
}