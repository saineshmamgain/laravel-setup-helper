<?php

namespace SaineshMamgain\SetupHelper\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

/**
 * File: SetupCommand.php
 * Author: Sainesh Mamgain
 * Email: saineshmamgain@gmail.com
 * Date: 01/03/21
 * Time: 6:47 PM
 */

class SetupCommand extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup-helper:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Setup Helper';

    /**
     * @return void
     */
    public function handle()
    {
        $this->info("Publishing stubs");

        if (! is_dir($stubsPath = $this->laravel->basePath('stubs'))) {
            (new Filesystem)->makeDirectory($stubsPath);
        }

        if (! is_dir($requestsPath = $this->laravel->basePath('app/Http/Requests'))){
            (new Filesystem)->makeDirectory($requestsPath);
        }

        $files = [
            realpath(__DIR__ . '/../../../stubs/setup-helper-trait.stub') => $stubsPath . '/setup-helper-trait.stub',
            realpath(__DIR__ . '/../../../stubs/setup-helper-contract.stub') => $stubsPath . '/setup-helper-contract.stub',
            realpath(__DIR__ . '/../../../stubs/setup-helper-request.stub') => $stubsPath . '/setup-helper-request.stub',
            realpath(__DIR__ . '/../../Http/Requests/BaseRequest.php.stub') => $requestsPath . '/BaseRequest.php',
        ];

        foreach ($files as $from => $to) {
            file_put_contents($to, file_get_contents($from));
        }

        $this->info("Stubs published successfully");
    }

}
