<?php

namespace SaineshMamgain\SetupHelper;

use Illuminate\Support\ServiceProvider;
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

    }

    public function register()
    {
        $this->app->bind('command.setup-helper.install', SetupCommand::class);

        $this->commands([
            'command.setup-helper.install'
        ]);
    }
}
