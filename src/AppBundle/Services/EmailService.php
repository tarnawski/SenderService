<?php

namespace AppBundle\Services;

class EmailService
{
    /**
     * @var string
     */
    private $host;


    public function __construct($email_service_host)
    {
        $this->host = $email_service_host;
    }

    public function synchronize()
    {

    }

    public function fetchData()
    {

    }
}
