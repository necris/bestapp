<?php

namespace App\Console;

use App\AppException;
use App\Entity\BaseEntity;
use App\Entity\Collection;
use App\Loader\EntityLoader;
use App\Output\Output;
use GuzzleHttp\Exception\RequestException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ProcessPostCommand
 * @package App\Console
 */
abstract class BaseCommand extends \Symfony\Component\Console\Command\Command
{
    const ATTR_ID = "id";

    protected $entityClass;

    /**
     * @var EntityLoader
     */
    protected $loader;

    /**
     * @var Output
     */
    protected $fileOutput;

    /**
     * ProcessPostCommand constructor.
     * @param EntityLoader $l
     * @param Output $o
     */
    public function __construct(EntityLoader $l, Output $o)
    {
        $this->loader = $l;
        $this->fileOutput = $o;

        parent::__construct();
    }

    /**
     * @throws AppException
     */
    protected function configure(): void
    {
        throw new AppException("Missing configure method in command " . self::class);
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output): void
    {

        try {
            $obj = $this->loader->load($this->entityClass, $input->getArgument(self::ATTR_ID));
            $this->configureObject($input, $obj);
            $this->fileOutput->save(DATA_DIR, $obj);
            $output->writeln("done");
        } catch (RequestException $e) {
            $output->writeln("nothing to save - " . $e->getMessage());
        } catch (\Exception $e) {
            $output->writeln("ERROR: " . $e->getMessage());
        }
    }

    /**
     * @param string $class
     * @return BaseCommand
     */
    protected function setEntityClass(string $class): self
    {
        $this->entityClass = $class;
        return $this;
    }

    /**
     * @param InputInterface $input
     * @param BaseEntity $e
     */
    abstract protected function configureObject(InputInterface $input, BaseEntity $e): void;


}