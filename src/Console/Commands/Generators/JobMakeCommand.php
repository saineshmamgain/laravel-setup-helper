<?php

namespace SaineshMamgain\SetupHelper\Console\Commands\Generators;

/**
 * File: JobMakeCommand.php
 * Author: Sainesh Mamgain
 * Email: saineshmamgain@gmail.com
 * Date: 12/03/21
 * Time: 9:03 PM.
 */
class JobMakeCommand extends \Illuminate\Foundation\Console\JobMakeCommand
{
    protected function getStub()
    {
        if (file_exists($this->laravel->basePath('/stubs/setup-helper-job.stub')) && !$this->option('sync')) {
            return $this->resolveStubPath('/stubs/setup-helper-job.stub');
        }

        return parent::getStub();
    }

    /**
     * Resolve the fully-qualified path to the stub.
     *
     * @param  string  $stub
     * @return string
     */
    protected function resolveStubPath($stub)
    {
        return file_exists($customPath = $this->laravel->basePath(trim($stub, '/')))
            ? $customPath
            : __DIR__.$stub;
    }
}
