<?php

namespace AppBundle\Services;

use Doctrine\ORM\EntityManager;
use GuzzleHttp\Client;
use AppBundle\Entity\Email;

class EmailService
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var string
     */
    private $host;


    public function __construct(Client $client, EntityManager $entityManager, $email_service_host)
    {
        $this->client = $client;
        $this->em = $entityManager;
        $this->host = $email_service_host;
    }

    public function synchronize()
    {
        $data = $this->fetchData();
        $emailArray = json_decode($data);
        $emailRepository = $this->em->getRepository(Email::class);

        foreach ($emailArray as $item) {
            $email = $emailRepository->findOneBy(['email' => $item->email]);
            if(!$email){
                $newEmail = new Email();
                $newEmail->setEmail($item->email);
                $newEmail->setSend(false);
                $this->em->persist($newEmail);
            }
        }

        $this->em->flush();
    }

    public function fetchData()
    {
        $res = $this->client->request('GET', $this->host.'/emails');
        if($res->getStatusCode() != 200){
            return;
        }

        return $res->getBody()->getContents();
    }
}
