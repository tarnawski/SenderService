<?php

namespace AppBundle\Command;

use AppBundle\Services\EmailService;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SynchronizeCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('emailservice:synchronize');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var EmailService $emailService */
        $emailService = $this->getContainer()->get('app.email_service');
        $emailService->synchronize();

        $output->writeln("Finish");
    }
}