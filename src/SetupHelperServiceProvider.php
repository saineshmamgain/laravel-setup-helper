<?php

namespace SaineshMamgain\SetupHelper;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use SaineshMamgain\SetupHelper\Console\Commands\Generators\ContractMakeCommand;
use SaineshMamgain\SetupHelper\Console\Commands\Generators\JobMakeCommand;
use SaineshMamgain\SetupHelper\Console\Commands\Generators\RequestMakeCommand;
use SaineshMamgain\SetupHelper\Console\Commands\Generators\TraitMakeCommand;
use SaineshMamgain\SetupHelper\Console\Commands\SetupCommand;

/**
 * File: SetupHelperServiceProvider.php
 * Author: Sainesh Mamgain
 * Email: saineshmamgain@gmail.com
 * Date: 01/03/21
 * Time: 6:33 PM.
 */
class SetupHelperServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/setup-helper.php',
            'setup-helper'
        );
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/setup-helper.php' => config_path('setup-helper.php'),
        ], 'setup-helper-config');

        if ($this->app->runningInConsole()) {
            $this->app->bind('command.setup-helper.install', SetupCommand::class);
            $this->app->bind('command.setup-helper.make.trait', TraitMakeCommand::class);
            $this->app->bind('command.setup-helper.make.contract', ContractMakeCommand::class);
            $commands = [
                'command.setup-helper.install',
                'command.setup-helper.make.trait',
                'command.setup-helper.make.contract',
            ];

            $this->commands($commands);

            if (config('setup-helper.override_make_request_command')) {
                $this->app->extend('command.request.make', function () {
                    return new RequestMakeCommand(new Filesystem());
                });
            }

            if (config('setup-helper.override_make_job_command')) {
                $this->app->extend('command.job.make', function () {
                    return new JobMakeCommand(new Filesystem());
                });
            }
        }
    }
}
