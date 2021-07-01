<?php

namespace SaineshMamgain\SetupHelper\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

/**
 * File: SetupCommand.php
 * Author: Sainesh Mamgain
 * Email: saineshmamgain@gmail.com
 * Date: 01/03/21
 * Time: 6:47 PM.
 */
class SetupCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup-helper:install {--force}';

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
        $force = $this->option('force');

        if (!is_dir($stubsPath = $this->laravel->basePath('stubs'))) {
            (new Filesystem())->makeDirectory($stubsPath);
        }

        $files = [
            realpath(__DIR__.'/../../../stubs/setup-helper-trait.stub')    => $stubsPath.'/setup-helper-trait.stub',
            realpath(__DIR__.'/../../../stubs/setup-helper-contract.stub') => $stubsPath.'/setup-helper-contract.stub',
        ];

        if (config('setup-helper.override_make_request_command')) {
            if (!is_dir($requestsPath = $this->laravel->basePath('app/Http/Requests'))) {
                (new Filesystem())->makeDirectory($requestsPath);
            }

            $files = array_merge($files, [
                realpath(__DIR__.'/../../../stubs/setup-helper-request.stub')      => $stubsPath.'/setup-helper-request.stub',
                realpath(__DIR__.'/../../../stubs/setup-helper-base-request.stub') => $requestsPath.'/BaseRequest.php',
            ]);
        }

        if (config('setup-helper.override_make_job_command')) {
            if (!is_dir($jobsPath = $this->laravel->basePath('app/Jobs'))) {
                (new Filesystem())->makeDirectory($jobsPath);
            }

            $files = array_merge($files, [
                realpath(__DIR__.'/../../../stubs/setup-helper-job.stub')      => $stubsPath.'/setup-helper-job.stub',
                realpath(__DIR__.'/../../../stubs/setup-helper-base-job.stub') => $jobsPath.'/BaseJob.php',
            ]);
        }

        foreach ($files as $from => $to) {
            if (!file_exists($to) || $force) {
                file_put_contents($to, file_get_contents($from));
            }
        }

        $this->info('Setup Completed Successfully');
    }
}
