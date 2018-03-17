<?php

namespace App\Console;

use App\Entity\Collection;
use App\Entity\User;
use App\Loader\EntityLoader;
use App\Output\Output;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ProcessUserCommand
 * @package App\Console
 */
class ProcessUserCommand extends \Symfony\Component\Console\Command\Command
{


    /**
     * @var EntityLoader
     */
    private $loader;

    /**
     * @var Output
     */
    private $fileOutput;

    /**
     * ProcessUserCommand constructor.
     * @param EntityLoader $l
     * @param Output $
     * @param $o
     */
    public function __construct(EntityLoader $l, Output $o)
    {
        $this->loader = $l;
        $this->fileOutput = $o;

        parent::__construct();
    }

    /**
     *
     */
    protected function configure(): void
    {
        $this->setName('user')
            ->setDescription('Parses user from API and saves it to drive');

        $this
            ->addArgument('id', InputArgument::REQUIRED, 'What post ID do you want to download?')
            ->addArgument('post', InputArgument::OPTIONAL, 'Do you want to count posts?');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @throws \ReflectionException
     */
    protected function execute(InputInterface $input, OutputInterface $output): void
    {

        $user = $this->loader->load(User::class, $input->getArgument('id'));
        if ($input->getArgument('post') == "post") {
            $user->posts;
        }
        $this->fileOutput->save(DATA_DIR, $user);
        $output->writeln("done");
    }


}