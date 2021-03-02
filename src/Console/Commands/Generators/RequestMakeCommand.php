<?php

namespace SaineshMamgain\SetupHelper\Console\Commands\Generators;

class RequestMakeCommand extends \Illuminate\Foundation\Console\RequestMakeCommand
{
    protected function getStub()
    {
        if (file_exists($this->laravel->basePath('/stubs/setup-helper-request.stub'))){
            return $this->resolveStubPath('/stubs/setup-helper-request.stub');
        }
        return parent::getStub();
    }
}
