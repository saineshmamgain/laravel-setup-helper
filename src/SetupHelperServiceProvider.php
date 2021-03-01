<?php

namespace SaineshMamgain\SetupHelper;

use Illuminate\Support\ServiceProvider;
use SaineshMamgain\SetupHelper\Console\Commands\Generators\ContractMakeCommand;
use SaineshMamgain\SetupHelper\Console\Commands\Generators\TraitMakeCommand;
use SaineshMamgain\SetupHelper\Console\Commands\SetupCommand;

/**
 * File: SetupHelperServiceProvider.php
 * Author: Sainesh Mamgain
 * Email: saineshmamgain@gmail.com
 * Date: 01/03/21
 * Time: 6:33 PM
 */

class SetupHelperServiceProvider extends ServiceProvider {

    public function boot()
    {
        if ($this->app->runningInConsole() && $this->app->environment() != "production"){
            $this->app->bind('command.setup-helper.install', SetupCommand::class);
            $this->app->bind('command.setup-helper.make.trait', TraitMakeCommand::class);
            $this->app->bind('command.setup-helper.make.contract', ContractMakeCommand::class);
            $this->commands([
                'command.setup-helper.install',
                'command.setup-helper.make.trait',
                'command.setup-helper.make.contract'
            ]);
        }
    }

    public function register()
    {

    }
}
