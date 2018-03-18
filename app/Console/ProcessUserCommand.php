<?php

namespace App\Console;

use App\Entity\BaseEntity;
use App\Entity\Collection;
use App\Entity\User;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;

/**
 * Class ProcessUserCommand
 * @package App\Console
 */
class ProcessUserCommand extends BaseCommand
{

    const ATTR_POST = "post";

    /**
     *
     */
    protected function configure(): void
    {
        $this->setEntityClass(User::class);
        $this->setName('user')
            ->setDescription('Parses user from API and saves it to drive');

        $this
            ->addArgument(self::ATTR_ID, InputArgument::REQUIRED, 'What post ID do you want to download?')
            ->addArgument(self::ATTR_POST, InputArgument::OPTIONAL, 'Do you want to count posts?');
    }

    /**
     * @param InputInterface $input
     * @param BaseEntity $e
     */
    protected function configureObject(InputInterface $input, BaseEntity $e): void
    {
        if ($input->getArgument(self::ATTR_POST) == self::ATTR_POST) {
            $e->posts;
        }
    }


}