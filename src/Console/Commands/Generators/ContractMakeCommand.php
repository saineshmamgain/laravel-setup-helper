<?php

namespace SaineshMamgain\SetupHelper\Console\Commands\Generators;

use Illuminate\Console\GeneratorCommand;
use SaineshMamgain\SetupHelper\Exceptions\FileNotFoundException;

/**
 * File: ContractMakeCommand.php
 * Author: Sainesh Mamgain
 * Email: saineshmamgain@gmail.com
 * Date: 01/03/21
 * Time: 6:28 PM
 */

class ContractMakeCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:contract {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to generate Contract';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Contract';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     * @throws FileNotFoundException
     */
    protected function getStub()
    {
        if (file_exists($stubsPath = $this->laravel->basePath(trim('/stubs/setup-helper-contract.stub', '/'))))
            return $stubsPath;

        throw new FileNotFoundException("Stub for contract not found");
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Contracts';
    }
}
