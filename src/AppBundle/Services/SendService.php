<?php

namespace AppBundle\Services;

use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Email;

class SendService
{
    /**
     * @var EntityManager
     */
    private $em;

    private $mailer;

    /**
     * @var string
     */
    private $mailerFrom;

    public function __construct(EntityManager $entityManager, $mailer, $mailerFrom)
    {
        $this->em = $entityManager;
        $this->mailer = $mailer;
        $this->mailerFrom = $mailerFrom;
    }

    public function sendAll()
    {
        $emailRepository = $this->em->getRepository(Email::class);
        $emails = $emailRepository->findBy(['send' => false]);
        /** @var Email $email */
        foreach($emails as $email){
            $this->send($email);
            $email->setSend(true);
            $this->em->persist($email);
        }

        $this->em->flush();
    }

    public function send(Email $email)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject(sprintf('Welcome'))
            ->setFrom($this->mailerFrom)
            ->setTo($email->getEmail())
            ->setBody("Welcome", 'text/html');
        $sent = $this->mailer->send($message);

        return $sent;
    }
}
