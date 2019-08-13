<?php declare(strict_types=1);

namespace Taxation\Console;

use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableCell;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Taxation\Entity\Country;
use Taxation\Entity\State;

class CalculateTaxRate extends Command
{
    /** @var object \Psr\Container\ContainerInterface */
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        parent::__construct(null);
    }

    protected function configure()
    {
        $this
            ->addArgument('country', InputArgument::REQUIRED, 'Country to calculate')
            ->setName('app:calculate')
            ->setDescription("Calculate tax statistics per country")
            ->setHelp('You can use now: Germany, or Italy');
    }

    public function execute(InputInterface $input, OutputInterface $output):void
    {
        $country = $input->getArgument('country');

        /** @var Country $countryEntity */
        $countryEntity = $this->container->get('countryRepository')->getByName($country);

        $table = new Table($output);

        $outputData[] = ['Country', 'Overall taxes', 'Average tax rate', 'Average amount of taxes'];
        $outputData[] = new TableSeparator();
        $outputData[] = [$country, $countryEntity->getTotalTaxAmount(), $countryEntity->getAvgTaxRate()];
        $outputData[] = new TableSeparator();
        $outputData[] = [new TableCell('State', ['colspan' => 4])];
        $outputData[] = new TableSeparator();

        foreach ($countryEntity->getStates() as $stateEntity) {
            /** @var State $stateEntity */
            $outputData[] = [
                $stateEntity->getName(),
                $stateEntity->getTotalTaxAmount(),
                $stateEntity->getAvgTaxRate(),
                $stateEntity->getAverageTaxAmount()
            ];
            $outputData[] = new TableSeparator();
        }
        $table->setRows($outputData);
        $table->render();
    }
}
