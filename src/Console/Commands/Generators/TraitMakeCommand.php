<?php

namespace SaineshMamgain\SetupHelper\Console\Commands\Generators;

use Illuminate\Console\GeneratorCommand;
use SaineshMamgain\SetupHelper\Exceptions\FileNotFoundException;

/**
 * File: TraitMakeCommand.php
 * Author: Sainesh Mamgain
 * Email: saineshmamgain@gmail.com
 * Date: 01/03/21
 * Time: 6:22 PM
 */

class TraitMakeCommand extends GeneratorCommand
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:trait {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to create trait';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Trait';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     * @throws FileNotFoundException
     */
    protected function getStub()
    {
        if (file_exists($stubsPath = $this->laravel->basePath(trim('/stubs/trait.stub', '/'))))
            return $stubsPath;

        throw new FileNotFoundException("Stub for trait not found");
    }


    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Traits';
    }
}
