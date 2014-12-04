<?php

namespace ParisSurvivalGuide\AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class ImportMeteoDataCommand extends ContainerAwareCommand
{
    /**
     * @var InputInterface
     */
    protected $input;

    /**
     * @var OutputInterface
     */
    protected $output;

    /**
     * @inheritdoc
     * @see \Symfony\Component\Console\Command\Command::configure()
     */
    protected function configure()
    {
        $this
            ->setName('psg:load-meteo-data')
            ->setDescription('Load meteo data from the CSV file')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        echo "Starting...";
        $this->getContainer()->get('paris_survival_guide_app.meteo_import')->import();
    }
}