<?php

namespace AppBundle\Command;

use AppBundle\Services\SendService;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SendCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('emailservice:send');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var SendService $sendService */
        $sendService = $this->getContainer()->get('app.send_service');
        $sendService->sendAll();

        $output->writeln("Finish");
    }
}