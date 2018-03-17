<?php

namespace App\Console;

use App\Entity\Post;
use App\Entity\Collection;
use App\Loader\EntityLoader;
use App\Output\Output;
use Nette\DI\Container;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ProcessPostCommand
 * @package App\Console
 */
class ProcessPostCommand extends \Symfony\Component\Console\Command\Command
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
     * ParseBeersCommand constructor.
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
        $this->setName('post')
            ->setDescription('Parses post from API and saves it to drive');

        $this
            ->addArgument('id', InputArgument::REQUIRED, 'What post ID do you want to download?')
            ->addArgument('comment', InputArgument::OPTIONAL, 'Do you want to count comments?');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @throws \ReflectionException
     */
    protected function execute(InputInterface $input, OutputInterface $output): void
    {

        $post = $this->loader->load(Post::class, $input->getArgument('id'));
        if ($input->getArgument('comment') == "comment") {
            $post->comments;
        }
        $this->fileOutput->save(DATA_DIR, $post);
        $output->writeln("done");
    }


}