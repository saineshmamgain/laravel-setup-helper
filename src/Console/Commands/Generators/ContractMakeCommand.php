<?php

namespace SaineshMamgain\SetupHelper\Console\Commands\Generators;

use Illuminate\Console\GeneratorCommand;

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
     */
    protected function getStub()
    {
        return $this->laravel->basePath(trim('/stubs/contract.stub', '/'));
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Contracts';
    }
}
