<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 * @ORM\Table(name="email")
 */
class Email
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"default"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"default"})
     */
    private $email;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Groups({"default"})
     */
    private $send;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return boolean
     */
    public function isSend()
    {
        return $this->send;
    }

    /**
     * @param boolean $send
     */
    public function setSend($send)
    {
        $this->send = $send;
    }
}
