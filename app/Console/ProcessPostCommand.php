<?php

namespace App\Console;

use App\Entity\BaseEntity;
use App\Entity\Post;
use App\Entity\Collection;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;

/**
 * Class ProcessPostCommand
 * @package App\Console
 */
class ProcessPostCommand extends BaseCommand
{
    const ATTR_COMMENT = "comment";

    /**
     *
     */
    protected function configure(): void
    {
        $this->setEntityClass(Post::class);
        $this->setName('post')
            ->setDescription('Parses post from API and saves it to drive');

        $this
            ->addArgument(self::ATTR_ID, InputArgument::REQUIRED, 'What post ID do you want to download?')
            ->addArgument(self::ATTR_COMMENT, InputArgument::OPTIONAL, 'Do you want to count comments?');
    }

    /**
     * @param InputInterface $input
     * @param BaseEntity $e
     */
    protected function configureObject(InputInterface $input, BaseEntity $e): void
    {
        if ($input->getArgument(self::ATTR_COMMENT) == self::ATTR_COMMENT) {
            $e->comments;
        }
    }
}